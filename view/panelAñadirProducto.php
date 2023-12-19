<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
</head>
<body>
    <h2>Añadir Producto</h2>

    <form action="<?= url . '?controller=product&action=addProduct' ?>" method="post">
    <!-- Otros campos del formulario con los detalles del producto -->
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    <label for="categoria">Categoria:</label>
    <select name="categoria" required>
        <option value="Bebida">Bebida</option>
        <option value="Postre">Postre</option>
        <option value="Plato_principal">Plato Principal</option>
    </select>
    <label for="precio">Precio:</label>
    <input type="text" name="precio" required>
    <label for="precio_premium">Precio premium:</label>
    <input type="text" name="precio_premium">
    <label for="image">Imagen:</label>
    <input type="text" name="image">
    <label for="categoria_id">Categoria ID:</label>
    <input type="text" name="categoria_id" required>

    <button type="submit" class="boton-principal">Guardar Producto</button>
</form>
</body>
</html>