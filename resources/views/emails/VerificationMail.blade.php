<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .container {
            padding: 3px 10px;
            color: white;
            background-color: #6e004c;
        }

        a {
            font-size: 15px;  
            color: #3BBDF5;
            text-decoration: none;
            background-color: #6e004c;
            padding: 10px;
            border-radius: 5px;
            font-weight: 500;
        }

        .saludo {
            font-size: 15px;
            font-weight: 800;
            font-family: 'Courier New', Courier, monospace;
        }

    </style>
</head>
<body>
    <div class="">
        
        <p>Hola: <span class="saludo">{{ $name }}</span>: te has registrado satisfactioriamente en Emprendedores Creativos, ya casi esta todo listo, solo debes confirmar tu cuenta.
        </p>
        <p class="">Utiliza el siguiente código para iniciar sesión en tu cuenta de Emprendedores Creativos</p>
        <a class="" href="{{ env("FRONTEND_URL")."/auth/activar_cuenta/".$user->verification_id }}">
            Confirmar cuenta
        </a> 
        <p> 
            Este código expira en 15 minutos.
        </p>
        <span class="container">
            {{ $verification_code }} 
        </span>
    </div>
</body>
</html>