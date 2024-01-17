<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_register.css" rel="stylesheet" type="text/css" media="screen">
    <link href="./assets/css/full_estil_general.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<?php
// Incluye el header
include_once 'header.php';
?>
    <section class="container">
        <div class="titulo-pagina">
            <h1 class="texto-titulo-carrito">
                <span class="texto-titulo">Tu cuenta</span>
            </h1>
            <div class="paginacion">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="a-breadcrumb" href=<?= "index.php?controller=product&action=panelHome" ?>>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Entrar</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12 p-0">
                <!-- REGISTRARSE -->
                <div class="container">
                    <h2>Registrarse</h2>
                    <form method="post" action="index.php?controller=usuario&action=register">
                        <label class="n-label" for="username">Usuario:</label>
                        <input type="text" name="username" required>
                        <label class="n-label" for="password">Contraseña:</label>
                        <input type="password" name="password" required>

                        <button class="boton-confirmar" type="submit">Registrarse</button>
                    </form>
                </div>             
            </div>
            <div class="col-12 col-lg-6 col-md-6 col-sm-12 p-0">
                <!-- INICIAR SESION -->
                <div class="container login">
                    <h2>Iniciar Sesión</h2>
                    <form action="index.php?controller=usuario&action=login" method="post">
                        <label class="n-label" for="username">Usuario:</label>
                        <input type="text" id="username" name="username" placeholder="ej: tuNombre" required>
                        <label class="n-label" for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>

                        <button class="boton-confirmar" type="submit">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
    </section>
<?php
// Incluye el footer
include_once 'footer.php';
?>
</body>
</html>