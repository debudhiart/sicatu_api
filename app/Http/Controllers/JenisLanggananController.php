<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisLangganan;
use App\Http\Requests\JenisLanggananRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;

class JenisLanggananController extends Controller
{
    public function createJenisLangganan(){
        $jenisLangganan = JenisLangganan::with("desa")->get();
        // dd($jabatan);
        return response([
            'success'=> true,
            'data'=> $jenisLangganan
        ], 200);
        
        // $this-> authorize('super-admin-operator-perangkat-desa-pelanggan');
        // if(Auth::user()->roles_id == 1){
        //     $jenisLangganan = JenisLangganan::with("desa")->get();

        // }else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
        //     $jenisLangganan = JenisLangganan::with("desa")->where("desa_id",Auth::user()->desa_id)->get();

        // }else if (Auth::user()->roles_id == 5){
        //     $id_pelanggan = Pelanggan::where("users_id", Auth::user()->users_id)->first();
            
        //     // dd($id_pelanggan);
            
        //     $jenisLangganan = JenisLangganan::with("desa")
        //     ->where("desa_id",Auth::user()->desa_id)
        //     ->where("jenis_langganan_id", $id_pelanggan->jenis_langganan_id)->get();

        // }
        // // dd($jabatan);
        // return response([
        //     'data'=> $jenisLangganan
        // ]);
    }

    public function viewJenisLangganan($id){
        $this-> authorize('super-admin-operator-perangkat-desa');
        $jenisLangganan = JenisLangganan::find($id);
        // dd($jabatan);
        return response([
            'data'=> $jenisLangganan
        ]);
    }

    public function storeJenisLangganan(JenisLanggananRequest $request){
        $this->authorize('super-admin-operator');
        
        $jenisLanggananRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= JenisLangganan::create($jenisLanggananRequest);
        
        return response([

            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteJenisLangganan($id){
        $this-> authorize('super-admin-operator');
        $jenisLangganan  = JenisLangganan::find($id);
        // dd($user);
        $jenisLangganan ->delete();
        return response([
            'message'=>'Successfully Delete Jenis Langganan.'
        ]);
    }

    public function updateJenisLangganan (JenisLanggananRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $jenisLangganan = jenisLangganan::find($id);
        $jenisLangganan ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Jenis Langganan.',
            'success'=> true,
            'data' => $jenisLangganan,
        ], 200);
    }
}
