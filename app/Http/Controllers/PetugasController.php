<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Http\Requests\PetugasRequest;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    //
    public function createPetugas(){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas');
        if (Auth::user()->roles_id == 1){
            $petugas = Petugas::with("desa")->get();

        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
            $petugas = Petugas::with("desa")
            ->where("desa_id",Auth::user()->desa_id)->get();

        } else if(Auth::user()->roles_id == 4){
            $id_petugas = Petugas::where("users_id", Auth::user()->users_id)->first();
            
            $petugas = Petugas::
            with("desa")
            ->where("desa_id",Auth::user()->desa_id)
            ->where("petugas_id", $id_petugas->petugas_id)->get();
        }


        // $petugas = Petugas::all();
        // dd($operator);
        return response([
            'data'=> $petugas
        ]);
    }

    public function viewPetugas($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas');
        $petugas = Petugas::find($id);
        // dd($operator);
        return response([
            'data'=> $petugas
        ]);
    }


    public function storePetugas(PetugasRequest $request){
        $this->authorize('super-admin-operator');

        $petugasRequest= $request->validated();
        $data= Petugas::create($petugasRequest);

        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deletePetugas($id){
        $this-> authorize('super-admin-operator');
        $petugas  =Petugas::find($id);
        // dd($user);
        $petugas ->delete();
        return response([
            'message'=>'Successfully Delete Petugas.'
        ]);
    }

    public function updatePetugas (PetugasRequest $request, $id){
        $this-> authorize('super-admin-operator-petugas');
        // $desaRequest= $request->validated();
        
        $petugas = Petugas::find($id);
        $petugas ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Petugas.',
            'success'=> true,
            'data' => $petugas,
        ], 200);
    }
}
