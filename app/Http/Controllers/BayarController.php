<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BayarRequest;
use App\Models\Bayar;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;

class BayarController extends Controller
{
    public function createBayar(){
        // $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');

        // if (Auth::user()->roles_id == 1){
        //     $bayar = Bayar::with("desa")
        //     ->with("operator")
        //     ->with("pelanggan")->get();

        // } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
        //     $bayar = Bayar::with("desa")
        //     ->with("operator")
        //     ->with("pelanggan")
        //     ->where("desa_id",Auth::user()->desa_id)->get();

        // } else if(Auth::user()->roles_id == 5){
        //     $id_pelanggan = Pelanggan::where("users_id", Auth::user()->users_id)->first();
        //     // dd($id_pelanggan->pelanggan_id);
            
        //     $bayar = Bayar::with("desa")
        //     ->with("operator")
        //     ->with("pelanggan")
        //     ->where("desa_id",Auth::user()->desa_id)
        //     ->where("pelanggan_id", $id_pelanggan->pelanggan_id)->get();
        // }
        $bayar = Bayar::with("desa")
        ->with("operator")
        ->with("pelanggan")->get();
        // dd($jabatan);
        return response([
            'data'=> $bayar
        ]);
    }

    public function viewBayar($id){
        $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');
        $bayar = Bayar::find($id);
        // dd($jabatan);
        return response([
            'message'=>'Successfully Add New Bayar.',
            'data'=> $bayar
        ]);
    }

    public function storeBayar(BayarRequest $request){
        $this->authorize('super-admin-operator');
        
        $bayarRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= Bayar::create($bayarRequest);
        
        return response([
            'message'=>'Successfully Add New Bayar.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteBayar($id){
        $this-> authorize('super-admin-operator');
        $bayar  = Bayar::find($id);
        // dd($user);
        $bayar ->delete();
        return response([
            'message'=>'Successfully Delete Bayar.',
            'success'=> true,
        ]);
    }

    public function updateBayar (BayarRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $bayar = Bayar::find($id);
        $bayar ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Bayar.',
            'success'=> true,
            'data' => $bayar,
        ], 200);
    }
}
