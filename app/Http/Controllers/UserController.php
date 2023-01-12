<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Models\Operator;
use App\Models\Pelanggan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function createUser(){
        // $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        $this-> authorize('super-admin-operator-perangkat-desa');
        if (Auth::user()->roles_id == 1){
            $user = User::with("desa")->with("role")->orderBy('created_at', 'desc')->get();
        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
            $user = User::with("desa")->where("desa_id",Auth::user()->desa_id)->orderBy('created_at', 'desc')->with("role")->whereNot("roles_id", 1)->get();
        }
        // else{
        //     $user = User::with("desa")->with('role')->get();
        // }

        // dd($jabatan);
        return response([
            'success'=> true,
            'data'=> $user
        ], 200);
    }

    public function viewUser($id){
        $this-> authorize('super-admin-operator-perangkat-desa-petugas-pelanggan');
        
        $user = User::where("users_id", $id)->with('role')->with("desa")->with('petugas')->with('pelanggan.jenisLangganan')->with('operator.jabatan')->first();
        // dd($user);
        return response([
            'success'=> true,
            'data'=> $user
        ], 200);
    }

    // ---Sama Kayak Register
    // public function storeUser(RegisterRequest $request){
    //     // $this->authorize('super-admin');

    //     $user= $request->validated();
    //     $data= User::create($user);

    //     return response([
    //         'message'=>'Successfully Add New User.',
    //         'success'=> true,
    //         'data' => $data,
    //     ], 200);
    // }

    public function updateUser (EditRequest $edit_request, $id){
        // $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        // $operator = Operator::where("users_id", $id)->first();

        // $operator->hp = $edit_request->hp;
        
        $user = User::where("users_id", $id)->with("petugas")->with("pelanggan")->with("operator")->first();
        // dd($user);
        // if($edit_request->roles_id != $user->roles_id){
        //     dd($user);
        // }
        $user ->update($edit_request->all());


        // $user_roles_id = $user->roles_id;
        // $id_role = User::where("users_id", Auth::user()->users_id)->first();

        if ($user->roles_id == 2 || $user->roles_id == 3){
            $operator = Operator::where("users_id", $id)->first();
            $operator->users_id = $user->users_id;
            $operator->desa_id = $user->desa_id;
            $operator->jabatan_id = $user->jabatan_id;
            $operator->nama_operator = $user->nama;
            $operator->alamat = $user->address;
            $operator->hp = $edit_request->hp;
            // dd($operator->hp);
            $operator->save();
            // $operator->users_id = $usercreate->users_id;
        } else if($user->roles_id == 4){
            $petugas = Petugas::where("users_id", $id)->first();
            $petugas->desa_id = $user->desa_id;
            $petugas->nama_petugas = $user->nama;
            $petugas->alamat = $user->address;
            
            $petugas->hp = $edit_request->hp;
            // dd($petugas->hp);
            $petugas->save();
        }else if($user->roles_id == 5){
            $pelanggan = Pelanggan::where("users_id", $id)->first();
            $pelanggan->desa_id = $user->desa_id;
            $pelanggan->nama_pelanggan = $user->nama;
            $pelanggan->alamat = $user->address;
            $pelanggan->hp = $edit_request->hp;
            // dd($pelanggan->hp);
            $pelanggan->save();;
        }

        $user = User::where("users_id", $id)->with("petugas")->with("pelanggan")->with("operator")->first();
        return  $user;
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update User.',
            'success'=> true,
            'data' => $user,
        ], 200);
    }

    //
    public function deleteUser($id){
        $this-> authorize('super-admin');
        $user = User::find($id);
        // dd($user);
   
        if ($user->roles_id == 2 || $user->roles_id == 3){
            $operator = Operator::where("users_id", $id)->first();
            // dd($operator->hp);
            $operator->delete();
            // $operator->users_id = $usercreate->users_id;
        } else if($user->roles_id == 4){
            $petugas = Petugas::where("users_id", $id)->first();

            $petugas->delete();
        }else if($user->roles_id == 5){
            $pelanggan = Pelanggan::where("users_id", $id)->first();
            
            $pelanggan->delete();
        }
        
        $user->delete();
        return response([
            'message'=>'Successfully Delete User.'
        ], 200);
    }

    public function uploadPhoto($id, Request $request){
        $this-> authorize('super-admin-operator');
        $user = User::find($id);

        if($request->file('photo')) {
            if (File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }
            $file_name = time().'_'.$request->file('photo')->getClientOriginalName();
            $file_path = $request->file('photo')->storeAs('photo-user', $file_name, 'public');
            $user->photo = '/storage/' . $file_path;
        }
        $user->save();
        return response([
            'message'=>'Successfully Upload Photo User.'
        ], 200);

    }
}
