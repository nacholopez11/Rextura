function mostrarPuntosAGanar(totalPedido) {
    let puntosGanados = Math.floor(totalPedido / 10);
    let filaExistente = document.querySelector('.contenido-resumen table tbody .fila-puntos-ganados');
    if (filaExistente) {
        filaExistente.remove();
    }
    let tr = document.createElement('tr');
    tr.className = 'fila-puntos-ganados';  // Añade una clase para poder encontrar esta fila más tarde
    let th = document.createElement('th');
    th.className = 'palabra-dos';
    th.innerText = 'Puntos ganados con este pedido';
    let td = document.createElement('td');
    td.className = 'precio-uno';
    td.innerText = puntosGanados;
    tr.appendChild(th);
    tr.appendChild(td);
    document.querySelector('.contenido-resumen table tbody').appendChild(tr);
}

window.addEventListener('DOMContentLoaded', (event) => {
    // Obtén los elementos del DOM
    let checkboxUsarPuntos = document.getElementById('usarPuntos');
    let totalPedidoElement = document.getElementById('totalPedido');
    let precioFijo = document.getElementById('precioOriginal');
    let usuarioId = document.getElementById('usuarioId').value;
    let descuentoElement = document.getElementById('descuento');

    let checkboxAplicarPropinas = document.getElementById('aplicarPropinas');
    let campoPropina = document.getElementById('campoPropina');
    let inputPropina = document.getElementById('propina');


    // Almacena el total original del pedido
    let totalOriginal = parseFloat(totalPedidoElement.innerText.replace('€', ''));

    totalPedidoElement.innerText = (totalOriginal+(totalOriginal/100)*3);
    
    let nuevoTotalSinPropina = parseFloat(precioFijo.innerText.replace('€', ''));

    // Muestra los puntos que se ganarán con el pedido desde que se carga la página
    mostrarPuntosAGanar(totalOriginal);

    // Añade un controlador de eventos al checkbox
    checkboxUsarPuntos.addEventListener('change', function() {
        // Obtiene los puntos del usuario
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
            let puntos = data.puntos;

            // Calcula el descuento
            // MIRAR ESTA LINEA
            let descuento = this.checked ? Math.min(nuevoTotalSinPropina, puntos) : 0;

            // Calcula el nuevo total con descuento
            let nuevoTotal = totalOriginal - descuento;
            nuevoTotalSinPropina = totalOriginal - descuento;

            // Obtiene la propina desde el input
            let propinaPorcentaje = parseFloat(document.getElementById('propina').value);
            
            if(propinaPorcentaje = 1 && document.getElementById('aplicarPropinas').value == 'off'){
                propinaPorcentaje = 0;
            }

            let propina = (nuevoTotalSinPropina / 100) * propinaPorcentaje;

            // Añade la propina al total del pedido
            nuevoTotal = nuevoTotal + propina;

            // Actualiza el total del pedido en la página
            totalPedidoElement.innerText = nuevoTotal.toFixed(2) + ' €';

            // Actualiza el valor del campo oculto "descuento"
            descuentoElement.value = descuento;

            // Actualiza el valor del campo oculto "puntosUsados"
            document.getElementById('puntosUsados').value = descuento;

            // Llama a la función para mostrar los puntos ganados
            mostrarPuntosAGanar(nuevoTotal);

            let desc = document.getElementById('aplicarPropinas');
            desc.checked = false;
        })
        .catch(error => {
            console.log(error);
            notie.alert({ type: 'error', text: 'Error al obtener los puntos de fidelidad', time: 2 });
        });
    });

    // Añade un controlador de eventos al input de la propina
    document.getElementById('propina').addEventListener('input', function() {
        // Obtiene el total original del pedido y la propina desde el input
        let propinaPorcentaje = parseFloat(this.value);
        // Calcula la propina y el nuevo total del pedido
        let propina = (nuevoTotalSinPropina / 100) * propinaPorcentaje;
        let nuevoTotal = nuevoTotalSinPropina + propina;

        // Actualiza el total del pedido en la página
        totalPedidoElement.innerText = nuevoTotal.toFixed(2) + ' €';

        mostrarPuntosAGanar(nuevoTotal);
    });



    // Añade un controlador de eventos al checkbox
    checkboxAplicarPropinas.addEventListener('change', function() {
        if (this.checked) {
            // Si el checkbox está marcado, muestra el campo de entrada de la propina y establece su valor en 3
            campoPropina.style.display = 'block';
            inputPropina.value = 3;
            // let porcentaje = inputPropina.value;
            let propina = (nuevoTotalSinPropina / 100) * inputPropina.value;
            let nuevoTotal = nuevoTotalSinPropina + propina;

            totalPedidoElement.innerText = nuevoTotal.toFixed(2) + ' €';
            mostrarPuntosAGanar(nuevoTotal);
        } else {
            // Si el checkbox no está marcado, oculta el campo de entrada de la propina y establece su valor en 0
            campoPropina.style.display = 'none';
            inputPropina.value = 1;

            mostrarPuntosAGanar(nuevoTotalSinPropina);
            totalPedidoElement.innerText = nuevoTotalSinPropina.toFixed(2) + ' €';
        }
    });

    // Dispara el evento change para inicializar el estado del campo de entrada de la propina
    checkboxAplicarPropinas.dispatchEvent(new Event('change'));


});