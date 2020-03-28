<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\Master\DriverModel;
use DB;
use Response;
use Auth;
use Validator;


class DriverCont extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data = DriverModel::get();
            return view('/master/driver/data',['data' => $data]);
        }
        else {
            return redirect()->route('login');
        }
            

    }

    public function show(){
        
    }

    public function create(){

    }

    public function store(Request $request){

        if ($request->all()) {
            // $this->validate($request, [
            //     'nama' => 'required',
            //     'no_telp' => 'required'
            // ]);;
            $driver = new DriverModel();
            $driver->nama = $request->nama;
            $driver->no_telp = $request->no_telp;
            $driver->no_ktp = $request->no_ktp;
            $driver->sim =  $request->sim;
            // $driver->foto = $request->file('foto')->move(public_path().'/upload/','foto/', $request->file('foto')->getClientOriginalName('foto'));
            $driver->save();
            return response()->json($driver);
        } else {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function edit($id){
        if (Auth::check()) {
            $data = DriverModel::find($id);
            return view('master/driver/edit',['data' => $data]);
        }
        else {
            return redirect()->route('login');
        }
        
    }

    public function update(Request $request, $id){

        
        if ($request->all()) {
            // $this->validate($request, [
            //     'nama' => 'required',
            //     'no_telp' => 'required'
            // ]);
            $driver = DriverModel::find($id);
            $driver->nama = $request->nama;
            $driver->no_telp = $request->no_telp;
            $driver->no_ktp = $request->no_ktp;
            $driver->sim =  $request->sim;
            // $driver->foto = $request->file('foto')->move(public_path().'/upload/','foto/', $request->file('foto')->getClientOriginalName('foto'));
            $driver->save();
            return response()->json($driver);
        } else {
            
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    public function delete($id){
        $driver = DriverModel::find($id);
        unlink($driver->foto);
        $driver->delete();
        return response()->json($driver);
    }
}
