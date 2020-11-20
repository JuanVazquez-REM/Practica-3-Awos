<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Persona;

class PersonaController extends Controller
{
    public function ver_personas(){
        $resultado = Persona::all();
        return response()->json($resultado,200);
    }

    public function ver_persona_id(Request $request, $id){ 
        if($request->user()->tokenCan('admin:admin')){

            $personas = Persona::where('id',$id)->get(); 
            return response()->json($personas, 200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function update(Request $request,$id){
        if($request->user()->tokenCan('admin:admin')){

            $request->validate([
                'nombre'=> 'required',
                'apellidos'=> 'required',
                'email'=> 'required|email',
                'edad'=> 'required',
                'genero'=> 'required',
            ]);

            $nombre = $request->nombre; 
            $apellidos = $request->apellidos;
            $email= $request->email;
            $edad = $request->edad;
            $genero = $request->genero;

            Persona::where('id', $id)
            ->update(['nombre'=>$nombre,'apellidos'=>$apellidos,'email'=> $email ,'edad'=> $edad, 'genero'=> $genero]);
            return response()->json($request,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

}
