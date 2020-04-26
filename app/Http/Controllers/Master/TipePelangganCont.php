<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Master\TipePelangganModel;
use DB;
use Auth;

class TipePelangganCont extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = TipePelangganModel::get();
            return view('/master/tipe_pelanggan/data',['data' => $data]);
        }
        else {
            return redirect()->route('login');
        }
            

    }

    public function create(){
        
    }

    public function store(Request $request){

        if ($request->all()) {
            // $this->validate($request, [
            //     'nama' => 'required'
            // ]);
            $tipe = new TipePelangganModel();
            $tipe->nama_tipe_pelanggan = $request->nama;
            $tipe->save();
            return response()->json($tipe);
        } else {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){
        if ($request->all()) {
            // $this->validate($request, [
            //     'nama' => 'required'
            // ]);
            $tipe = TipePelangganModel::find($id);
            $tipe->nama_tipe_pelanggan = $request->nama;
            $tipe->save();
            return response()->json($tipe);
        } else {
            
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function delete($id){
        $tipe = TipePelangganModel::find($id)->delete();
        return response()->json($tipe);
        
    }
}