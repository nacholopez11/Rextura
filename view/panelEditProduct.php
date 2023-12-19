<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>

    <form action="<?=url.'?controller=product&action=editProductById'?>" method="post">
        <input type="hidden" name="id" value="<?=$product->getId();?>">
        <!-- Otros campos del formulario con los detalles del producto -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?=$product->getNombre();?>">
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" value="<?=$product->getCategoria();?>">
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?=$product->getPrecio();?>">
        <label for="precio_premium">Precio premium:</label>
        <input type="text" name="precio_premium" value="<?=$product->getPrecioPremium();?>">
        <label for="image">Imagen:</label>
        <input type="text" name="image" value="<?=$product->getImage();?>">
        <label for="categoria_id">Categoria:</label>
        <input type="text" name="categoria_id" value="<?=$product->getCategoriaId();?>">

        <button type="submit" class="boton-principal">Guardar cambios</button>
    </form>
</body>
</html>