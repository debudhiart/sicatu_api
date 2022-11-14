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
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        if (Auth::user()->roles_id == 1){
            $jadwalPetugas = JadwalPetugas::all();

        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 5){
            $jadwalPetugas = JadwalPetugas::with("desa")->where("desa_id",Auth::user()->desa_id)->get();

        } else if(Auth::user()->roles_id == 4){
            $id_petugas = Petugas::where("users_id", Auth::user()->users_id)->first();
            // dd(Auth::user()->desa_id);
            
            $jadwalPetugas = JadwalPetugas::with("desa")
            ->where("desa_id",Auth::user()->desa_id)
            ->where("petugas_id", $id_petugas->petugas_id)->get();
        }
        // dd($jabatan);
        return response([
            'data'=> $jadwalPetugas
        ]);
    }

    public function viewJadwalPetugas($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $jadwalPetugas = JadwalPetugas::find($id);
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
