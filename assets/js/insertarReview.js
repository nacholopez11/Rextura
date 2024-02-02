document.querySelector('#reviewForm button[type="submit"]').addEventListener('click', function(e) {
    e.preventDefault();

    let com = document.getElementById('comentario').value;
    let val = document.getElementById('valoracion').value;

    fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=insertarReview', {
        method: 'POST',
        body: JSON.stringify({
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
        // Comprueba si la respuesta tiene contenido antes de intentar convertirla en JSON
        if (response.headers.get('content-length') === '0') {
            return {};
        } else {
            return response.json();
        }
    })
    .then(data => {
        console.log(data);
        notie.alert({ type: 'success', text: 'Reseña añadida correctamente', time: 2 });
    })
    .catch(error => {
        console.log(error);
        notie.alert({ type: 'error', text: 'Error al añadir la reseña', time: 2 });
    });
});





//SI QUIERO RECARGAR LA PAGINA UTILIZAR UN TIMEOUT CON LA FUNCION RELOAD