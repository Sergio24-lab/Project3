// Funcion para procesar y agregar al carrito
$(document).ready(function () {
    $('.agregar-carrito').on('click', function () {
        var idArt = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        var precioVenta = $(this).data('precioventa');
        var status = $(this).data('status');

       
        if ($(this).data('stock') > 0 && status !== 'No Disponible') {
            $.ajax({
                url: './includes/agregarCarrito.php',
                method: 'POST',
                data: {
                    idArt: idArt,
                    descripcion: descripcion,
                    cantidad: 1,  // Siempre enviamos 1 como cantidad
                    status: status,
                    precioVenta: precioVenta
                },
                success: function (response) {
                    alert('Artículo agregado al carrito!');
                },
                error: function () {
                    alert('Hubo un error al agregar el artículo al carrito.');
                }
            });
        } else {
            alert('Este artículo no puede ser agregado al carrito. Verifica la disponibilidad y cantidad.');
        }
    });
});




//Funcion para elimar del carrito los art agregadas

$(document).ready(function () {
    $('.eliminar-carrito').on('click', function () {
        var index = $(this).data('index');
        $.ajax({
            url: './includes/eliminarCarrito.php',
            method: 'POST',
            data: {
                index: index
            },
            success: function (response) {
                alert('Película eliminada del carrito!');
                location.reload();
            }
        });
    });
});
