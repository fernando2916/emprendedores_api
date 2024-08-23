<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
          background-color: #000c1f;
          color: white;
        }
    
        a {
          font-size: x-large;
          color: #3BBDF5;
          text-decoration: none;
          background-color: #6e004c;
          padding: 10px;
          border-radius: 5px
        }
    
        .container {
          display: flex;
          flex-direction: column;
          margin: 0 10px;
        }
      </style>
</head>
<body>
    <div class="container">
        <h2> Hola {{ $name}} {{ $last_name}}, has solicitado restablecer tu contraseña, visita el siguiente link para poder hacerlo.</h2>
        <a href="{{ env("FRONTEND_URL")."/auth/nueva_contraseña/".$user->verification_id}}">Restablecer Contraseña</a>
    </div>
    <div>
        <p>Si tu no lo solicitaste, ignora este mensaje.</p>
    </div>
</body>
</html>