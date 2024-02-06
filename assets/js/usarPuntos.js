window.addEventListener('DOMContentLoaded', (event) => {
    // Obtén los elementos del DOM
    let checkboxUsarPuntos = document.getElementById('usarPuntos');
    let totalPedidoElement = document.getElementById('totalPedido');
    let usuarioId = document.getElementById('usuarioId').value;

    // Obtiene los puntos del usuario
    fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=obtenerPuntos', {
        method: 'POST',
        body: JSON.stringify({
            usuario_id: usuarioId,
        }),
        headers: {
            'Content-Type': 'application/json;',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error de red');
        }
        return response.json();
    })
    .then(data => {
        let puntos = data.puntos;

        // Añade un controlador de eventos al checkbox
        checkboxUsarPuntos.addEventListener('change', function() {
            // Obtiene el total del pedido
            let totalPedido = parseFloat(totalPedidoElement.innerText.replace('€', ''));

            // Calcula el descuento
            let descuento = this.checked ? Math.min(totalPedido, puntos) : 0;

            // Calcula el nuevo total
            let nuevoTotal = totalPedido - descuento;

            // Actualiza el total del pedido en la página
            totalPedidoElement.innerText = nuevoTotal.toFixed(2) + ' €';
        });
    })
    .catch(error => {
        console.log(error);
        notie.alert({ type: 'error', text: 'Error al obtener los puntos de fidelidad', time: 2 });
    });
});