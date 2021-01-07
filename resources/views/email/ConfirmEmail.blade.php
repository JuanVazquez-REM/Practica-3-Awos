<!DOCTYPE html>
<html lang="es-Es">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        <h3>{{$data->user_nombre}},</h3>
        <div>
            <p>
                Bienvenido a SmartHome, para finalizar tu registro debes de verificar tu correo electronico <br>
                Solo has click en siguiente enlace y podrar inicar sesion. <br>
            </p>

            <p>
                <a href="{{ url('/api/register/verify/'.$data->user_code) }}"> Click para confirmar tu email</a>
            </p>

            <p>
                Saludos <b>{{$data->user_nombre}}</b> que tengas un excelente dia te lo deasea SmartHome!!!
            </p>
            
        
        </div>
    </body>
</html>
