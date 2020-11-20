<!DOCTYPE html>
<html lang="es-Es">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        <h3>Hola, Que tal admin {{$data->admin_nombre}},</h3>
        <div>
            <p>
                El usuario: <b>{{$data->user_name}} {{$data->user_apellidos}}</b><br>
                con el correo: <b>{{$data->user_email}}</b> quiso acceder al apartado de actualizar perfil <br>
                pero no tiene los permisos para hacerlo.
            </p>

            <p>
                Saludos <b>{{$data->admin_nombre}}</b> que tengas un excelente dia te lo deasea laravel!!!
            </p>
            
        
        </div>
    </body>
</html>
