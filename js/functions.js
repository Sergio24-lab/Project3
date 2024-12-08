$(document).ready(function () {
    $('.agregar-carrito').on('click', function () {
        var idArt = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        var precioVenta = $(this).data('precioVenta');
        var status = $(this).data('status');
        var stock = $(this).data('stock');

        // Obtener los datos del formulario
        var nombre = $(this).data('nombre') ? $(this).closest('.form-carrito').find($(this).data('nombre')).val() : '';
        var raza = $(this).data('raza') ? $(this).closest('.form-carrito').find($(this).data('raza')).val() : '';
        var contacto = $(this).data('contacto') ? $(this).closest('.form-carrito').find($(this).data('contacto')).val() : '';
        var email = $(this).data('email') ? $(this).closest('.form-carrito').find($(this).data('email')).val() : '';
        var otrosDatos = $(this).data('otros-datos') ? $(this).closest('.form-carrito').find($(this).data('otros-datos')).val() : '';

        // Verificar si hay stock y el producto tiene estado disponible
        if (stock > 0 && status !== 'No Disponible') {
            $.ajax({
                url: 'functions.php',  // Asegúrate de que esto apunte a tu archivo functions.php
                method: 'POST',
                data: {
                    accion: 'agregarCarrito',
                    idArt: idArt,
                    descripcion: descripcion,
                    cantidad: 1,  // Siempre añadimos 1 como cantidad
                    status: status,
                    precioVenta: precioVenta,
                    nombre: nombre,
                    raza: raza,
                    contacto: contacto,
                    email: email,
                    otrosDatos: otrosDatos
                },
                success: function (response) {
                    alert('Producto agregado al carrito');
                    console.log(response);  // Para ver la respuesta en la consola
                },
                error: function () {
                    alert('Hubo un error al agregar el producto al carrito.');
                }
            });
        } else {
            alert('Este producto no está disponible o no tiene stock.');
        }
    });
});




//Funcion para elimar del carrito las peliculas agregadas

$(document).ready(function () {
    $('.eliminar-carrito').on('click', function () {
        var index = $(this).data('index');
        $.ajax({
            url: '../includes/eliminarCarrito.php',
            method: 'POST',
            data: {
                index: index
            },
            success: function (response) {
                alert('Articulo eliminada del carrito!');
                location.reload();
            }
        });
    });
});
