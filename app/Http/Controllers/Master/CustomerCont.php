<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\CustomerModel;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Master\TipePelangganModel;

class CustomerCont extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = CustomerModel::get()->where('status_order','=','1');
            $data2 = CustomerModel::get()->where('status_order','=','0');
            return view('/master/konsumen/data', ['data' => $data, 'data2' => $data2]);
        }
        else {
            return redirect()->route('login');
        }
            
    }

    public function create(){
        
    }

    public function store(Request $request){
        if ($request->all()) {
            // $this->validate($request,[
            //     'nama' => 'required',
            //     'alamat' => 'required',
            //     'no_telp' => 'required',
            //     'email' => 'required',
            //     'tgl_lahir' => 'required',
            //     'tipe' => 'required',
            // ]);
            $customer = new CustomerModel();
            $customer->nama_pelanggan = $request->nama;
            $customer->alamat = $request->alamat;
            $customer->no_telp = $request->no_telp;
            $customer->email = $request->email;
            $customer->tgl_lahir = $request->tgl_lahir;
            $customer->id_tipe_pelanggan = $request->tipe;
            $customer->status_order = 0;
            $customer->save();
            return response()->json($customer);
        }
        else {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        return redirect()->route('custindex');
    }

    public function edit($id){
        if (Auth::check()) {
            $data = CustomerModel::find($id);
            $tipe = TipePelangganModel::OrderBy('id','ASC')->get();
            return view('master/konsumen/edit',['data' => $data, 'tipe'=>$tipe]);
        }
        else {
            return redirect()->route('login');
        }
        
    }

    public function update(Request $request, $id){
        // $this->validate($request, [
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'telp' => 'required',
        //     'email' => 'required',
        //     'tgl_lahir' => 'required',
        //     'tipe' => 'required'
        // ]);
        $data = $request->all();
        if ($data) {
            CustomerModel::find($id)->update($data);
            Session::flash('success_msg','Data Pelanggan Berhasil Diubah!');
        }
        else {
            Session::flash('danger_msg','Data Pelanggan Gagal Diubah!');
        }
        
        return redirect()->route('custindex');
    }

    public function delete($id){
        if (Auth::check()) {
            if (CustomerModel::find($id)->delete()) {
                Session::flash('danger_msg','Data Pelanggan Berhasil Dihapus!');
            }
            else {
                Session::flash('success_msg','Data Pelanggan Gagal Dihapus!');
            }
            return redirect()->route('custindex');
        }
        else {
            return redirect()->route('login');
        }
        
    }
}
