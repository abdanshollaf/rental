<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Master\MobilModel;
use App\Models\Master\VendorModel;
use DB;
use Auth;


class MobilCont extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = MobilModel::get();
            return view('/master/mobil/data',['data' => $data]);
        }
        else {
            return redirect()->route('login');
        }
            

    }

    public function create(){

    }

    public function store(Request $request){

        if ($request->all()) {
            $this->validate($request,[
                'no_polisi' => 'required',
                'merk' => 'required',
                'tipe' => 'required',
                'vendor' => 'required',
            ]);
            $get = VendorModel::find($request['vendor'])->nama;
            $mobil = new MobilModel();
            $mobil->id_vendor = $request->vendor;
            $mobil->no_polisi = $request->no_polisi;
            $mobil->merk = $request->merk;
            $mobil->tipe = $request->tipe;
            $mobil->vendor = $get;
            $mobil->save();            
            return response()->json($mobil);
        }
        else {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){


        if ($request->all()) {
            $this->validate($request,[
                'no_polisi' => 'required',
                'merk' => 'required',
                'tipe' => 'required',
                'vendor' => 'required',
            ]);
            $get = VendorModel::find($request['vendor'])->nama;
            $mobil = MobilModel::find($id);
            $mobil->id_vendor = $request->vendor;
            $mobil->no_polisi = $request->no_polisi;
            $mobil->merk = $request->merk;
            $mobil->tipe = $request->tipe;
            $mobil->vendor = $get;
            $mobil->save();            
            return response()->json($mobil);
        }
        else {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function delete($id){
        $mobil = MobilModel::find($id)->delete();
        return response()->json($mobil);
        
    }
}
