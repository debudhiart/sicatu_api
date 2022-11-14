<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Http\Requests\PelangganRequest;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function createPelanggan(){
        $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');

        if (Auth::user()->roles_id == 1){
            $pelanggan = Pelanggan::with("desa")
            ->with("jenisLangganan")->get();

        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
            $pelanggan = Pelanggan::with("desa")
            ->with("jenisLangganan")
            ->where("desa_id",Auth::user()->desa_id)->get();

        } else if(Auth::user()->roles_id == 5){
            $id_pelanggan = Pelanggan::where("users_id", Auth::user()->users_id)->first();
            
            $pelanggan = Pelanggan::
            with("desa")
            ->with("jenisLangganan")
            ->where("desa_id",Auth::user()->desa_id)
            ->where("pelanggan_id", $id_pelanggan->pelanggan_id)->get();
        }


        // $pelanggan = Pelanggan::all();
        // dd($pelanggan);
        return response([
            'data'=> $pelanggan
        ]);
    }

    public function viewPelanggan($id){
        $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');
        $pelanggan = Pelanggan::find($id);
        // dd($operator);
        return response([
            'data'=> $pelanggan
        ]);
    }


    public function storePelanggan(PelangganRequest $request){
        $this->authorize('super-admin-operator');

        $pelangganRequest= $request->validated();
        $data= Pelanggan::create($pelangganRequest);

        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deletePelanggan($id){
        $this-> authorize('super-admin-operator-pelanggan');
        $pelanggan  = Pelanggan::find($id);
        // dd($user);
        $pelanggan ->delete();
        return response([
            'message'=>'Successfully Delete Pelanggan.'
        ]);
    }

    public function updatePelanggan (PelangganRequest $request, $id){
        $this-> authorize('super-admin-operator-pelanggan');
        // $desaRequest= $request->validated();
        
        $pelanggan = Pelanggan::find($id);
        $pelanggan ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Pelanggan.',
            'success'=> true,
            'data' => $pelanggan,
        ], 200);
    }
}
