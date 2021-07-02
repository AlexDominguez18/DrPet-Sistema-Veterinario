<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>
<body>
    <div style="text-align: center;">
        <img src="{{ asset('img/DrPetLogo.png') }}" width="100" height="auto">
        <h3>Aquí están sus credenciales para ingresar al sistema.</h2>
    </div>
    <hr>
    <ul>
        <li>
            <p><strong>Correo:</strong> {{ $info['email'] }}</p>
        </li>
        <li>
            <p><strong>Contraseña:</strong> {{ $info['password'] }}</p>
        </li>
    </ul>
</body>
</html>