<?php

namespace App\Http\Controllers;

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
}
