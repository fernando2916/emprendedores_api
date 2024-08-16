<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <h1 class="">Código de verificación</h1>
        
        <p>Hola: {{ $name }} {{ $last_name }}, te has registrado satisfactioriamente en Emprendedores Creativos, ya casi esta todo listo, solo debes confirmar tu cuenta.
        </p>
        <p>Visita el siguiente enlace:</p>
        <a class="" href="{{ env("FRONTEND_URL")."/auth/activar-cuenta/".$user->verification_id }}">
            Confirmar cuenta
        </a> 
        <p> 
            E ingresa el siguiente código de verificaión 
            <span class="">
                {{ $verification_code }} 
            </span>
            Este código expira en 10 minutos.
        </p>
    </div>
</body>
</html>