<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdateUserReceived;
use Illuminate\Http\Request;
use \App\User;
use \App\Post;
use DB;

//images\/users\/1\/\/6vdkbmGHOVioKnRknuLWOw1mqXLeTltvf7y2KvVG.jpeg
class UserController extends Controller
{
    public function ver_users(Request $request){
        if($request->user()->tokenCan('admin:admin')){
            $resultado = User::all();
            return response()->json($resultado,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function ver_user_id(Request $request,$id){ 
        if($request->user()->tokenCan('admin:admin')){
            $users = User::where('id',$id)->get(); 
            return response()->json($users, 200);
        }else{
            if($request->user()->tokenCan('user:user')){

            }
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function update(Request $request,$id){
        if($request->user()->tokenCan('admin:admin')){

            $request->validate([
                'name'=> 'required',
                'email'=> 'required',
                'password'=> 'required',
            ]);

            $name = $request->name; 
            $email = $request->email;
            $password = Hash::make($request->input('password'));
            
            User::where('id', $id)->update(['name'=>$name,'email'=> $email ,'password'=> $password]);
            return response()->json($request,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function my_update(Request $request){
        if($request->user()->tokenCan('admin:admin') || $request->user()->tokenCan('user:update')){

            $request->validate([
                'name'=> 'required',
                'email'=> 'required',
                'password'=> 'required',
            ]);

            $name = $request->name; 
            $email = $request->email;
            $password = Hash::make($request->input('password'));
            
            User::where('id', $request->user()->id)->update(['name'=>$name,'email'=> $email ,'password'=> $password]);
            return response()->json($request,200);
        }else{
            //Si el usuario no tiene permisos para actualizar su perfil, enviar email al admin

            $info_user = User::join('personas','personas.id','=','users.persona_id')
            ->where('users.id',$request->user()->id)
            ->select('personas.*')
            ->first(); 

            $info_admin = User::join('personas','personas.id','=','users.persona_id')
            ->where('users.id',1)
            ->select('personas.*')
            ->first();

            $data = (object)[
                "user_name"=>$request->user()->name,
                "user_apellidos"=>$info_user->apellidos,
                "user_email"=>$request->user()->email,
                "user_edad"=>$info_user->edad,
                "user_genero"=>$info_user->genero,
                "admin_nombre"=>$info_admin->nombre,
                "admin_email"=>$info_admin->email,
            ];

            Mail::to($data->admin_email)->send(new UpdateUserReceived($data));//Email al admin
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function delete_user(Request $request,$id){
        if($request->user()->tokenCan('admin:admin')){
            $user = User::where('id',$id);
            $user->delete();
            return response()->json(['Message' => 'Deleted'],200);  
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function mi_user(Request $request){
        if($request->user()->tokenCan('user:user')){
            $user = DB::table('users')
            ->join('personas', 'personas.id', '=' ,'users.persona_id')
            ->where('users.id', '=' , $request->user()->id)
            ->select('users.*','personas.*')
            ->get();
            return response() ->json($user,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function mi_imagen(Request $request){
        if($request->user()->tokenCan('user:user') || $request->user()->tokenCan('admin:admin')){
            
            $request->validate([
                'imagen'=> 'required',
            ]);
            
            if($request->hasfile('imagen')){
                if($request->imagen->extension() == 'jpeg' || $request->imagen->extension() == 'png'){
                    $user_id = $request->user()->id;
                    $path = Storage::disk('public')->putFile('/images/users/'.$user_id.'/', $request->imagen);
                    
                    User::where('id', $user_id)->update(['img_user'=>$path]);
                    return response()->json(["Respuesta"=>$path],201);
                }else{
                    return abort(
                        response()->json(['Message' => 'Imagen no valida'], 400)
                    );
                }
            }
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function email_prueba(){
        /* Mail::send('email')
        ->from('19170059@uttcampus.edu.mx','Juan el piola')
        ->to('juanvazquez_jesuss@hotmail.com')
        ->subject('Listo calisto'); */
        $data = array(
            'name' => 'QUE ONDA',
        );

        Mail::send('email.email',$data,function($message){
            $message->from('19170059@uttcampus.edu.mx','Juan el piola');

            $message->to('juanjesusvazquezlozoria@gmail.com')->subject('Claro que si');
        });

        return response()->json(["Message"=>"Se envio correctamente crack"],200);
    }



    public function sql(){
        $postId =3;
        $sql = Post::join('users','users.id','=','posts.user_id')
                ->where('posts.id',$postId)
                ->select('users.email','posts.titulo')
                ->first();
                $data_email_post = (object)[
                    'post_titulo'=>$sql->titulo,
                    'user_email'=>$sql->email,

                ];
        return $data_email_post->user_email;
    }
}
