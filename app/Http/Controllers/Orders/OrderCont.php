<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Master\MobilModel;
use App\Models\Master\CustomerModel;
use App\Models\Master\TipePelangganModel;
use App\Models\Master\DriverModel;
use App\Models\Order\OrderModel;
use App\Models\Order\OrderDetailModel;
use App\Models\Master\CashflowModel;
use Session;
use DB;
use PDF;
use View;
use Carbon\Carbon;
use App\Helpers\Out_pdf;
use Dompdf\Dompdf;

class OrderCont extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $order = OrderModel::get();
            // dd($order);
            return view('orders/data', ['order' => $order]);
        } else {
            return redirect()->route('login');
        }
    }

    public function create()
    {
        if (Auth::check()) {
            $tipe = TipePelangganModel::get();
            foreach ($request->detail as $key => $value) {
                $mobil = DB::select("select * from t_mobil where id_mobil not in ( select id_mobil from t_order_detail where start_date >= '".date('Y-m-d',$value['start_date'])."' and finish_date <= '".date('Y-m-d',$value['end_date'])."'")
                $driver = DB::select("select * from t_driver where id_driver not in ( select id_driver from t_order_detail where start_date >= '".date('Y-m-d',$value['start_date'])."' and finish_date <= '".date('Y-m-d',$value['end_date'])."'")
            }
            $mobil = MobilModel::get();
            
            return view('orders/add', ['tipe' => $tipe, 'mobil' => $mobil, 'driver' => $driver]);
        } else {
            return redirect()->route('login');
        }
    }



    public function store(Request $request)
    {
        $date = Carbon::now();
        $sum = 0;
        foreach ($request->detail as $key => $item) {
            $sum += $item['harga'];
        }

        if ($date->day == '01' || $date->day == '1') {
            $invoice = DB::select("select ifnull(max(id_invoice),0) as id_invoice from t_order where month(created_at) = month(curdate());")[0]->id_invoice;
            if (intval($invoice) > 0) {
                $invoice = intval($invoice) + 1;
            } 
            else {
                $invoice = 1;
            }
        } else {
            $invoice = DB::select("select ifnull(max(id_invoice),0) as id_invoice from t_order where month(created_at) = month(curdate());")[0]->id_invoice;
            $invoice = intval($invoice) + 1;
            // dd($invoice);
        }

        $customer = new CustomerModel();
        $customer->nama_pelanggan = $request->nama;
        $customer->email = $request->email;
        $customer->tgl_lahir = $request->tgl_lahir;
        $customer->alamat = $request->alamat;
        $customer->no_telp = $request->telp;
        $customer->id_tipe_pelanggan = $request->tipe;
        $customer->status_order = '1';
        $customer->save();

        $order = new OrderModel();
        $order->id_tipe_pelanggan = $request->tipe;
        $order->id_invoice = str_pad($invoice, 4, '000',STR_PAD_LEFT);
        $order->id_pelanggan = $customer->id;
        $order->nama_pelanggan = $request->nama;
        $order->no_telp = $request->telp;
        $order->email = $request->email;
        $order->note = $request->note;
        $order->dibayar = $request->dibayar;
        if ($request->dibayar >= $sum) {
            $order->status = 1;
        } elseif ($request->dibayar <= $sum) {
            if ($request->dibayar == 0) {
                $order->status = 0;
            } else {
                $order->status = 2;
            }
        }
        $order->estimated = $sum;
        $order->actual = $sum;
        $order->oleh = Auth::user()->id;
        $order->note = $request->note;
        $order->save();
        // dd($order->status);
        if ($order->status == 1) {
            $cash = new CashflowModel();
            $cash->id_master_cashflow = 1;
            $cash->id_order = $order->id;
            $cash->amount = $request->dibayar;
            $cash->oleh = Auth::user()->id;
            $cash->save();
        }
        if ($order->status == 2) {
            $cash = new CashflowModel();
            $cash->id_master_cashflow = 1;
            $cash->id_order = $order->id;
            $cash->amount = $request->dibayar;
            $cash->oleh = Auth::user()->id;
            $cash->save();
        }


        foreach ($request->detail as $key => $value) {
            $order_detail = new OrderDetailModel();
            $order_detail->id_order = $order->id;
            $order_detail->id_tipe_pelanggan = $request->tipe;
            $order_detail->pic = $value['pic'];
            $order_detail->hp_pic = $value['hp_pic'];
            $order_detail->no_telp = $request->telp;
            $order_detail->id_pelanggan = $customer->id;
            $order_detail->id_driver = $value['driver'];
            $order_detail->start_date = date('y-m-d', strtotime($value['start_date']));
            $order_detail->finish_date = date('y-m-d', strtotime($value['end_date']));
            $order_detail->jemput = $value['jemput'];
            $order_detail->tujuan = $value['tujuan'];
            $order_detail->start_time = date('H:i', strtotime($value['start_time']));
            $order_detail->finish_time = date('H:i', strtotime($value['end_time']));
            $order_detail->id_mobil = $value['mobil'];
            $order_detail->km_awal = 0;
            $order_detail->km_akhir = 0;
            $order_detail->harga_mobil = 0;
            $order_detail->harga_driver = 0;
            $order_detail->uang_jalan = 0;
            $order_detail->bbm = 0;
            $order_detail->tol_parkir = 0;
            $order_detail->makan_inap = 0;
            $order_detail->overtime = 0;
            $order_detail->biaya_titip = 0;
            $order_detail->biaya_lainnya = 0;
            $order_detail->biaya_claim = 0;
            $order_detail->total_harga = intval($value['harga']);
            $order_detail->diskon = 0;
            $order_detail->ppn = 0;
            $order_detail->pph = 0;
            $order_detail->total_tagihan = intval($value['harga']);
            $order_detail->by = Auth::user()->id;
            $order_detail->save();
        }

        Session::flash('success_msg', 'Data Added Successfully');
        return redirect()->route('orderindex');
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $orders = DB::select("select * from t_order where id = '" . $id . "'");
            $pelanggan = DB::select("select * from t_pelanggan where id = '" . $orders[0]->id_pelanggan . "' ");
            $tipe = TipePelangganModel::get();
            $mobil = MobilModel::get();
            $driver = DriverModel::get();
            $orderdetail = DB::select("select * from t_order_detail where id_order = '" . $id . "'");
            return view('orders/edit', ['pelanggan' => $pelanggan, 'orderdetail' => $orderdetail, 'orders' => $orders, 'tipe' => $tipe, 'mobil' => $mobil, 'driver' => $driver]);
        } else {
            return redirect()->route('login');
        }
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $sum = 0;
        foreach ($request->detail as $key => $item) {
            $sum += $item['total_harga'];
        }

        $order = OrderModel::find($id);
        if ($request->dibayar == $sum) {
            $order->status = 1;
            $cashflow = CashflowModel::where('id_order', '=', $id);
            // dd($cashflow->count());
            if ($cashflow->count() > 0) {
                $cashflow->update([
                    'amount' => $request->dibayar,
                    'oleh' => Auth::user()->id
                ]);
            } elseif ($cashflow->count() == 0) {
                $cash = new CashflowModel();
                $cash->id_master_cashflow = 1;
                $cash->id_order = $order->id;
                $cash->amount = $request->dibayar;
                $cash->oleh = Auth::user()->id;
                $cash->save();
            }
        } else if ($request->dibayar <= $sum) {
            if ($request->dibayar == 0) {
                $order->status = 0;
            } else {
                $order->status = 2;
            }
            $cashflow = CashflowModel::where('id_order', '=', $id);
            // dd($cashflow);
            if ($cashflow != null) {
                $cashflow->update([
                    'amount' => $request->dibayar,
                    'oleh' => Auth::user()->id
                ]);
            } elseif ($cashflow == null) {
                $cash = new CashflowModel();
                $cash->id_master_cashflow = 1;
                $cash->id_order = $order->id;
                $cash->amount = $sum;
                $cash->oleh = Auth::user()->id;
                $cash->save();
            }
        }
        $order->actual = $sum;
        $order->dibayar = $request->dibayar;
        $order->oleh = Auth::user()->id;
        $order->note = $request->note;
        $order->save();

        $order_details = DB::select("select * from t_order_detail where id_order = '" . $id . "'");
        foreach ($order_details as $key => $value) {
            if ($value->total_tagihan == intval($request->detail[$key]['total_harga'])) {
                $biaya_lainnya = 0;
            } else if ($value->total_tagihan > intval($request->detail[$key]['total_harga'])) {
                $biaya_lainnya = $value->total_tagihan - intval($request->detail[$key]['total_harga']);
            } else if ($value->total_tagihan < intval($request->detail[$key]['total_harga'])) {
                $biaya_lainnya = $value->total_tagihan - intval($request->detail[$key]['total_harga']);
            }

            OrderDetailModel::where('id', '=', $value->id)->update([
                'id_mobil' => $request->detail[$key]['mobil'],
                'id_driver' => $request->detail[$key]['driver'],
                'jemput' => $request->detail[$key]['jemput'],
                'tujuan' => $request->detail[$key]['tujuan'],
                'km_awal' => $request->detail[$key]['km_awal'],
                'km_akhir' => $request->detail[$key]['km_akhir'],
                'harga_mobil' => $request->detail[$key]['carprice'],
                'harga_driver' => $request->detail[$key]['driverprice'],
                'uang_jalan' => $request->detail[$key]['jalan'],
                'bbm' => $request->detail[$key]['bbm'],
                'tol_parkir' => $request->detail[$key]['tolparkir'],
                'makan_inap' => $request->detail[$key]['makaninap'],
                'overtime' => $request->detail[$key]['overtime'],
                'biaya_titip' => $request->detail[$key]['titip'],
                'biaya_claim' => $request->detail[$key]['claim'],
                'biaya_lainnya' => $biaya_lainnya,
                'total_harga' => $request->detail[$key]['biaya'],
                'diskon' => $request->detail[$key]['diskon'],
                'ppn' => $request->detail[$key]['ppn'],
                'pph' => $request->detail[$key]['pph'],
                'total_tagihan' => $request->detail[$key]['total_harga'],
                'by' => Auth::user()->id
            ]);
        }
        Session::flash('success_msg', 'Data Updated Successfully');
        return redirect()->route('orderindex');
    }

    public function show($id)
    {

        if (Auth::check()) {
            $orders = OrderModel::find($id);
            $orderdetail = DB::select("select * from t_order_detail where id_order = '" . $id . "'");
            foreach ($orderdetail as $key => $value) {
                $date1 = date_create($value->start_date);
                $date2 = date_create($value->finish_date);
                $datediff = date_diff($date1, $date2)->format('%a');
            }
            return view('orders/show', ['orders' => $orders, 'orderdetail' => $orderdetail]);
        } else {
            return redirect()->route('login');
        }
    }

    public function invoice($id)
    {
        if (Auth::check()) {
            $data['orders'] = OrderModel::find($id);
            $data['orderdetail'] = OrderDetailModel::getbyOrder($id);
            $view = view('orders/pdf/invoice',$data);
            $html = $view->render();
            $name = 'Invoice-'.$data['orders']['id_invoice'].'/KSA-INV/'.date('m').'/'.date('Y');

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4','portrait');
            $dompdf->render();
            $dompdf->stream($name,['compress' => 1, 'Attachment' => 0]);
        } else {
            return redirect()->route('login');
        }
    }

    public function spj($id)
    {
        if (Auth::check()) {
            $data['orders'] = OrderModel::find($id);
            $data['orderdetail'] = OrderDetailModel::getbyOrder($id);
            $view = view('orders/pdf/spj',$data);
            $html = $view->render();
            $name = 'Surat Perintah Jalan-'.$data['orders']['id_invoice'].'/KSA-INV/'.date('m').'/'.date('Y');

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4','portrait');
            $dompdf->render();
            $dompdf->stream($name,['compress' => 1, 'Attachment' => 0]);
        } else {
            return redirect()->route('login');
        }
    }

    public function tiket($id)
    {
        if (Auth::check()) {
            $data['orders'] = OrderModel::find($id);
            $data['orderdetail'] = OrderDetailModel::getbyOrder($id);
            $view = view('orders/pdf/tiket',$data);
            $html = $view->render();
            $name = 'Tiket-'.$data['orders']['id_invoice'].'/KSA-INV/'.date('m').'/'.date('Y');

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A6','landscape');
            $dompdf->render();
            $dompdf->stream($name,['compress' => 1, 'Attachment' => 0]);
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id)
    {
        $orderdetail = DB::select("delete from t_order_detail where id_order = '" . $id . "'");
        CashflowModel::where('id_order', '=', $id)->update(['dihapus' => Auth::user()->id]);
        $cashflow = DB::select("delete from t_cashflow where id_order = '" . $id . "'");
        $order = OrderModel::find($id);
        $order->update(['dihapus' => Auth::user()->id]);
        $customer = CustomerModel::find($order->id_pelanggan);
        if(OrderModel::where('id_pelanggan', '=', $customer->id)->count() == 1);
        {
            $customer->status_order = 0;
            $customer->save();
        }
        $delete = OrderModel::find($id)->delete();
        return response()->json($delete);
    }
}