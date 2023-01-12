<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use App\Http\Requests\ShiftRequest;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    //
    public function createShift(){
        $this-> authorize('super-admin');

        $shift = Shift::all();
        // dd($jabatan);
        return response([
            'data'=> $shift
        ]);
    }

    public function viewShift($id){
        $this-> authorize('super-admin');
        $shift = Shift::find($id);
        // dd($jabatan);
        return response([
            'data'=> $shift
        ]);
    }

    public function storeShift(ShiftRequest $request){
        $this->authorize('super-admin');
        
        $shiftRequest= $request->validated();
        // dd($jabatanRequest);        

        $data= Shift::create($shiftRequest);
        
        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteShift($id){
        $this-> authorize('super-admin');
        $shift  = Shift::find($id);
        // dd($user);
        $shift ->delete();
        return response([
            'message'=>'Successfully Delete Shift.'
        ]);
    }

    public function updateShift (ShiftRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $shift = Shift::find($id);
        $shift ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Shift.',
            'success'=> true,
            'data' => $shift,
        ], 200);
    }
}
