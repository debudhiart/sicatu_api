<?php

namespace App\Http\Controllers;

use App\Http\Requests\KecamatanRequest;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KecamatanController extends Controller
{
    //
    public function createKecamatan(){

        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        if(Auth::user()->roles_id == 1){
            $kecamatan = Kecamatan::with("kabupatenKota")->get();

        }else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3 || Auth::user()->roles_id == 4 || Auth::user()->roles_id == 5){


            $id_desa = Desa::where("desa_id", Auth::user()->desa_id)->first();
            // $id_kecamatan = Kecamatan::where("kecamatan_id", $id_desa->kecamatan_id)->first();
            // $id_kabupaten_kota = KabupatenKota::where("kabupaten_kota_id", $id_kecamatan->kabupaten_kota_id)->first();
            
            // id_kecamatan->kecamatan_id

            $kecamatan = Kecamatan::where("kecamatan_id",$id_desa->kecamatan_id)->with("kabupatenKota")->get();
            // dd($kecamatan);
        }
        // dd($desa);
        return response([
            'data'=> $kecamatan
        ]);
    }

    public function viewKecamatan($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $kecamatan = Kecamatan::find($id);
        // dd($desa);
        return response([
            'data'=> $kecamatan
        ]);
    }

    public function storeKecamatan(KecamatanRequest $request){
        $this->authorize('super-admin');

        $kecamatanRequest= $request->validated();
        $data= Kecamatan::create($kecamatanRequest);
        // dd( $desaRequest);

        return response([
            'message'=>'Successfully Add New Kecamatan.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteKecamatan($id){
        $this-> authorize('super-admin');
        $kecamatan  = Kecamatan::find($id);
        // dd($user);
        $kecamatan ->delete();
        return response([
            'message'=>'Successfully Delete Kecamatan.'
        ]);
    }

    public function updateKecamatan(KecamatanRequest $request, $id){
        $this-> authorize('super-admin');
        // $desaRequest= $request->validated();
        
        $kecamatan = Kecamatan::find($id);
        $kecamatan ->update($request->all());
        // dd($desa);
        return response([
            'message'=>'Successfully Update Kecamatan.',
            'success'=> true,
            'data' => $kecamatan,
        ], 200);
    }
}
