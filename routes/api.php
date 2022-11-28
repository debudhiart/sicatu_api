<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\JadwalPetugasController;
use App\Http\Controllers\JenisLanggananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JadwalPelangganController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenKotaController;
use App\Http\Controllers\KecamatanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);


Route::get('/user', [UserController::class,'createUser']);
Route::post('/user/store', [UserController::class,'storeUser']);

// Route::post('/logout',[AuthController::class,'logout']);

//Route CRUD Data Desa
Route::get('/desa', [DesaController::class,'createDesa']);
Route::get('/desa/{id}', [DesaController::class,'viewDesa']);
Route::post('/desa/store', [DesaController::class,'storeDesa']);
Route::post('/desa/delete/{id}', [DesaController::class,'deleteDesa']);
Route::post('/desa/update/{id}', [DesaController::class,'updateDesa']);




// Route::group(['middleware'=>['auth:sanctum']],function(){
    
    Route::post('/logout', [AuthController::class,'logout']);
    
    
    //Route CRUD User
    Route::post('/user/delete/{id}', [UserController::class,'deleteUser']);
    
    
    //Route CRUD Data Jabatan
    Route::get('/jabatan', [JabatanController::class,'createJabatan']);
    Route::get('/jabatan/{id}', [JabatanController::class,'viewJabatan']);
    Route::post('/jabatan/store', [JabatanController::class,'storeJabatan']);
    Route::post('/jabatan/delete/{id}', [JabatanController::class,'deleteJabatan']);
    Route::post('/jabatan/update/{id}', [JabatanController::class,'updateJabatan']);
    
    
    //Route CRUD Data Operator
    Route::get('/operator', [OperatorController::class,'createOperator']);
    Route::get('/operator/{id}', [OperatorController::class,'viewOperator']);
    Route::post('/operator/store', [OperatorController::class,'storeOperator']);
    Route::post('/operator/delete/{id}', [OperatorController::class,'deleteOperator']);
    Route::post('/operator/update/{id}', [OperatorController::class,'updateOperator']);


    //Route CRUD Data Shift
    Route::get('/shift', [ShiftController::class,'createShift']);
    Route::get('/shift/{id}', [ShiftController::class,'viewShift']);
    Route::post('/shift/store', [ShiftController::class,'storeShift']);
    Route::post('/shift/delete/{id}', [ShiftController::class,'deleteShift']);
    Route::post('/shift/update/{id}', [ShiftController::class,'updateShift']);

    //Route CRUD Data Petugas
    Route::get('/petugas', [PetugasController::class,'createPetugas']);
    Route::get('/petugas/{id}', [PetugasController::class,'viewPetugas']);
    Route::post('/petugas/store', [PetugasController::class,'storePetugas']);
    Route::post('/petugas/delete/{id}', [PetugasController::class,'deletePetugas']);
    Route::post('/petugas/update/{id}', [PetugasController::class,'updatePetugas']);

    //Route CRUD Data Jadwal Petugas
    Route::get('/jadwal-petugas', [JadwalPetugasController::class,'createJadwalPetugas']);
    Route::get('/jadwal-petugas/{id}', [JadwalPetugasController::class,'viewJadwalPetugas']);
    Route::post('/jadwal-petugas/store', [JadwalPetugasController::class,'storeJadwalPetugas']);
    Route::post('/jadwal-petugas/delete/{id}', [JadwalPetugasController::class,'deleteJadwalPetugas']);
    Route::post('/jadwal-petugas/update/{id}', [JadwalPetugasController::class,'updateJadwalPetugas']);

    //Route CRUD Data Jenis Langganan
    Route::get('/jenis-langganan', [JenisLanggananController::class,'createJenisLangganan']);
    Route::get('/jenis-langganan/{id}', [JenisLanggananController::class,'viewJenisLangganan']);
    Route::post('/jenis-langganan/store', [JenisLanggananController::class,'storeJenisLangganan']);
    Route::post('/jenis-langganan/delete/{id}', [JenisLanggananController::class,'deleteJenisLangganan']);
    Route::post('/jenis-langganan/update/{id}', [JenisLanggananController::class,'updateJenisLangganan']);

    //Route CRUD Data Pelanggan
    Route::get('/pelanggan', [PelangganController::class,'createPelanggan']);
    Route::get('/pelanggan/{id}', [PelangganController::class,'viewPelanggan']);
    Route::post('/pelanggan/store', [PelangganController::class,'storePelanggan']);
    Route::post('/pelanggan/delete/{id}', [PelangganController::class,'deletePelanggan']);
    Route::post('/pelanggan/update/{id}', [PelangganController::class,'updatePelanggan']);

    //Route CRUD Data Jadwal Pelanggan
    Route::get('/jadwal-pelanggan', [JadwalPelangganController::class,'createJadwalPelanggan']);
    Route::get('/jadwal-pelanggan/{id}', [JadwalPelangganController::class,'viewJadwalPelanggan']);
    Route::post('/jadwal-pelanggan/store', [JadwalPelangganController::class,'storeJadwalPelanggan']);
    Route::post('/jadwal-pelanggan/delete/{id}', [JadwalPelangganController::class,'deleteJadwalPelanggan']);
    Route::post('/jadwal-pelanggan/update/{id}', [JadwalPelangganController::class,'updateJadwalPelanggan']);

    //Route CRUD Data Bayar
    Route::get('/bayar', [BayarController::class,'createBayar']);
    Route::get('/bayar/{id}', [BayarController::class,'viewBayar']);
    Route::post('/bayar/store', [BayarController::class,'storeBayar']);
    Route::post('/bayar/delete/{id}', [BayarController::class,'deleteBayar']);
    Route::post('/bayar/update/{id}', [BayarController::class,'updateBayar']);

    //Route CRUD Data Keluhan
    Route::get('/keluhan', [KeluhanController::class,'createKeluhan']);
    Route::get('/keluhan/{id}', [KeluhanController::class,'viewKeluhan']);
    Route::post('/keluhan/store', [KeluhanController::class,'storeKeluhan']);
    Route::post('/keluhan/delete/{id}', [KeluhanController::class,'deleteKeluhan']);
    Route::post('/keluhan/update/{id}', [KeluhanController::class,'updateKeluhan']);

    Route::post('/keluhan/verification-keluhan/{id}', [KeluhanController::class,'verificationKeluhan']);
    Route::post('/keluhan/respon-keluhan/{id}', [KeluhanController::class,'responKeluhan']);
    Route::post('/keluhan/upload-foto-bukti/{id}', [KeluhanController::class,'uploadFotoBukti']);

    
// });
//Route CRUD Data Provinsi
Route::get('/provinsi', [ProvinsiController::class,'createProvinsi']);
Route::get('/provinsi/{id}', [ProvinsiController::class,'viewProvinsi']);
Route::post('/provinsi/store', [ProvinsiController::class,'storeProvinsi']);
Route::post('/provinsi/delete/{id}', [ProvinsiController::class,'deleteProvinsi']);
Route::post('/provinsi/update/{id}', [ProvinsiController::class,'updateProvinsi']);

 //Route CRUD Data Kabuaten Kota
Route::get('/kabupaten-kota', [KabupatenKotaController::class,'createKabupatenKota']);
Route::get('/kabupaten-kota/{id}', [KabupatenKotaController::class,'viewKabupatenKota']);
Route::post('/kabupaten-kota/store', [KabupatenKotaController::class,'storeKabupatenKota']);
Route::post('/kabupaten-kota/delete/{id}', [KabupatenKotaController::class,'deleteKabupatenKota']);
Route::post('/kabupaten-kota/update/{id}', [KabupatenKotaController::class,'updateKabupatenKota']);

//Route CRUD Data Kecamatan
Route::get('/kecamatan', [KecamatanController::class,'createKecamatan']);
Route::get('/kecamatan/{id}', [KecamatanController::class,'viewKecamatan']);
Route::post('/kecamatan/store', [KecamatanController::class,'storeKecamatan']);
Route::post('/kecamatan/delete/{id}', [KecamatanController::class,'deleteKecamatan']);
Route::post('/kecamatan/update/{id}', [KecamatanController::class,'updateKecamatan']);