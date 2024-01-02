<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_register.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<?php
// Incluye el header
include_once 'header.php';
?>
    <section>
        <!-- REGISTRARSE -->
        <div class="container">
            <h2>Registrarse</h2>
            <form method="post" action="index.php?controller=usuario&action=register">
                <label for="username">Usuario:</label>
                <input type="text" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" required>

                <button class="boton-principal" type="submit">Registrarse</button>
            </form>
        </div>
        <!-- INICIAR SESION -->
        <div class="container">
            <h2>Iniciar Sesión</h2>
            <form action="index.php?controller=usuario&action=login" method="post">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <button class="boton-principal" type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </section>
<?php
// Incluye el footer
include_once 'footer.php';
?>
</body>
</html>