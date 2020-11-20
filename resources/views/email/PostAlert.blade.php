<!DOCTYPE html>
<html lang="es-Es">
    <head>
        <meta charset="utf-8">
        <title>Hola,¡{{$data_email_post->post_user_name}}!Tienes un nuevo comentario en uno de tus Post</title>
    </head>
    <body>
        <h3>{{$data_email_post->post_user_name}},</h3>
        <div>
            <p>El usuario <b>{{$data_email_post->user_nombre}}</b> realizo un comentario en tu post titulado:
            <b>{{$data_email_post->post_titulo}}</b><br> donde el comentario fue:</p>
            <p>
                <b>Nombre del comentario: </b> <i>{{$data_email_post->comment_nombre}}</i><br>
                <b>Contenido: </b><i>{{$data_email_post->comment_contenido}}</i> 
            </p>

            <p>
            Saludos <b>{{$data_email_post->post_user_name}}</b> que tengas un excelente dia te lo deasea laravel!!!
            </p>
            
        
        </div>
    </body>
</html>
