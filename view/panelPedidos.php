<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_pedidos.css" rel="stylesheet" type="text/css" media="screen">
    <link href="./assets/css/full_estil_general.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
</head>
<body>
    <h1>Panel de Pedidos</h1>
<?php
foreach ($pedidos as $pedido) {
    echo 'Pedido ID: ' . htmlspecialchars($pedido['id']) . '<br>';
    echo 'Total del Pedido: ' . htmlspecialchars($pedido['total']) . '<br>';
    // Mostrar más detalles del pedido...
    echo '<hr>';
}
?>



</body>
</html>