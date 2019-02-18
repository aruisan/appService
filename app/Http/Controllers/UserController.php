<?php

namespace App\Http\Controllers;

use App\Banco;
use App\Cuenta;
use App\Monedero;
use App\MonederoMovimiento;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function meLocation()
    {
    	$localizacion = geoip()->getLocation($_SERVER["REMOTE_ADDR"]);
    	return response()->json([
            'geoData' => $localizacion
        ]);
    }

    public function infoBancaria(Request $request){
      $user = auth('api')->user();

      $cuenta = Cuenta::where('user_id', $user->id)->first();

      if(!$cuenta){

        $cuenta = new Cuenta; 
        $cuenta->user_id = $user->id;
        $cuenta->banco_id  = $request->banco;
        $cuenta->tipo_cuenta  = $request->tipo_cuenta;
        $cuenta->cuenta  = $request->cuenta;        
      }

        $cuenta->user_id = $user->id;
        $cuenta->banco_id  = $request->banco;
        $cuenta->tipo_cuenta  = $request->tipo_cuenta;
        $cuenta->cuenta  = $request->cuenta;

        if ($cuenta->save())
        {
            return response()->json(['data'=> $cuenta, 'status'=>'sucess'], 201);
        }

    }    

    public function getInfoBancaria($id){

      // $user = auth('api')->user();
      $cuenta = Cuenta::where('user_id', $id)->first();
        if ($cuenta)
        {
            return response()->json(['data'=> $cuenta, 'status'=>'sucess'], 201);
        }

    }    
    public function getBancos(){

      // $user = auth('api')->user();
      $bancos = Banco::all();
        if ($bancos)
        {
            return response()->json(['data'=> $bancos, 'status'=>'sucess'], 201);
        }

    }    
    public function setRol(Request $request){

        $user = auth('api')->user();

        $user->rol_id = $request->rol_id;

        if ($user->save())
        {
            return response()->json(['data'=> $user, 'status'=>'sucess'], 201);
        }


    }    

    public function getUser(){

        $user = auth('api')->user();

        return response()->json(['data'=> $user, 'status'=>'sucess'], 201);
        
    }

    public function getSaldo($id){

      // $user = auth('api')->user();
      $monedero = Monedero::where('user_id', $id)->first();

        if ($monedero)
        {
            return response()->json(['data'=> $monedero, 'status'=>'sucess'], 201);
        }

    }     

    public function retirarSaldo(Request $request){

        $user = auth('api')->user();

        // return $user;

        $monedero = Monedero::where('user_id', $user->id)->first();

        $movimiento = new MonederoMovimiento;
        $movimiento->valor = $request->amount;
        $movimiento->monedero_id = $monedero->id;
        $movimiento->cliente_id = $user->id;
        $movimiento->state = "exit";
        $movimiento->save();

        $monedero->stock = $monedero->stock - $request->amount;
        $monedero->save();

        if ($monedero)
        {
            return response()->json(['data'=> $monedero, 'status'=>'sucess'], 201);
        }

    }  
}
