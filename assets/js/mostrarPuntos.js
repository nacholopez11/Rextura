window.addEventListener('DOMContentLoaded', (event) => {
    let usuarioId = document.getElementById('usuarioId').value;

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
        console.log(data);
        let puntos = data.puntos;

        let tabla = document.querySelector('.contenido-resumen table tbody');
        tabla.insertAdjacentHTML('beforeend', `
            <tr>
                <th class="palabra-dos">Puntos de fidelidad</th>
                <td class="precio-uno">${puntos}</td>
            </tr>
        `);
    })
    .catch(error => {
        console.log(error);
        notie.alert({ type: 'error', text: 'Error al obtener los puntos de fidelidad', time: 2 });
    });
});