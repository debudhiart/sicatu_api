<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;
use App\Models\Petugas;

class AuthController extends Controller
{
    
    public function register ( RegisterRequest $request ) {
        // $this-> authorize('super-admin');
        $user = $request->validated();

        $user['password'] = Hash::make($request->password);
        // dd($user);
        $usercreate=User::create ($user);
        if($usercreate->roles_id == 5){
            $pelanggan = new Pelanggan;
            $pelanggan->users_id = $usercreate->users_id;
            $pelanggan->desa_id = $usercreate->desa_id;
            $pelanggan->nama_pelanggan = $usercreate->nama;
            $pelanggan->alamat = $usercreate->address;
            $pelanggan->save();
            return response([
                'message'=>'Successfully Add New Pelanggan.',
                'success'=> true,
                'data' => $usercreate,
            ], 200);
            // return response ($usercreate);
        }else if($usercreate->roles_id == 4){
            $petugas = new Petugas;
            $petugas->users_id = $usercreate->users_id;
            $petugas->desa_id = $usercreate->desa_id;
            $petugas->nama_petugas = $usercreate->nama;
            $petugas->alamat = $usercreate->address;
            $petugas->save();
            return response([
                'message'=>'Successfully Add New Petugas.',
                'success'=> true,
                'data' => $usercreate,
            ], 200);
            // return response ($usercreate);
        }else if($usercreate->roles_id == 3){
            $operator = new Operator();
            $operator->users_id = $usercreate->users_id;
            $operator->desa_id = $usercreate->desa_id;
            $operator->jabatan_id = $usercreate->jabatan_id;
            $operator->nama_operator = $usercreate->nama;
            $operator->alamat = $usercreate->address;
            $operator->save();
            return response([
                'message'=>'Successfully Add New Perangkat Desa.',
                'success'=> true,
                'data' => $usercreate,
            ], 200);
            // return response ($usercreate);
        }else if($usercreate->roles_id == 2){
            $operator = new Operator();
            $operator->users_id = $usercreate->users_id;
            $operator->desa_id = $usercreate->desa_id;
            $operator->jabatan_id = $usercreate->jabatan_id;
            $operator->nama_operator = $usercreate->nama;
            $operator->alamat = $usercreate->address;
            $operator->save();
            return response([
                'message'=>'Successfully Add New Admin Desa.',
                'success'=> true,
                'data' => $usercreate,
            ], 200);
        }else if($usercreate->roles_id == 1){
            return response([
                'message'=>'Successfully Add New Super Admin.',
                'success'=> true,
                'data' => $usercreate,
            ], 200);
            // return response ($usercreate ) ;
        }

        // return response ( $ usercreate ) ;
    }

    // public function register(RegisterRequest $request){

    //     $usercreate = User::create($user);
    //     return response($usercreate);
    // }

    public function login (LoginRequest $request) {
        // dd($request->password, $request->email);

        if(!Auth::attempt($request->only('email', 'password'))){
            return response([
                'errors'=>'Invalid credentials.'
            ], Response::HTTP_UNAUTHORIZED);
        }
    
        $user=Auth::user();
        
        $token=$user->createToken('token')->plainTextToken;

        return response ( [
            'jwt' => $token
        ]);

        
    }

    // public function login(LoginRequest $request){
        // if(!Auth::attempt($request->only('email', 'password'))){
        //     return response([
        //         'errors'=>'Invalid credentials.'
        //     ], Response::HTTP_UNAUTHORIZED);
        // }

    // public function logout(){
    //     Auth::user()->currentAccessToken()->delete();
    //     return response ( [
    //         'message' => 'Successfully Logged out'
    //     ]) ;
    // }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response([
            'message'=>'Successfully logged out.'
        ]);
    }
}