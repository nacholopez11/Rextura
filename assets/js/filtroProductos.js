// Agrega un evento change a cada checkbox
document.getElementById('platoPrincipalCheckbox').addEventListener('change', updateProductVisibility);
document.getElementById('postreCheckbox').addEventListener('change', updateProductVisibility);
document.getElementById('bebidaCheckbox').addEventListener('change', updateProductVisibility);

// Recupera los estados almacenados en localStorage
const platoPrincipalChecked = localStorage.getItem('platoPrincipalChecked') === 'true';
const postreChecked = localStorage.getItem('postreChecked') === 'true';
const bebidaChecked = localStorage.getItem('bebidaChecked') === 'true';

// Actualiza los estados de los checkboxes
document.getElementById('platoPrincipalCheckbox').checked = platoPrincipalChecked;
document.getElementById('postreCheckbox').checked = postreChecked;
document.getElementById('bebidaCheckbox').checked = bebidaChecked;

// Aplica la visibilidad inicial
updateProductVisibility();

function updateProductVisibility() {
    // Obtiene el estado actual de los checkboxes
    const platoPrincipalChecked = document.getElementById('platoPrincipalCheckbox').checked;
    const postreChecked = document.getElementById('postreCheckbox').checked;
    const bebidaChecked = document.getElementById('bebidaCheckbox').checked;

    // Guarda los estados en localStorage
    localStorage.setItem('platoPrincipalChecked', platoPrincipalChecked);
    localStorage.setItem('postreChecked', postreChecked);
    localStorage.setItem('bebidaChecked', bebidaChecked);

    // Filtra los productos según las categorías seleccionadas
    const productos = document.querySelectorAll('.producto-ind');
    productos.forEach(producto => {
        const categoria = producto.getAttribute('data-categoria');
        const isVisible = (!platoPrincipalChecked && !postreChecked && !bebidaChecked) ||
                          (platoPrincipalChecked && categoria === 'Plato_principal') ||
                          (postreChecked && categoria === 'Postre') ||
                          (bebidaChecked && categoria === 'Bebida');

        // Muestra u oculta el producto según la visibilidad
        if (isVisible) {
            producto.classList.remove('hidden');
        } else {
            producto.classList.add('hidden');
        }
    });
}