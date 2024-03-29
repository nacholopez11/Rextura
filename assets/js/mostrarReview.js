document.addEventListener('DOMContentLoaded', function() {
    fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=buscar_review')
    .then(response =>{
        return response.json();
    })
    .then(data => {
        console.log(data);
        verComentarios(data);
    })
    .catch(error => console.error(error));
});

function verComentarios(comentarios) {
    let reseñasClientes = document.getElementById('container');
    console.log(reseñasClientes);

    comentarios.forEach(comentario => {
        let divComentarios = document.createElement('div');
        divComentarios.classList.add('review', 'col-12', 'col-md-6', 'col-lg-3', `valoracion-${comentario.valoracion}`);

        divComentarios.innerHTML = `
        <div class="mx-16 mb-12 mb-lg-0 mx-6 m-lg-0 linea">
            <div class="contenidoReseñas">
                <p class="pedido_id s-titulo">Pedido ID: ${comentario.pedido_id}</p>
                <p class="nombre palabra-nombre">Usuario: ${comentario.nombre}</p> 
                <p class="comentario palabra-categoria">${comentario.comentario}</p>
                <p class="valoracion">${valoracionClientes(comentario.valoracion)}</p>
            <div>
        </div>
        `;

        reseñasClientes.appendChild(divComentarios);
    });
}

const valoracionClientes = (puntuacion) => {
    const estrellas = '★'.repeat(puntuacion) + '☆'.repeat(5-puntuacion);
    return `<span class="valoracion-${puntuacion}" style="color: var(--bg-col4);">${estrellas}</span>`;
}
