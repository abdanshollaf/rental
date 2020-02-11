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
            $order->status = 0;
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
        $sum = 0;
        foreach($request->detail as $key=>$item){
            $sum += $item['harga'];
        }
           
            $order = OrderModel::find($id);
            $order->status = 0;
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
    }
    
    public function show($id){

    }

    public function delete(){

    }


}
