<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Banco;

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
}
