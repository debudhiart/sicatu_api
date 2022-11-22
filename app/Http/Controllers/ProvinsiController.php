<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinsiRequest;
use App\Models\Desa;
use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvinsiController extends Controller
{
    //
    public function createProvinsi(){

        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        if(Auth::user()->roles_id == 1){
            $provinsi = Provinsi::all();
            // dd($provinsi);
        }else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 4 || Auth::user()->roles_id == 5){

            // $id_pelanggan = Pelanggan::where("users_id", Auth::user()->users_id)->first();

            $id_desa = Desa::where("desa_id", Auth::user()->desa_id)->first();
            $id_kecamatan = Kecamatan::where("kecamatan_id", $id_desa->kecamatan_id)->first();
            $id_kabupaten_kota = KabupatenKota::where("kabupaten_kota_id", $id_kecamatan->kabupaten_kota_id)->first();
            
            // dd($id_kabupaten_kota->provinsi_id);
            
            // $provinsi = Provinsi::with("desa")
            // ->where("desa_id",Auth::user()->desa_id)
            // ->where("jenis_langganan_id", $id_pelanggan->jenis_langganan_id)->get();

            $provinsi = Provinsi::where("provinsi_id",$id_kabupaten_kota->provinsi_id)->get();
        }
        // dd($desa);
        return response([
            'data'=> $provinsi
        ]);
    }

    public function viewProvinsi($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $provinsi = Provinsi::find($id);
        // dd($desa);
        return response([
            'data'=> $provinsi
        ]);
    }

    public function storeProvinsi(ProvinsiRequest $request){
        $this->authorize('super-admin');

        $provinsiRequest= $request->validated();
        $data= Provinsi::create($provinsiRequest);
        // dd( $desaRequest);

        return response([
            'message'=>'Successfully Add New Provinsi.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteProvinsi($id){
        $this-> authorize('super-admin');
        $provinsi  = Provinsi::find($id);
        // dd($user);
        $provinsi ->delete();
        return response([
            'message'=>'Successfully Delete Provinsi.'
        ]);
    }

    public function updateProvinsi (ProvinsiRequest $request, $id){
        $this-> authorize('super-admin');
        // $desaRequest= $request->validated();
        
        $provinsi = Provinsi::find($id);
        $provinsi ->update($request->all());
        // dd($desa);
        return response([
            'message'=>'Successfully Update Provinsi.',
            'success'=> true,
            'data' => $provinsi,
        ], 200);
    }
}
