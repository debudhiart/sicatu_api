<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{

    public function createUser(){
        // $this-> authorize('super-admin-operator-perangkat-desa');
        // if (Auth::user()->roles_id == 1){
        //     $jabatan = Jabatan::with("desa")->get();
        // } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
        //     $jabatan = Jabatan::with("desa")->where("desa_id",Auth::user()->desa_id)->get();
        // }

        $user = User::with("desa")->with('role')->get();
        // dd($jabatan);
        return response([
            'data'=> $user
        ]);
    }

    public function storeUser(RegisterRequest $request){
        // $this->authorize('super-admin');

        $user= $request->validated();
        $data= User::create($user);

        return response([
            'message'=>'Successfully Add New User.',
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    //
    public function deleteUser($id){
        $this-> authorize('super-admin');
        $user = User::find($id);
        // dd($user);
        $user->delete();
        return response([
            'message'=>'Successfully Delete User.'
        ]);
    }
}
