document.querySelector('form#pedido').addEventListener('beforeSubmit', function(e) {
    let totalPedido = parseFloat(document.getElementById('totalPedido').innerText.replace('€', ''));
    let usuarioId = document.getElementById('usuarioId').value;

    // Si el checkbox está marcado, actualiza los puntos y el descuento
    if (document.getElementById('usarPuntos').checked) {
        // Restablece los puntos a cero
        fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=restablecerPuntos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;',
            },
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);

            // Calcula los puntos ganados por el total del pedido después de aplicar el descuento
            let puntosGanados = Math.floor(totalPedido / 10);

            // Actualiza los puntos con los nuevos puntos ganados
            return fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=actualizarPuntos', {
                method: 'POST',
                body: JSON.stringify({
                    usuario_id: usuarioId,
                    puntos: puntosGanados,
                }),
                headers: {
                    'Content-Type': 'application/json;',
                },
            });
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            notie.alert({ type: 'success', text: 'Pedido tramitado correctamente', time: 2 });
            e.submit(); // Envía el formulario después de realizar las operaciones necesarias
        })
        .catch(error => {
            console.log(error);
            notie.alert({ type: 'error', text: 'Error al tramitar pedido', time: 2 });
        });
    } else {
        // Si el checkbox no está marcado, simplemente envía el formulario sin actualizar puntos
        e.submit();
    }
});