<?php

namespace App\Http\Controllers\Tecnico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tecnico\TecnicoDocument;

class TecnicoDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TecnicoDocument::all();
        return view('welcome', compact('data'));
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
        $file_data = $request->input('file');
        $file_name = 'image_'.time().'.jpg';
        
        if($file_data!=""){
        
            $file = base64_decode($file_data);
            \Storage::disk('certificados')->put($file_name, $file);     
        }
      
        $create =  new TecnicoDocument;
        $create->documento = $request->description;
        $create->certificado = $file_name;
        $create->user_id = $user->id;
       
        if($create->save()){
         return response()->json(['data'=> $create, 'status'=>'sucess'], 201);
        }
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
        
        $documento = TecnicoDocument::find($id);

        if (\Storage::disk('certificados')->exists($documento->certificado)) {

            \Storage::disk('certificados')->delete($documento->certificado);
        }
                
        if ($documento->delete()) {
            
            return response()->json(['data'=> $documento], 200);
        }
        
        return response()->json(['error' => 'No se pudo eliminar el registro'], 422);
    }

    public function credenciales($id)
    {
        $credenciales = TecnicoDocument::where('user_id',$id)->get();

        if($credenciales)
        {
            return response()->json(['data'=> $credenciales, 'status'=>'sucess'], 201);
        }    
    }

  
}
