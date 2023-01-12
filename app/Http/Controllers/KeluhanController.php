<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluhan;
use App\Http\Requests\KeluhanRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;

class KeluhanController extends Controller
{
    public function createKeluhan(){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');

        if (Auth::user()->roles_id == 1){
            $keluhan = Keluhan::with("desa")->with("pelanggan")
            ->get();

        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 4){
            $keluhan = Keluhan::with("desa")->with("pelanggan")
            ->where("desa_id",Auth::user()->desa_id)->get();

        }else if(Auth::user()->roles_id == 5){
            $id_pelanggan = Pelanggan::where("users_id", Auth::user()->users_id)->first();
            
            $keluhan = Keluhan::
            with("desa")->with("pelanggan")
            ->where("desa_id",Auth::user()->desa_id)
            ->where("pelanggan_id", $id_pelanggan->pelanggan_id)->get();
        }

        // $keluhan = Keluhan::with("desa")->with("pelanggan")->get();
        // dd($jabatan);
        return response([
            'data'=> $keluhan
        ]);
    }

    public function viewKeluhan($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $keluhan = Keluhan::where("keluhan_id", $id)->with("desa")->with("pelanggan")->first();
        // dd($jabatan);
        return response([
            'data'=> $keluhan
        ]);
    }

    public function storeKeluhan(KeluhanRequest $request){
        $this->authorize('super-admin-operator-pelanggan');
        
        $keluhanRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= Keluhan::create($keluhanRequest);
        
        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteKeluhan($id){
        $this-> authorize('super-admin-operator-pelanggan');
        $keluhan  = Keluhan::find($id);
        // dd($user);
        $keluhan ->delete();
        return response([
            'message'=>'Successfully Delete Keluhan.'
        ]);
    }

    public function updateKeluhan(KeluhanRequest $request, $id){
        $this-> authorize('super-admin-operator-petugas-pelanggan');
        // $desaRequest= $request->validated();
        
        $keluhan = Keluhan::find($id);
        $keluhan ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Keluhan.',
            'success'=> true,
            'data' => $keluhan,
        ], 200);
    }
    public function verificationKeluhan(KeluhanRequest $request, $id){
        $this-> authorize('super-admin-operator');
        $keluhan = Keluhan::find($id);
        // $keluhan ->update($request->all());
        $keluhan->status_keluhan = $request->status_keluhan;
        $keluhan->save();
        // dd($keluhan->status_keluhan);
        return response([
            'message'=>'Successfully Merubah Status Keluhan.',
            'success'=> true,
            'data' => $keluhan,
        ], 200);        
    }

    public function responKeluhan(KeluhanRequest $request, $id){
        $this-> authorize('super-admin-operator-petugas');
        $keluhan = Keluhan::find($id);
        $keluhan->respon = $request->respon;
        $keluhan->save();
        // dd($request);
        return response([
            'message'=>'Successfully Update Keluhan.',
            'success'=> true,
            'data' => $keluhan,
        ], 200);   
    }

    public function uploadFotoBukti(KeluhanRequest $request, $id){
        $this-> authorize('super-admin-operator-petugas');
        $keluhan = Keluhan::find($id);
        $keluhan->before_photo = $request->before_photo;
        $keluhan->after_photo = $request->after_photo;
        $keluhan->lat = $request->lat;
        $keluhan->lng = $request->lng;
        $keluhan->save();
        return response([
            'message'=>'Successfully Upload Photo.',
            'success'=> true,
            'data' => $keluhan,
        ], 200);   
    }

}
