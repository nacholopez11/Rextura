document.querySelector('#reviewForm button[type="submit"]').addEventListener('click', function(e) {
    e.preventDefault();

    let com = document.getElementById('comentario').value;
    let val = document.getElementById('valoracion').value;
    let pedidoId = document.getElementById('pedido_id').value;

    if (!com || !val) {
        notie.alert({ type: 'error', text: 'Por favor, rellena todos los campos', time: 2 });
        return;
    }

    fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=insertarReview', {
        method: 'POST',
        body: JSON.stringify({
            pedido_id: pedidoId,
            comentario: com,
            valoracion: val,
        }),
        headers: {
            'Content-Type': 'application/json;',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error de red');
        }
        if (response.headers.get('content-length') === '0') {
            return {};
        } else {
            return response.json();
        }
    })
    .then(data => {
        console.log(data);
        notie.alert({ type: 'success', text: 'Reseña añadida correctamente', time: 2 });
        setTimeout(function() {
            location.reload();
        }, 800); // Recarga la página después de 0.8 segundos
    })
    .catch(error => {
        console.log(error);
        notie.alert({ type: 'error', text: 'Error al añadir la reseña', time: 2 });
    });
});
