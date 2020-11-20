<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \App\Persona;
use \App\User;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'nombre'=> 'required',
            'apellidos'=> 'required',
            'email'=> 'required|email',
            'edad'=> 'required',
            'genero'=> 'required',
            'password'=> 'required',
        ]);

        $persona = new Persona;

        $persona->nombre = $request->input('nombre'); 
        $persona->apellidos = $request->input('apellidos'); 
        $persona->email = $request->input('email');
        $persona->edad = $request->input('edad');
        $persona->genero = $request->input('genero');
        
        if($persona->save()){

            $user = new User; 
            $user->persona_id = $persona->id;
            $user->name = $persona->nombre;
            $user->email = $persona->email;
            $user->password = Hash::make($request->password);
            $user->img_user = "null";

            if($user->save() && $request->rol == 1){
                return response()->json(["Admin"=>$user],201); 
            }

            if($user->save()){
                return response()->json(["User"=>$user],201); 
            }
        }
        return abort(400, "Error al registrar"); 
    }
    

    public function login(Request $request){

        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Email o password incorrectos'],
            ]);
        }

        if($request->rol == 1){
            $token = $user->createToken($request->email,['admin:admin','user:user'])->plainTextToken; //Crea el token y se asignan permisos donde el request->email sea igual al que estan en la bd, despue retornas el token en texto plano 
        }else{
            $token = $user->createToken($request->email,['user:user'])->plainTextToken; //Crea el token y se asignan permisos donde el request->email sea igual al que estan en la bd, despue retornas el token en texto plano 
        }
        
        return response()->json(["token" => $token],201);
    }


    public function logout(Request $request){
        return response()->json(["Tokens afectados" => $request->user()->tokens()->delete()],200);
    }

}

