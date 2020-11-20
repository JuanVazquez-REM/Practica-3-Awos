<!DOCTYPE html>
<html lang="es-Es">
    <head>
        <meta charset="utf-8">
        <title>Hola,¡{{$data_email_post->user_nombre}}!Realizaste un nuevo comentario!</title>
    </head>
    <body>
        <h3>{{$data_email_post->user_nombre}},</h3>
        <div>
            <p>
                Has realizado un comentario en el post titulado: <b>{{$data_email_post->post_titulo}}</b><br>
                donde el contenido del post es esto: <b>{{$data_email_post->post_contenido}}.</b><br>
                Tu comenatrio fue:
            </p>

            <p>
                <b>Nombre del comentario: </b> <i>{{$data_email_post->comment_nombre}}</i><br>
                <b>Contenido: </b><i>{{$data_email_post->comment_contenido}}</i> 
            </p>

            <p>
                Saludos <b>{{$data_email_post->user_nombre}}</b> que tengas un excelente dia te lo deasea laravel!!!
            </p>
            
        
        </div>
    </body>
</html>
