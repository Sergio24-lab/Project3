$('.btn-del').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')

    Swal.fire({
        title: 'Estas seguro de eliminar este registro?',
        text: "¡No podrás revertir esto!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar!',
    }).then((result) => {
        if (result.value) {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro fue eliminado.',
                    'success'
                )
            }

            document.location.href = href;
        }
    })

})