// Nuevo archivo JavaScript: puntosFidelidad.js

document.querySelector('form#pedido').addEventListener('submit', function(e) {
    e.preventDefault();

    let totalPedido = document.getElementById('totalPedido').innerText;

    totalPedido = parseFloat(totalPedido.replace('€', ''));
    let puntos = Math.floor(totalPedido / 10); 


    fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=actualizarPuntos', {
        method: 'POST',
        body: JSON.stringify({
            puntos: puntos,
        }),
        headers: {
            'Content-Type': 'application/json;',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error de red');
        }
        
        return response.text();
    })
    .then(data => {
        console.log(data);
        e.target.submit(); //añadir tiempo para que de tiempo a ver la notificacion
        notie.alert({ type: 'success', text: 'Pedido tramitado correctamente', time: 2 });
       
        
    })
    .catch(error => {
        console.log(error);
        notie.alert({ type: 'error', text: 'Error al tramitar pedido', time: 2 });
    });
});