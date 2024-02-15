<!DOCTYPE html>
<html>
<head>
    <title>Información del Pedido</title>
    <script src="ruta/a/qrcode.min.js"></script>
    <script src="ruta/a/sweetalert2.all.min.js"></script>
</head>
<body>
    <h1>Información del Pedido #<?= $pedidoId?></h1>

    <!-- Muestra la información del pedido -->
    <table>
        <thead>
            <tr>
                <th>ID del Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedido as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['id']) ?></td>
                    <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


<!-- https://localhost/rextura/index.php?controller=product&action=mostrarPedido&usuarioId=32 -->
