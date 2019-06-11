<?php

namespace App\Http\Controllers;

use App\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();

        $horario = new Horario;
        $horario->user_id =  $user->id;
        $horario->dia =  $request->dia;
        $horario->hh_init =  $request->hh_init;
        $horario->hh_end =  $request->hh_end;

        $horario->save();

        return response()->json(['data'=> $horario, 'status'=>'sucess'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horario = Horario::find($id);
        $horario->delete();

        return response()->json(['data'=> $horario], 200);

    }

    public function myHorarios($id){

        $user = auth('api')->user();

        $horarios = Horario::where('user_id',$user->id)->get();

        if($horarios)
        {
            return response()->json(['data'=> $horarios, 'status'=>'sucess'], 201);
        }    
    }   
}
