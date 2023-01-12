<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPetugas;
use App\Http\Requests\JadwalPetugasRequest;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;

class JadwalPetugasController extends Controller
{
    public function createJadwalPetugas(){

        // $jadwalPetugas = JadwalPetugas::with("desa")->with("petugas")->get();
        // // dd($jabatan);
        // return response([
        //     'success'=> true,
        //     'data'=> $jadwalPetugas
        // ], 200);
        
        // ----- Code view yang bener
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        if (Auth::user()->roles_id == 1){
            $jadwalPetugas = JadwalPetugas::with("desa")->with("petugas")->get();

        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 5){
            $jadwalPetugas = JadwalPetugas::with("desa")->with("petugas")->where("desa_id",Auth::user()->desa_id)->get();

        } else if(Auth::user()->roles_id == 4){
            $petugas_id = Petugas::where("users_id", Auth::user()->users_id)->first();
            // dd($petugas_id);
            
            $jadwalPetugas = JadwalPetugas::with("desa")->with("petugas")
            ->where("desa_id",Auth::user()->desa_id)
            ->where("petugas_id", $petugas_id->petugas_id)->get();
        }
        // dd($jadwalPetugas);
        return response([
            'data'=> $jadwalPetugas
        ]);
    }

    public function viewJadwalPetugas($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $jadwalPetugas = JadwalPetugas::where("jadwal_petugas_id", $id)->with("desa")->with("petugas")->first();
        // dd($jabatan);
        return response([
            'data'=> $jadwalPetugas
        ]);
    }

    public function storeJadwalPetugas(JadwalPetugasRequest $request){
        $this->authorize('super-admin-operator');
        
        $jadwalPetugasRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= JadwalPetugas::create($jadwalPetugasRequest);
        
        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteJadwalPetugas($id){
        $this-> authorize('super-admin-operator');
        $jadwalPetugas  = JadwalPetugas::find($id);
        // dd($user);
        $jadwalPetugas ->delete();
        return response([
            'message'=>'Successfully Delete JadwalPetugas.'
        ]);
    }

    public function updateJadwalPetugas (JadwalPetugasRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $jadwalPetugas = JadwalPetugas::find($id);
        $jadwalPetugas ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Jadwal Petugas.',
            'success'=> true,
            'data' => $jadwalPetugas,
        ], 200);
    }
}
