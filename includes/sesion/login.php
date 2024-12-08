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
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <a class="navbar-brand" href="../../index.php"><i class="fa fa-shopping-bag" style="font-size: 35px;"></i> <b>OnlineShopping </b></a>

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
                <h3 class="text-center mb-4"><b>LOGIN</b></h3>
                <p class="text-center ">Ingrese su usuario y contraseña</p>

                <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo "<div class='alert alert-warning' role='alert'>
                    Usuario y/o contraseña incorrectos, Intentalo de nuevo.
                    </div>";
                }
                ?>
                <form action="validarSesion.php" method="post">
                    <div class="form-group">
                        <label for="usuario" class="form-label fs-6">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <br>
                    <div class="form-group"">
                        <label for=" password" class="form-label fs-6">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" required>
                    </div>
                    <br>
                    <center> <button type="submit" class="btn btn-primary ">Iniciar Sesión</button></center>
                </form>
                <br>
                <center>
                    <p>¿Aun no tienes cuenta?<a href="registroUser.php"> Registrar</a></p>
                </center>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>