<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>

    <?php
    // Obtén el ID del producto de la URL
    $productId = isset($_GET['id']) ? $_GET['id'] : null;
    
    // Obtén los detalles del producto
    $product = ProductDAO::getProductById($productId);
    ?>

    <form action="index.php?controller=product&action=editProductById" method="post">
        <input type="hidden" name="id" value="<?php echo $productId; ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $product->getNombre(); ?>"><br>

        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" value="<?php echo $product->getCategoria(); ?>"><br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $product->getPrecio(); ?>"><br>

        <!-- Agrega más campos según sea necesario -->

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>