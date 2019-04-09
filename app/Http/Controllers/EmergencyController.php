<?php

namespace App\Http\Controllers;

use App\Emergency;
use App\EmergencyImagen;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function publishEmergency(Request $request){

        $user = auth('api')->user();

        $file_data = $request->input('file');

        $emergency = new Emergency;
        $emergency->description = $request->description;
        $emergency->type_emergency = 1;
        $emergency->category_emergency = $request->category_emergency;
        $emergency->lat = $request->lat;
        $emergency->lng = $request->lng;
        $emergency->user_id = $user->id;


        $emergency->save();

        foreach ($file_data as  $imagen) {

            $file_name = 'image_'.time().rand(1,1000).'.jpg';
          
            $file = base64_decode($imagen);
            \Storage::disk('emergencias')->put($file_name, $file);     

          
            $create =  new EmergencyImagen;
            $create->url = $file_name;
            $create->emergency_id = $emergency->id;
            $create->save();
        }
       
        return response()->json(['data'=> $emergency, 'status'=>'sucess'], 201);
        
    }


    public function myEmergencys($id){

        $user = auth('api')->user();

        $emergencys = Emergency::where('user_id',$user_id)->orWhere('especialista_id', $user_id)->with('emergencyImages')->get();

        if($emergencys)
        {
            return response()->json(['data'=> $emergencys, 'status'=>'sucess'], 201);
        }    
    }    

    public function emergencys(){

        $emergencys = Emergency::with('emergencyImages', 'user')->get();

        if($emergencys)
        {
            return response()->json(['data'=> $emergencys, 'status'=>'sucess'], 201);
        }    
    }
    
    public function asignarEspecialista($id, $emergency){

        $emergency = Emergency::findOrFail($emergency);

        $emergency->especialista_id = $id;

        $emergency->save();    

        if($emergency)
        {
            return response()->json(['data'=> $emergency, 'status'=>'sucess'], 201);
        }    
    }
}
