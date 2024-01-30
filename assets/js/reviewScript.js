document.addEventListener('DOMContentLoaded', (event) => {
    fetch('https://localhost/rextura/controller/index.php?controller=api&action=api&accion=get_reviews', {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        let reviewsList = document.getElementById('reviewsList');
        data.forEach(review => {
            let reviewElement = document.createElement('div');
            reviewElement.innerHTML = `
                <h2>${review.usuario_id}</h2>
                <p>${review.comentario}</p>
                <p>Valoración: ${review.valoracion}</p>
            `;
            reviewsList.appendChild(reviewElement);
        });
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

// function getReviews() {
//     fetch('https://localhost/rextura/controller/index.php?controller=api&action=api&accion=get_reviews')
//         .then(response => response.json())
//         .then(reviews => {
//             displayReviews(reviews);
//         })
//         .catch(error => console.error('Error fetching reviews:', error));
// }

// function displayReviews(reviews) {
//     const reviewsList = document.getElementById('reviewsList');
//     reviewsList.innerHTML = ''; 

//     reviews.forEach(review => {
//         const reviewElement = document.createElement('div');
//         reviewElement.innerHTML = `<p><strong>Usuario ID:</strong> ${review.usuario_id}</p>
//                                    <p><strong>Comentario:</strong> ${review.comentario}</p>
//                                    <p><strong>Valoración:</strong> ${review.valoracion}</p>
//                                    <hr>`;
//         reviewsList.appendChild(reviewElement);
//     });
// }