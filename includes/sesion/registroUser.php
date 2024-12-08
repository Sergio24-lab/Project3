<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <a class="navbar-brand" href="../index.php"><i class="fa fa-shopping-bag" style="font-size: 35px;"></i> <b>OnlineShopping </b></a>

                <!-- Barra de búsqueda -->
                <form class="d-flex" role="search" style="flex-grow: 1; margin: 0 20px;">
                    <input class="form-control me-2" id="buscarEx" type="search" placeholder="Buscar productos, marcas y más..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fa fa-search"></i></button>
                </form>


            </div>
        </nav>


    </header>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-10">
                <h3 class="text-center mb-4"><b>Registro de Usuarios</b></h3>
                <p class="text-center ">Complete todos lo campos</p>

                <form id="formUser">
                    <div class="form-group">
                        <label for="usuario" class="form-label fs-6">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="correo" class="form-label fs-6">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <br>
                    <div class="form-group"">
                        <label for=" password" class="form-label fs-6">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" required>
                    </div>
                    <br>

                    <input type="hidden" name="id_rol" value="2">
                    <input type="hidden" name="accion" value="SaveUser2">

                    <center> <button type="submit" class="btn btn-primary ">Crear Cuenta</button></center>
                </form>
                <br>

                <center>
                    <p>¿Ya tienes cuenta?<a href="login.php"> Iniciar Sesion</a></p>
                </center>
            </div>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        $('#formUser').submit(function(e) {
            e.preventDefault(); 
            var formData = $(this).serialize(); 
            $.ajax({
                url: '../functions.php',
                type: 'POST',
                data: formData,
                dataType: 'json', 
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Los datos se guardaron correctamente');
                        window.location = "login.php"; 
                    } else {
                        alert(response.message); 
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error inesperado');
                }
            });
        });
    });
</script>

</html>