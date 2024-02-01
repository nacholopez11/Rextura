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
    .then(response => response.json())
    .then(data => {
        console.log(data);

    })
    .catch(error => console.log(error))
})