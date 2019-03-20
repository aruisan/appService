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

        $emergency->save();

        foreach ($file_data as  $imagen) {

            $file_name = 'image_'.time().rand(1,100).'.jpg';
          
            $file = base64_decode($imagen);
            \Storage::disk('emergencias')->put($file_name, $file);     

          
            $create =  new EmergencyImagen;
            $create->url = $file_name;
            $create->emergency_id = $emergency->id;
        }
       
        return response()->json(['data'=> $create, 'status'=>'sucess'], 201);
        
    }
}
