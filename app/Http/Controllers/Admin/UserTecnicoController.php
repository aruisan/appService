<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserTecnicoController extends Controller
{
    public function index(){
        $data = User::where('rol', '!=', 'Admin')->get();
        return view('admin.user.tecnico.index', compact('data'));
    }

    public function edit($id){
        $activo = User::find($id);
        if($activo->activo == 0){
            $activo->activo = 1;
        }else{
            $activo->activo ='0';
        }
        $activo->save();

        return back();
    }

    public function show($id){
        $data = User::find($id);
        return view('admin.user.tecnico.show', compact('data'));
    }
}
