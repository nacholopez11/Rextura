// Función para obtener y mostrar reseñas al cargar la página
function getReviews() {
    fetch('index.php?controller=review&action=api', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=getReviews', 
    })
    .then(response => response.json())
    .then(reviews => {
        const reviewsList = document.getElementById('reviewsList');
        reviewsList.innerHTML = '';

        reviews.forEach(review => {
            const reviewItem = document.createElement('div');
            reviewItem.innerHTML = `<strong>${review.usuario_id}:</strong> ${review.comentario} - Valoración: ${review.valoracion}`;
            reviewsList.appendChild(reviewItem);
        });
    })
    .catch(error => console.error('Error fetching reviews:', error));
}


document.addEventListener('DOMContentLoaded', () => {
    // Agrega el manejador de eventos al formulario
    document.getElementById('reviewForm').addEventListener('submit', function(event) {
        // Evita que el formulario se envíe de manera tradicional
        event.preventDefault();

        // Captura los valores del formulario
        const comentario = document.getElementById('comentario').value;
        const valoracion = document.getElementById('valoracion').value;

        // Llama a la función addReview con los valores del formulario
        addReview(comentario, valoracion);
    });

    // Llama a getReviews al cargar la página para obtener las reseñas existentes
    getReviews();
});

// Modifica la función addReview para aceptar parámetros
function addReview() {
    const comentario = document.getElementById('comentario').value;
    const valoracion = document.getElementById('valoracion').value;

    fetch('index.php?controller=review&action=addReview', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Cambiado a 'application/x-www-form-urlencoded'
        },
        body: `comentario=${comentario}&valoracion=${valoracion}`, // Cambiado a formato de cadena de consulta
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
        getReviews(); // Actualiza la lista de reseñas después de agregar una nueva
    })
    .catch(error => console.error('Error adding review:', error));
}

// Llama a getReviews al cargar la página para obtener las reseñas existentes
document.addEventListener('DOMContentLoaded', () => {
    getReviews();
});
