<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use \App\Post;
use DB;


class PostController extends Controller
{
    public function ver_posts(Request $request){
        if($request->user()->tokenCan('user:user')||$request->user()->tokenCan('admin:admin')){
        $posts = Post::select()->get();
        return response()->json($posts, 200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }
    public function ver_posts2(){

        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.humedad');

        return $response;
    }

    public function ver_post_id(Request $request,$id){ 
        if($request->user()->tokenCan('user:user')||$request->user()->tokenCan('admin:admin')){

            $post = Post::where('id',$id)->get();
            return response()->json($post, 200); 
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function insert(Request $request){
        if($request->user()->tokenCan('user:user')||$request->user()->tokenCan('admin:admin')){

            $request->validate([
                'titulo'=> 'required',
                'contenido'=> 'required',
            ]);

            $request_post = new Post;
            $request_post->user_id = $request->user()->id; 
            $request_post->titulo = $request->titulo;
            $request_post->contenido = $request->contenido;
            
            if($request->hasfile('imagen')){
                if($request->imagen->extension() == 'jpeg' || $request->imagen->extension() == 'png'){
                    
                    $user_id = $request->user()->id;
                    $path = Storage::disk('public')->putFile('/images/posts/'.$user_id.'/', $request->imagen);
                    $request_post->img_post = $path;
                }else{
                    return abort(
                        response()->json(['Message' => 'Imagen no valida'], 400)
                    );
                }
            }else{
                $request_post->img_post = "NULL";
            }

            if($request_post->save()){
                return response()->json($request_post,201);
            }else{
                return response()->json(['Message'=> 'Error al crear un Post'],400);
            }
            
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function update(Request $request,$id){
        if($request->user()->tokenCan('admin:admin')){
            $request->validate([
                'titulo'=> 'required',
                'contenido'=> 'required',
            ]);
            
            $titulo = $request->titulo;
            $contenido = $request->contenido;

            Post::where('id', $id)->update(['titulo'=>$titulo, 'contenido'=> $contenido]);
            return response()->json($request,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function delete_post(Request $request,$id){
        if($request->user()->tokenCan('admin:admin')){  
            
            $post = Post::where('id',$id);
            $post->delete();
            return response()->json(['Message' => 'Deleted'],200);  
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function posts_comments(Request $request){
        if($request->user()->tokenCan('user:user')||$request->user()->tokenCan('admin:admin')){
            //Mostrar la tabla posts junto la tabla comment
            $post = post::with('comment')->get(); 
        return response()->json($post,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function posts_user_id(Request $request, $id){
        if($request->user()->tokenCan('user:user') || $request->user()->tokenCan('admin:admin')){

            //Mostrar los posts de un determinado user
            $posts = DB::table('users')
            ->join('posts', 'users.id', '=' ,'posts.user_id')
            ->where('users.id', '=' , $id)
            ->select('posts.*')
            ->get();
            return response() ->json($posts,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }
}
