<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorRequest;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    //
    public function createOperator(){
        $this-> authorize('super-admin-operator-perangkat-desa');

        if (Auth::user()->roles_id == 1){
            $operator = Operator::with("desa")
            ->with("jabatan")->get();

        } else if(Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3){
            $operator = Operator::with("desa")
            ->with("jabatan")
            ->where("desa_id",Auth::user()->desa_id)->get();

        }

        // $operator = Operator::all();
        // dd($operator);
        return response([
            'data'=> $operator
        ]);
    }

    public function viewOperator($id){
        $this-> authorize('super-admin-operator-perangkat-desa');
        $operator = Operator::find($id);
        // dd($operator);
        return response([
            'data'=> $operator
        ]);
    }


    public function storeOperator(OperatorRequest $request){
        $this->authorize('super-admin');

        $operatorRequest= $request->validated();
        $data= Operator::create($operatorRequest);

        return response([
            'success'=> true,
            'data' => $data,
        ], 200);
    }

    public function deleteOperator($id){
        $this-> authorize('super-admin');
        $operator  = Operator::find($id);
        // dd($user);
        $operator ->delete();
        return response([
            'message'=>'Successfully Delete Operator.'
        ]);
    }

    public function updateOperator (OperatorRequest $request, $id){
        $this-> authorize('super-admin-operator');
        // $desaRequest= $request->validated();
        
        $operator = Operator::find($id);
        $operator ->update($request->all());
        // dd($jabatan);
        return response([
            'message'=>'Successfully Update Operator.',
            'success'=> true,
            'data' => $operator,
        ], 200);
    }
}
