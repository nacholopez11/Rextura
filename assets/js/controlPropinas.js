window.addEventListener('DOMContentLoaded', (event) => {
    let propinaInput = document.getElementById('propina');
    let aumentarPropinaButton = document.getElementById('aumentarPropina');
    let disminuirPropinaButton = document.getElementById('disminuirPropina');
    let omitirPropinaButton = document.getElementById('omitirPropina');

    aumentarPropinaButton.addEventListener('click', function() {
        let propina = parseInt(propinaInput.value);
        if (propina < 100) {
            propinaInput.value = propina + 1;
        }
    });

    disminuirPropinaButton.addEventListener('click', function() {
        let propina = parseInt(propinaInput.value);
        if (propina > 1) {
            propinaInput.value = propina - 1;
        }
    });

    omitirPropinaButton.addEventListener('click', function() {
        propinaInput.value = 0;
    });
});