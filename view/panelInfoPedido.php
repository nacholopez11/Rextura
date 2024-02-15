<!DOCTYPE html>
<html>
<head>
    <title>Información del Pedido</title>
    <!-- Aquí puedes incluir cualquier CSS o JavaScript que necesites -->
</head>
<body>
    <h1>Información del Pedido</h1>

    <!-- Muestra la información del pedido -->
    <table>
        <thead>
            <tr>
                <th>ID del Pedido</th>
                <th>ID del Usuario</th>
                <th>Fecha del Pedido</th>
                <th>Total</th>
                <th>Propina</th>
                <th>Puntos Usados</th>
                <th>Puntos Ganados</th>
                <th>ID del Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedido as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['pedido_id']) ?></td>
                    <td><?= htmlspecialchars($producto['usuario_id']) ?></td>
                    <td><?= htmlspecialchars($producto['fecha_pedido']) ?></td>
                    <td><?= htmlspecialchars($producto['total']) ?></td>
                    <td><?= htmlspecialchars($producto['propina']) ?></td>
                    <td><?= htmlspecialchars($producto['puntos_usados']) ?></td>
                    <td><?= htmlspecialchars($producto['puntos_ganados']) ?></td>
                    <td><?= htmlspecialchars($producto['producto_id']) ?></td>
                    <td><?= htmlspecialchars($producto['precio']) ?></td>
                    <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                    <td><?= htmlspecialchars($producto['subtotal']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


<!-- https://localhost/rextura/index.php?controller=product&action=mostrarPedido&usuarioId=32 -->
