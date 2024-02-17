// Inicializa la valoración de las estrellas
let stars = document.querySelectorAll('.star');
let starValueInput = document.getElementById('star-value');

stars.forEach(star => {
    star.addEventListener('click', function() {
        let value = this.getAttribute('data-value');

        // Llena las estrellas
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= value) {
                s.classList.add('filled');
            } else {
                s.classList.remove('filled');
            }
        });

        // Guarda el valor en el input oculto
        starValueInput.value = value;
    });
});

document.querySelector('#reviewForm button[type="submit"]').addEventListener('click', function(e) {
    e.preventDefault();

    let com = document.getElementById('comentario').value;
    let pedidoId = document.getElementById('pedido_id').value;

    // Obtiene la valoración de las estrellas
    let val = starValueInput.value;

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
            window.location.href = 'index.php?controller=review&action=panelReviews';
        }, 800); // Redirige a la página de reseñas después de 0.8 segundos
    })
    .catch(error => {
        console.log(error);
        notie.alert({ type: 'error', text: 'Error al añadir la reseña', time: 2 });
    });
});