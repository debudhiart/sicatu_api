<?php

namespace App\Http\Controllers;

use App\Http\Requests\JabatanRequest;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    public function createJabatan(){

        $jabatan = Jabatan::with("desa")->get();
        // dd($jabatan);
        return response([
            'success'=> true,
            'data'=> $jabatan
        ], 200);
        
        // ----- Code view yang bener
        // $this-> authorize('super-admin-operator-perangkat-desa');
        // if (Auth::user()->roles_id == 1){
        //     $jabatan = Jabatan::with("desa")->get();
        // } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
        //     $jabatan = Jabatan::with("desa")->where("desa_id",Auth::user()->desa_id)->get();
        // }
        // // dd($jabatan);
        // return response([
        //     'success'=> true,
        //     'data'=> $jabatan
        // ], 200);
    }

    public function viewJabatan($id){
        // $this-> authorize('super-admin-operator-perangkat-desa');
        $jabatan = Jabatan::where("jabatan_id", $id)->with("desa")->first();
        // dd($jabatan);
        return response([
            'success'=> true,
            'data'=> $jabatan
        ]);
    }

    public function storeJabatan(JabatanRequest $request){
        $this->authorize('super-admin-operator');
        
        $jabatanRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= Jabatan::create($jabatanRequest);
        
        return response([
            'message'=>'Successfully Add New Jabatan.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteJabatan($id){
        $this-> authorize('super-admin-operator');
        $jabatan  = Jabatan::find($id);
        // dd($user);
        $jabatan ->delete();
        return response([
            'message'=>'Successfully Delete Jabatan.'
        ]);
    }

    public function updateJabatan (JabatanRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $jabatan = Jabatan::find($id);
        $jabatan ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Jabatan.',
            'success'=> true,
            'data' => $jabatan,
        ], 200);
    }
    
}
