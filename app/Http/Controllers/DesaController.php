<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesaRequest;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesaController extends Controller
{
    //
    public function createDesa(){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        if(Auth::user()->roles_id == 1){
            $desa = Desa::all();
        }else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 4 || Auth::user()->roles_id == 5){
            $desa = Desa::where("desa_id",Auth::user()->desa_id)->get();
        }
        // dd($desa);
        return response([
            'data'=> $desa
        ]);
    }

    public function viewDesa($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $desa = Desa::find($id);
        // dd($desa);
        return response([
            'data'=> $desa
        ]);
    }

    public function storeDesa(DesaRequest $request){
        $this->authorize('super-admin');

        $desaRequest= $request->validated();
        $data= Desa::create($desaRequest);

        return response([
            'message'=>'Successfully Add New Desa.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteDesa($id){
        $this-> authorize('super-admin');
        $desa  = Desa::find($id);
        // dd($user);
        $desa ->delete();
        return response([
            'message'=>'Successfully Delete Desa.'
        ]);
    }

    public function updateDesa (DesaRequest $request, $id){
        $this-> authorize('super-admin');
        // $desaRequest= $request->validated();
        
        $desa = Desa::find($id);
        $desa ->update($request->all());
        // dd($desa);
        return response([
            'message'=>'Successfully Update Desa.',
            'success'=> true,
            'data' => $desa,
        ], 200);
    }
}
