<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Añadir Producto</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_nuevo_producto.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
    <section class="container">
        <h2>Añadir Producto</h2>
        <form action="<?= url . '?controller=product&action=addProduct' ?>" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>
            <label for="categoria">Categoria:</label>
            <select name="categoria" required>
                <option value="Plato_principal">Plato Principal</option>
                <option value="Postre">Postre</option>
                <option value="Bebida">Bebida</option>
            </select>
            <div class="espaciador"></div>
            <label for="precio">Precio:</label>
            <input type="text" name="precio" required>
            <label for="precio_premium">Precio premium:</label>
            <input type="text" name="precio_premium">
            <label for="image">Imagen:</label>
            <input type="text" name="image">
            <label for="categoria_id">Categoria ID:</label>
            <select name="categoria_id" required>
                <option value="1">1 (Plato Principal)</option>
                <option value="2">2 (Postre)</option>
                <option value="3">3 (Bebida)</option>
            </select>

            <button type="submit" class="boton-principal">Guardar Producto</button>
        </form>
    </section>
</body>
</html>