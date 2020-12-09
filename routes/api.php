<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//RUTAS ANDROID STUDIO
Route::post('/registeras', 'AuthController@register_android');
Route::post('/loginas', 'AuthController@login_android');


Route::post('/register', 'AuthController@register')->middleware('MinPassword','AuthEmail','MinEdad');
Route::post('/login', 'AuthController@login');

Route::get('/register/verify/{code}', 'AuthController@verify');

Route::post('/email/verify', 'AuthController@verify_email');

//Users
Route::middleware(['auth:sanctum'])->group(function () {
    //POSTS
    Route::post('/posts', 'PostController@ver_posts'); //LISTO
    Route::post('/posts/comments', 'PostController@posts_comments'); //todos los posts con sus repectivos comentarios // LISTO
    Route::post('/post/new', 'PostController@insert'); //LISTO
    
    //COMMENTS
    Route::post('/comments', 'CommentController@ver_comments'); //listo
    Route::post('/comment/new', 'CommentController@insert'); //listo

    //USER 
    Route::post('/my/user', 'UserController@mi_user'); //listo
    Route::post('/my/update', 'UserController@my_update'); //
    Route::post('/my/imagen', 'UserController@mi_imagen'); //Listo

    //AUTH:SANCTUM
    Route::post('/logout', 'AuthController@logout'); //listo

    //API Rapid (Diccionario)
    Route::get('/definition', 'ApiController@definition');
    Route::get('/word/examples', 'ApiController@word_examples');
    Route::get('/word', 'ApiController@word_all');
    Route::get('/word/region', 'ApiController@word_region');

});


//Administrador
Route::middleware(['auth:sanctum'])->group(function () {
    //POSTS
    Route::post('/post/{id}', 'PostController@ver_post_id'); //listo
    Route::put('/post/{id}', 'PostController@update'); //listo
    Route::post('/posts/user/{id}', 'PostController@posts_user_id'); //
    Route::delete('/post/{id}', 'PostController@delete_post'); //listo
    

    //COMMENTS
    Route::post('/comment/{id}', 'CommentController@ver_comment_id'); 
    Route::post('/comments/post/{id}', 'CommentController@comments_posts_id'); //mirar todo los comentarios de undeterminado post
    Route::post('/comments/user/{id}', 'CommentController@comments_user_id'); //listo
    Route::put('/comment/{id}', 'CommentController@update'); //Listo
    Route::delete('/comment/{id}', 'CommentController@delete_comment'); //listo


    //PERSONA
    Route::post('/personas', 'PersonaController@ver_personas'); //listo
    Route::post('/persona/{id}', 'PersonaController@ver_persona_id'); //listo
    Route::put('/persona/{id}', 'PersonaController@update'); //listo
    
    //USER
    Route::post('/users', 'UserController@ver_users'); //listo
    Route::post('/user/{id}', 'UserController@ver_user_id'); //listo
    Route::put('/user/{id}', 'UserController@update')->middleware('MinPassword','AuthEmail'); //listo
    Route::delete('/user/{id}', 'UserController@delete_user'); //listo
    
});
