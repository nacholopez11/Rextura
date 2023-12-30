<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rextura</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_header.css" rel="stylesheet" type="text/css" media="screen">
    
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid div-header">
                <div class="row div-fila-header">
                    <div class="buscador-header col-4">
                        <div class="lolo">
                            <ul class="buscador">
                                <li class="nav-item-buscador">
                                    <img class="icon-buscador" src="./assets/icons/buscador.png" />
                                    <a class="nav-link-buscador active" aria-current="page" href="#">Buscar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="logo-header col-4">
                        <a class="navbar-brand" href=<?= "index.php?controller=product&action=panelHome" ?>>
                            <img src="./assets/images/textura-logo.jpg" />
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="menu-header col-4">
                        <div class="as" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <?php if (isset($_SESSION['user'])) : ?>
                                    <?php if ($_SESSION['user']['rol'] === 'admin') : ?>
                                        <!-- Admin -->
                                        <li class="nav-item">
                                            <img class="icon-menu-header" src="./assets/icons/cuenta.png" />
                                            <a class="nav-link active" aria-current="page" href=<?= "index.php?controller=usuario&action=logout" ?>>Cerrar Sesión</a>
                                        </li>
                                        <li class="nav-item">
                                            <img class="icon-menu-header" src="./assets/icons/carta.png" />
                                            <a class="nav-link" aria-current="page" href=<?= "index.php?controller=product&action=products" ?>>Panel Admin</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <img class="icon-menu-header" src="./assets/icons/bolsa.png" />
                                            <a class="nav-link" href=<?= "index.php?controller=product&action=panelCompra" ?>>Bolsa</a>
                                        </li> -->
                                    <?php else : ?>
                                        <!-- User -->
                                        <li class="nav-item">
                                            <img class="icon-menu-header" src="./assets/icons/cuenta.png" />
                                            <a class="nav-link active" aria-current="page" href=<?= "index.php?controller=usuario&action=logout" ?>>Cerrar Sesión</a>
                                        </li>
                                        <li class="nav-item">
                                            <img class="icon-menu-header" src="./assets/icons/carta.png" />
                                            <a class="nav-link" aria-current="page" href=<?= "index.php?controller=product&action=products" ?>>Carta</a>
                                        </li>
                                        <li class="nav-item">
                                            <img class="icon-menu-header" src="./assets/icons/bolsa.png" />
                                            <a class="nav-link" href=<?= "index.php?controller=product&action=panelCompra" ?>>Bolsa</a>
                                        </li>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <!-- No Session -->
                                    <li class="nav-item">
                                        <img class="icon-menu-header" src="./assets/icons/cuenta.png" />
                                        <a class="nav-link active" aria-current="page" href=<?= "index.php?controller=usuario&action=index" ?>>Iniciar Sesión</a>
                                    </li>
                                    <li class="nav-item">
                                        <img class="icon-menu-header" src="./assets/icons/carta.png" />
                                        <a class="nav-link" aria-current="page" href=<?= "index.php?controller=product&action=products" ?>>Carta</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>