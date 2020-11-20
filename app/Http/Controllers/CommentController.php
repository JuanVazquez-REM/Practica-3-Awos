<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use \App\Comment;
use \App\Post;
use App\Mail\PostAlertReceived;
use App\Mail\ConfirmacionCommentReceived;
use DB;

class CommentController extends Controller
{
    public function ver_comments(Request $request){
        if($request->user()->tokenCan('admin:admin')){
            $comments = Comment::all(); 
            return response()->json($comments, 200); 
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function ver_comment_id(Request $request, $id){ 
        if($request->user()->tokenCan('admin:admin')){

            $comments = Comment::where('id',$id)->get(); 
            return response()->json($comments, 200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function insert(Request $request){
        if($request->user()->tokenCan('user:user')||$request->user()->tokenCan('admin:admin')){
            $request->validate([
                'post_id'=> 'required',
                'nombre'=> 'required',
                'contenido'=> 'required',
            ]);
            $postId = $request->post_id;
    
            $request_comment = new Comment; 
            $request_comment->post_id = $postId; 
            $request_comment->nombre = $request->nombre;
            $request_comment->user_id = $request->user()->id;
            $request_comment->contenido = $request->contenido;

            if(1==1){
                $email_post = Post::join('users','users.id','=','posts.user_id')
                ->where('posts.id',$postId)
                ->select('users.email','posts.titulo','users.name','posts.contenido')
                ->first();
                
                $data_email_post = (object)[
                    'post_titulo'=>$email_post->titulo,
                    'post_contenido'=>$email_post->contenido,
                    'post_user_name'=>$email_post->name,
                    'post_user_email'=>$email_post->email,
                    'user_nombre'=>$request->user()->name,
                    'user_email'=>$request->user()->email,
                    'comment_nombre'=>$request->nombre,
                    'comment_contenido'=>$request->contenido,
                ];
                
                Mail::to($data_email_post->post_user_email)->send(new PostAlertReceived($data_email_post));//Email al dueño del post
                
                Mail::to($data_email_post->user_email)->send(new ConfirmacionCommentReceived($data_email_post));//Email al que realizo el comentario
                
                return response()->json($request_comment,201);
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
                'nombre'=> 'required',
                'contenido'=> 'required',
            ]);

            $nombre = $request->nombre;
            $contenido = $request->contenido;

            Comment::where('id', $id)
            ->update(['nombre'=>$nombre,'contenido'=> $contenido]);
            return response()->json($request,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function delete_comment(Request $request, $id){
        if($request->user()->tokenCan('admin:admin')){

            $comment = Comment::where('id',$id);
            $comment->delete();
            return response()->json(['Message' => 'Deleted'],200);  
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function comments_posts_id(Request $request,$id){
        if($request->user()->tokenCan('admin:admin')){

        //Mostrar los comentarios de un determinado posts
        $comments = DB::table('comments')
        ->join('posts', 'posts.id', '=' , 'comments.post_id')
        ->where('posts.id', '=' , $id)
        ->select('comments.*')
        ->get();
        
        return response() ->json($comments,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function comments_user_id(Request $request, $id){
        if($request->user()->tokenCan('admin:admin')){
            //Mostrar los comentarios de un determinado user
            $comments = DB::table('comments')
            ->join('users', 'users.id', '=' , 'comments.user_id')
            ->where('users.id', '=' , $id)
            ->select('comments.*')
            ->get();
        return response() ->json($comments,200);
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }
}
