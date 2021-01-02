<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmacionEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \App\Persona;
use \App\User;
use Str;

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
            $user->confirmation_code  = Str::random(25);
            $user->img_user = "null";

            if($user->save() && $request->rol == 1){
                return response()->json(["Admin"=>$user],201); 
            }

            if($user->save()){
                $data = (object)[
                    'user_nombre'=>$user->name,
                    'user_code'=>$user->confirmation_code,
                ];

                Mail::to($user->email)->send(new ConfirmacionEmail($data));//Email de confirmacion 
                return response()->json(["Message"=>"Se a enviado un email para confirmar su correo","User"=>$user],201); 
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
        $verify = $user->email_verified_at;

        if($verify==null){
            return response()->json(["Message"=>"Debe de confirmar su correo electronico para inicar sesion"],400); 
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

    public function verify($code){
        $user = User::where('confirmation_code',$code)->first();
        if($user){
            $user->email_verified_at = now();
            $user->confirmation_code = null; //declaro null el campo para evitar repeticiones de confirmation_code
            
            if($user->save()){
                return "Sea confirmado el correo electronico!!";
            }
        }
        return "Ups...";
    }

    public function verify_email(Request $request){

        $request->validate([
            'email'=> 'required|email',
        ]);

        $user = User::where('email',$request->email)->first();

        if($user){
            
            
            $data = (object)[
                'user_nombre'=>$user->name,
                'user_code'=>$user->confirmation_code,
            ];
            Mail::to($request->email)->send(new ConfirmacionEmail($data));//Email de confirmacion 
            
            if($user->save()){
                return response()->json(["Message"=>"Se a enviado el correo de confirmacion"]);
            }
        }
        return response()->json(["Message"=>"No se encontro ninguna cuenta asociada con este email"]);
    }



//FUNCIONES ANDROID STUDIO

    public function register_android(Request $request){
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
            $user->confirmation_code  = NULL;
            $user->img_user = "null";

            if($user->save()){
                return "Sea registrado correctamente!!"; 
            }
        }
        return abort(400, "Error al registrar"); 
    }
    

    public function login_android(Request $request){

        $user = User::where('email', $request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            return ["token" => "010","correcto"=>1];
        }

        $token = $user->createToken($request->email,['user:user'])->plainTextToken; //Crea el token y se asignan permisos donde el request->email sea igual al que estan en la bd, despue retornas el token en texto plano 
        return ["token" => $token,"correcto"=> 1719];
    }
}

