document.querySelector('#reviewForm button[type="submit"]').addEventListener('click', function(e) {
    e.preventDefault();

    let comentario = document.getElementById('comentario').value;
    let valoracion = document.getElementById('valoracion').value;

    fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=insertarReview', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `comentario=${comentario}&valoracion=${valoracion}`
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Aquí puedes actualizar la interfaz de usuario para reflejar la nueva reseña
    })
})