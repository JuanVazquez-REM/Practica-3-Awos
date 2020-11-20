<!DOCTYPE html>
<html lang="es-Es">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        <h3>{{$data->user_nombre}},</h3>
        <div>
            <p>
                Para finalizar tu registro tienes que verificar esta direccion de correo electronico <br>
                Para poder iniciar sesion debes de confirmar tu correo electronico solo sa click en<br>
                siguiente enlace. <br>
            </p>

            <p>
                <a href="{{ url('api/register/verify/'.$data->user_code) }}"> Click para confirmar tu email</a>
            </p>

            <p>
                Saludos <b>{{$data->user_nombre}}</b> que tengas un excelente dia te lo deasea laravel!!!
            </p>
            
        
        </div>
    </body>
</html>
