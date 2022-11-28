<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JadwalPelangganRequest;
use App\Models\JadwalPelanggan;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class JadwalPelangganController extends Controller
{
    public function createJadwalPelanggan(){

        $jadwalPelanggan = JadwalPelanggan::with("desa")->with("pelanggan")->get();
        // dd($jabatan);
        return response([
            'success'=> true,
            'data'=> $jadwalPelanggan
        ], 200);
        
        // ----- Code view yang bener


        // $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');
        // if (Auth::user()->roles_id == 1){
        //     $jadwalPelanggan = JadwalPelanggan::with("desa")->get();
        // } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
        //     $jadwalPelanggan = JadwalPelanggan::with("desa")->where("desa_id",Auth::user()->desa_id)->get();
        // } else if(Auth::user()->roles_id == 5){
        //     $id_pelanggan = Pelanggan::where("users_id", Auth::user()->users_id)->first();
            
        //     $jadwalPelanggan = JadwalPelanggan::with("desa")
        //     ->where("desa_id",Auth::user()->desa_id)
        //     ->where("pelanggan_id", $id_pelanggan->pelanggan_id)->get();
        // }
        // // dd($jabatan);
        // return response([
        //     'data'=> $jadwalPelanggan
        // ]);
    }

    public function viewJadwalPelanggan($id){
        $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');
        $jadwalPelanggan = JadwalPelanggan::find($id);
        // dd($jabatan);
        return response([
            'data'=> $jadwalPelanggan
        ]);
    }

    public function storeJadwalPelanggan(JadwalPelangganRequest $request){
        // $this->authorize('super-admin-operator');
        
        $jadwalPelangganRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= JadwalPelanggan::create($jadwalPelangganRequest);
        
        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteJadwalPelanggan($id){
        $this-> authorize('super-admin-operator');
        $jadwalPelanggan  = JadwalPelanggan::find($id);
        // dd($user);
        $jadwalPelanggan ->delete();
        return response([
            'message'=>'Successfully Delete Jadwal Pelanggan.'
        ]);
    }

    public function updateJadwalPelanggan (JadwalPelangganRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $jadwalPelanggan = JadwalPelanggan::find($id);
        $jadwalPelanggan ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Jadwal Pelanggan.',
            'success'=> true,
            'data' => $jadwalPelanggan,
        ], 200);
    }
}
