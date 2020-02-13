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
use Session;
use DB;

class OrderCont extends Controller
{
    public function index(){
        if (Auth::check()) {
            $order = OrderModel::get();
            // dd($order);
            return view('orders/data',['order' => $order]);
        }
        else {
            return redirect()->route('login');
        }
    }

    public function create(){
        if (Auth::check()) {
            $tipe = TipePelangganModel::get();
            $mobil = MobilModel::get();
            $driver = DriverModel::get();
            return view('orders/add',['tipe'=>$tipe, 'mobil'=>$mobil,'driver'=>$driver]);
        }
        else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request){
        //// added check line 42-45; 84
        // dd($request->all());
        $sum = 0;
        foreach($request->detail as $key=>$item){
            $sum += $item['harga'];
        }

        // if ($request->all()) {
        //     $this->validate($request, [
        //         'nama' => 'required',
        //         'tipe' => 'required',
        //         'email' => 'required',
        //         'telp' => 'required',
        //         'alamat' => 'required',
        //         'tgl_lahir' => 'required',
        //         'mobil[]' => 'required',
        //         'driver[]' => 'required',
        //         'jemput[]' => 'required',
        //         'tujuan[]' => 'required',
        //         'start_date[]' => 'required',
        //         'end_date[]' => 'required',
        //         'start_time[]' => 'required',
        //         'end_time[]' => 'required',
        //         'harga[]' => 'required'
        //     ]);
            
            //dd($sum);

            $customer = new CustomerModel();
            $customer->nama_pelanggan = $request->nama;
            $customer->email = $request->email;
            $customer->tgl_lahir = $request->tgl_lahir;
            $customer->alamat = $request->alamat;
            $customer->no_telp = intval($request->telp);
            $customer->id_tipe_pelanggan = $request->tipe;
            $customer->status_order = '1';
            $customer->save();
           
            $order = new OrderModel();
            $order->id_tipe_pelanggan = $request->tipe;
            $order->id_pelanggan = $customer->id;
            $order->nama_pelanggan = $request->nama;
            $order->no_telp = intval($request->telp);
            $order->email = $request->email;
            $order->dibayar = $request->dibayar;
            if ($request->dibayar == $sum) {
                $order->status = 1;
            }
            elseif ($request->dibayar <= $sum) {
                if ($request->dibayar == 0) {
                    $order->status = 0;
                }
                else {
                    $order->status = 2;
                }
            }
            $order->estimated = $sum;
            $order->actual = $sum;
            $order->save();


            foreach ($request->detail as $key => $value) {
                $order_detail = new OrderDetailModel();
                $order_detail->id_order = $order->id;
                $order_detail->id_tipe_pelanggan = $request->tipe;
                $order_detail->no_telp = intval($request->telp);
                $order_detail->id_pelanggan = $customer->id;
                $order_detail->id_driver = $value['driver'];
                $order_detail->start_date = date('y-m-d', strtotime($value['start_date']));
                $order_detail->finish_date = date('y-m-d', strtotime($value['end_date']));
                $order_detail->jemput = $value['jemput'];
                $order_detail->tujuan = $value['tujuan'];
                $order_detail->start_time = date('H:i', strtotime($value['start_time']));
                $order_detail->finish_time = date('H:i', strtotime($value['end_time']));
                $order_detail->id_mobil = $value['mobil'];
                $order_detail->harga_mobil = 0;
                $order_detail->harga_driver = 0;
                $order_detail->uang_jalan = 0;
                $order_detail->bbm = 0;
                $order_detail->tol_parkir = 0;
                $order_detail->makan_inap = 0;
                $order_detail->overtime = 0;
                $order_detail->biaya_titip = 0;
                $order_detail->biaya_lainnya = 0;
                $order_detail->total_harga = 0;
                $order_detail->diskon = 0;
                $order_detail->ppn = 0;
                $order_detail->pph = 0;
                $order_detail->total_tagihan = intval($value['harga']);
                $order_detail->save();
            }

            Session::flash('success_msg','Data Added Successfully');
            return redirect()->route('orderindex');
        // } else {
        //     return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        // }
    }

    public function edit($id){
        if (Auth::check()) {
            $orders = DB::select("select * from t_order where id = '".$id."'");
            $pelanggan = DB::select("select * from t_pelanggan where id = '".$orders[0]->id_pelanggan."' ");
            $tipe = TipePelangganModel::get();
            $mobil = MobilModel::get();
            $driver = DriverModel::get();
            $orderdetail = DB::select("select * from t_order_detail where id_order = '".$id."'");
            // dd($pelanggan);
            return view('orders/edit', ['pelanggan'=>$pelanggan, 'orderdetail' => $orderdetail, 'orders' => $orders, 'tipe' => $tipe, 'mobil' => $mobil, 'driver' => $driver]);
        }
        else {
            return redirect()->route('login');
        }
        
    }

    public function update($id, Request $request){
        // dd($request->all());
        $sum = 0;
        foreach($request->detail as $key=>$item){
            $sum += $item['total_harga'];
        }
        //dd($sum);
           
            $order = OrderModel::find($id);
            if ($request->dibayar == $sum) {
                $order->status = 1;
            }
            else if ($request->dibayar <= $sum) {
                if ($request->dibayar == 0) {
                    $order->status = 0;
                }
                else {
                    $order->status = 2;
                }
            }
            $order->actual = $sum;
            $order->dibayar = $request->dibayar;
            $order->by = Auth::user()->name;
            $order->save();

            $order_details = DB::select("select * from t_order_detail where id_order = '".$id."'");
            //dd($order_details);
            foreach ($order_details as $key => $value) {
                if ($value->total_tagihan == intval($request->detail[$key]['total_harga'])) {
                    $biaya_lainnya = 0;
                }
                else if ($value->total_tagihan > intval($request->detail[$key]['total_harga'])) {
                    $biaya_lainnya = $value->total_tagihan - intval($request->detail[$key]['total_harga']);
                }
                else if ($value->total_tagihan < intval($request->detail[$key]['total_harga'])) {
                    $biaya_lainnya = $value->total_tagihan - intval($request->detail[$key]['total_harga']);
                }
                
                OrderDetailModel::where('id', '=', $value->id)->update(['id_mobil' => $request->detail[$key]['mobil'],
                        'id_driver' => $request->detail[$key]['driver'],
                        'jemput' => $request->detail[$key]['jemput'],
                        'tujuan' => $request->detail[$key]['tujuan'],
                        'harga_mobil' => $request->detail[$key]['carprice'],
                        'harga_driver' => $request->detail[$key]['driverprice'],
                        'uang_jalan' => $request->detail[$key]['jalan'],
                        'bbm' => $request->detail[$key]['bbm'],
                        'tol_parkir' => $request->detail[$key]['tolparkir'],
                        'makan_inap' => $request->detail[$key]['makaninap'],
                        'overtime' => $request->detail[$key]['overtime'],
                        'biaya_titip' => $request->detail[$key]['titip'],
                        'biaya_lainnya' => $biaya_lainnya,
                        'total_harga' => $request->detail[$key]['biaya'],
                        'diskon' => $request->detail[$key]['diskon'],
                        'ppn' => $request->detail[$key]['ppn'],
                        'pph' => $request->detail[$key]['pph'],
                        'total_tagihan' => $request->detail[$key]['total_harga']]);
                // $value->id_mobil = $request->detail[$key]['mobil'];
                // $value->id_driver = $request->detail[$key]['driver'];
                // $value->jemput = $request->detail[$key]['jemput'];
                // $value->tujuan = $request->detail[$key]['tujuan'];
                // $value->harga_mobil = intval($request->detail[$key]['carprice']);
                // $value->harga_driver = intval($request->detail[$key]['driverprice']);
                // $value->uang_jalan = intval($request->detail[$key]['jalan']);
                // $value->bbm = intval($request->detail[$key]['bbm']);
                // $value->tol_parkir = intval($request->detail[$key]['tolparkir']);
                // $value->makan_inap = intval($request->detail[$key]['makaninap']);
                // $value->overtime = intval($request->detail[$key]['overtime']);
                // $value->biaya_titip = intval($request->detail[$key]['titip']);
                // if ($value->total_tagihan == intval($request->detail[$key]['total_harga'])) {
                //     $value->biaya_lainnya = 0;
                // }
                // if ($value->total_tagihan > intval($request->detail[$key]['total_harga'])) {
                //     $value->biaya_lainnya = $value->total_tagihan - intval($request->detail[$key]['total_harga']);
                // }
                // if ($value->total_tagihan < intval($request->detail[$key]['total_harga'])) {
                //     $value->biaya_lainnya = intval($request->detail[$key]['total_harga']) - $value->total_tagihan;
                // }
                // $value->total_harga = intval($request->detail[$key]['biaya']);
                // $value->diskon = intval($request->detail[$key]['diskon']);
                // $value->ppn = intval($request->detail[$key]['ppn']);
                // $value->pph = intval($request->detail[$key]['pph']);
                // $value->total_tagihan = intval($request->detail[$key]['total_harga']);
                // $order_details[$key]->save();
            }
            // dd($biaya_lainnya);
            Session::flash('success_msg','Data Added Successfully');
            return redirect()->route('orderindex');
    }
    
    public function show($id){

    }

    public function delete($id){
        $orderdetail= DB::select("delete from t_order_detail where id_order = '".$id."'");
        $order = OrderModel::find($id);
        $order->dihapus = Auth::user()->name;
        $order->save();
        $delete = OrderModel::find($id)->delete();
        return response()->json($delete);
    }


}
