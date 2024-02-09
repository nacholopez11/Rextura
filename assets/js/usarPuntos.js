window.addEventListener('DOMContentLoaded', (event) => {
    // Obtén los elementos del DOM
    let checkboxUsarPuntos = document.getElementById('usarPuntos');
    let totalPedidoElement = document.getElementById('totalPedido');
    let usuarioId = document.getElementById('usuarioId').value;
    let descuentoElement = document.getElementById('descuento');

    // Almacena el total original del pedido
    let totalOriginal = parseFloat(totalPedidoElement.innerText.replace('€', ''));

    // Añade un controlador de eventos al checkbox
    checkboxUsarPuntos.addEventListener('change', function() {
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
        
            // Calcula el descuento
            let descuento = this.checked ? Math.min(totalOriginal, puntos) : 0;
        
            // Calcula el nuevo total
            let nuevoTotal = totalOriginal - descuento;
        
            // Actualiza el total del pedido en la página
            totalPedidoElement.innerText = nuevoTotal.toFixed(2) + ' €';
        
            // Actualiza el valor del campo oculto "descuento"
            descuentoElement.value = descuento;
        
            // Actualiza el valor del campo oculto "puntosUsados"
            document.getElementById('puntosUsados').value = descuento; // Nuevo código
        })
        .catch(error => {
            console.log(error);
            notie.alert({ type: 'error', text: 'Error al obtener los puntos de fidelidad', time: 2 });
        });
    });
});