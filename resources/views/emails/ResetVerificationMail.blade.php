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
    }

    .container {
      display: flex;
      flex-direction: column;
    }
  </style>

</head>

<body>
  <div class="container">
    <h1 class="">Nuevo Código de verificación</h1>

    <p>
      Hola: {{ $name }} {{ $last_name }}, aqui tienes un nuevo código de verificación
    </p>
    <p>Visita el siguiente enlace:</p>
    <a class="" href="{{ env('FRONTEND_URL') . '/auth/activar-cuenta/' . $user->verification_id }}">
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


</html>
