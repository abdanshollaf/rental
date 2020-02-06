<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\VendorModel;
use Illuminate\Support\Facades\Session;
use Auth;



class VendorCont extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = VendorModel::get();
            return view('/master/vendor/data',['data' => $data]);
        }
        else {
            return redirect()->route('login');
        }
           
    }

    public function create(){
        
    }

    public function store(Request $request){

        if ($request->all()) {
            $this->validate($request, [
                'nama' => 'required',
                'alamat' => 'required',
                'pj' => 'required',
                'no_telp' => 'required'
            ]);
            $vendor = new VendorModel();
            $vendor->nama = $request->nama;
            $vendor->alamat = $request->alamat;
            $vendor->penanggungjawab = $request->pj;
            $vendor->no_telp = $request->no_telp;
            $vendor->save();
            return response()->json($vendor);
        } else {
            
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){
        if ($request->all()) {
            $this->validate($request, [
                'nama' => 'required',
                'alamat' => 'required',
                'pj' => 'required',
                'no_telp' => 'required'
            ]);
            $vendor = VendorModel::find($id);
            $vendor->nama = $request->nama;
            $vendor->alamat = $request->alamat;
            $vendor->penanggungjawab = $request->pj;
            $vendor->no_telp = $request->no_telp;
            $vendor->save();
            return response()->json($vendor);
        } else {
            
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function delete($id){
        $vendor = VendorModel::find($id)->delete();
        return response()->json($vendor);
        
    }
}
