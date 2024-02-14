// const contenedorQR = document.getElementById('contenedorQR');
// new QRCode(contenedorQR, 'https://www.youtube.com/');




window.addEventListener('DOMContentLoaded', (event) => {
    // Obtén los elementos del DOM
    let confirmarPedido = document.getElementById('pedido');
    let qrcode = document.getElementById('qrcode');
    let usuarioId = document.getElementById('usuarioId').value;

    confirmarPedido.addEventListener('submit', function() {
        // Obtiene los puntos del usuario
        fetch('https://localhost/rextura/index.php?controller=api&action=api&accion=crearQR&pedidoId=122', {
            method: 'GET',
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
            let pedido = data.pedido;

            qrcode = new QRCode(document.getElementById('qrcode').style.display = "none", {
                text: 'https://localhost/rextura/index.php?controller=product&action=panelInfoPedido',
                width: 128,
                height: 128
            });
            
            // Espera a que el código QR se genere
            setTimeout(function() {
                // Obtiene la imagen del código QR
                var qrImage = document.getElementById('qrcode').getElementsByTagName('img')[0];
            
                // Obtiene la URL de la imagen del código QR
                var qrImageUrl = qrImage.src;
            
                // Aquí puedes enviar qrImageUrl a tu servidor y guardarlo
            }, 1000);



        })
        .catch(error => {
            console.log(error);
            notie.alert({ type: 'error', text: 'Error al crear el QR', time: 2 });
        });
    });
});













// meterle class hidden a el qrcode asi no se ve y se puede guardar
// Genera el código QR
var qrcode = new QRCode(document.getElementById('qrcode'), {
    text: 'https://localhost/rextura/index.php?controller=api&action=api&accion=crearQR&pedidoId=122',
    width: 128,
    height: 128
});

// Espera a que el código QR se genere
setTimeout(function() {
    // Obtiene la imagen del código QR
    var qrImage = document.getElementById('qrcode').getElementsByTagName('img')[0];

    // Obtiene la URL de la imagen del código QR
    var qrImageUrl = qrImage.src;

    // Aquí puedes enviar qrImageUrl a tu servidor y guardarlo
}, 1000);