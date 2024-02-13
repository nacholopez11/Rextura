 // Agrega un evento change a cada checkbox
 document.getElementById('platoPrincipalCheckbox').addEventListener('change', updateProductVisibility);
 document.getElementById('postreCheckbox').addEventListener('change', updateProductVisibility);
 document.getElementById('bebidaCheckbox').addEventListener('change', updateProductVisibility);

 function updateProductVisibility() {
     // Obtiene el estado actual de los checkboxes
     const platoPrincipalChecked = document.getElementById('platoPrincipalCheckbox').checked;
     const postreChecked = document.getElementById('postreCheckbox').checked;
     const bebidaChecked = document.getElementById('bebidaCheckbox').checked;

     // Filtra los productos según las categorías seleccionadas
     const productos = document.querySelectorAll('.producto-ind');
     productos.forEach(producto => {
         const categoria = producto.getAttribute('data-categoria');
         const isVisible = (platoPrincipalChecked && categoria === 'Plato_principal') ||
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