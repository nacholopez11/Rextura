window.addEventListener('DOMContentLoaded', (event) => {
    // Obtén los elementos del DOM
    let checkboxAplicarPropinas = document.getElementById('aplicarPropinas');
    let campoPropina = document.getElementById('campoPropina');
    let inputPropina = document.getElementById('propina');

    // Añade un controlador de eventos al checkbox
    checkboxAplicarPropinas.addEventListener('change', function() {
        if (this.checked) {
            // Si el checkbox está marcado, muestra el campo de entrada de la propina y establece su valor en 3
            campoPropina.style.display = 'block';
            inputPropina.value = 3;
        } else {
            // Si el checkbox no está marcado, oculta el campo de entrada de la propina y establece su valor en 0
            campoPropina.style.display = 'none';
            inputPropina.value = 0;
        }
    });

    // Dispara el evento change para inicializar el estado del campo de entrada de la propina
    checkboxAplicarPropinas.dispatchEvent(new Event('change'));
});