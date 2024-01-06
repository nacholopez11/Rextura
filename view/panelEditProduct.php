<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Editar Producto</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_editar_producto.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <section class="container">
        <h2>Editar Producto</h2>
        <form action="<?=url.'?controller=product&action=editProductById'?>" method="post">
            <input type="hidden" name="id" value="<?=$product->getId();?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?=$product->getNombre();?>">
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" value="<?=$product->getCategoria();?>">
            <label for="precio">Precio:</label>
            <input type="text" name="precio" value="<?=$product->getPrecio();?>">
            <label for="precio_premium">Precio premium:</label>
            <input type="text" name="precio_premium" value="<?=$product->getPrecioPremium();?>">
            <label for="image">Imágen:</label>
            <input type="text" name="image" value="<?=$product->getImage();?>">
            <label for="categoria_id">Categoria ID:</label>
            <input type="text" name="categoria_id" value="<?=$product->getCategoriaId();?>">
            <label for="alcohol">Alcohol:</label>
            <input type="text" name="alcohol" value="<?=$product->getConAlcohol();?>">

            <button type="submit" class="boton-principal">Guardar cambios</button>
        </form>
    </section>
</body>
</html>