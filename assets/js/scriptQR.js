let confirmarPedido = document.getElementById('pedido');
let usuarioId = document.getElementById('usuarioId').value;

confirmarPedido.addEventListener('submit', function (event) {
    event.preventDefault(); // Evita la recarga de la página

    // Crea un elemento div temporal para generar el código QR
    let tempElement = document.createElement('div');

    // Genera el código QR
    let qrcode = new QRCode(tempElement, {
        text: 'https://localhost/rextura/index.php?controller=product&action=mostrarPedido&usuarioId=' + usuarioId,
        width: 128,
        height: 128
    });

    // Espera a que el código QR se genere
    setTimeout(function() {
        // Obtiene la imagen del código QR
        var qrImage = tempElement.getElementsByTagName('img')[0];

        // Muestra el código QR en un pop-up de SweetAlert
        Swal.fire({
            title: 'Código QR del Pedido',
            imageUrl: qrImage.src,
            imageAlt: 'Código QR',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Después de que el usuario confirma, realiza la redirección
            window.location.href = 'index.php?controller=product&action=panelHome';
        });
    }, 1000);
});