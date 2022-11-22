<?php

namespace App\Http\Controllers;

use App\Http\Requests\KabupatenKotaRequest;
use App\Models\Desa;
use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KabupatenKotaController extends Controller
{
    //
    public function createKabupatenKota(){

        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        if(Auth::user()->roles_id == 1){
            $kabupatenKota = KabupatenKota::with("provinsi")->get();

        }else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 4 || Auth::user()->roles_id == 5){


            $id_desa = Desa::where("desa_id", Auth::user()->desa_id)->first();
            $id_kecamatan = Kecamatan::where("kecamatan_id", $id_desa->kecamatan_id)->first();
            // $id_kabupaten_kota = KabupatenKota::where("kabupaten_kota_id", $id_kecamatan->kabupaten_kota_id)->first();
            
            // id_kecamatan->kecamatan_id

            $kabupatenKota = KabupatenKota::where("kabupaten_kota_id",$id_kecamatan->kabupaten_kota_id)->with("provinsi")->get();
            // dd($id_kecamatan->kabupaten_kota_id);
        }
        // dd($desa);
        return response([
            'data'=> $kabupatenKota
        ]);
    }

    public function viewKabupatenKota($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $kabupatenKota = KabupatenKota::find($id);
        // dd($desa);
        return response([
            'data'=> $kabupatenKota
        ]);
    }

    public function storeKabupatenKota(KabupatenKotaRequest $request){
        $this->authorize('super-admin');

        $kabupatenKotaRequest= $request->validated();
        $data= KabupatenKota::create($kabupatenKotaRequest);
        // dd( $desaRequest);

        return response([
            'message'=>'Successfully Add New Kabupaten Kota.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteKabupatenKota($id){
        $this-> authorize('super-admin');
        $kabupatenKota  = KabupatenKota::find($id);
        // dd($user);
        $kabupatenKota ->delete();
        return response([
            'message'=>'Successfully Delete Kabupaten Kota.'
        ]);
    }

    public function updateKabupatenKota(KabupatenKotaRequest $request, $id){
        $this-> authorize('super-admin');
        // $desaRequest= $request->validated();
        
        $kabupatenKota = KabupatenKota::find($id);
        $kabupatenKota ->update($request->all());
        // dd($desa);
        return response([
            'message'=>'Successfully Update Kabupaten Kota.',
            'success'=> true,
            'data' => $kabupatenKota,
        ], 200);
    }
}
