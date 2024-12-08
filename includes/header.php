<?php
error_reporting(0);
session_start();
$id_rol = $_SESSION['id_rol'];
$usuario  = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
    $mensaje = "
    <div class='alert alert-warning' role='alert'>
        Para poder comprar, debes iniciar sesión.
    </div>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/dataTables.min.js"></script>

</head>
<style>
    .container {
  flex: 1; 
}
</style>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- Logo -->
                <a class="navbar-brand" href="../index.php">
    <i class="fa fa-paw" style="font-size: 35px;"></i> 
    <b>PetShop</b>
</a>

                <!-- Barra de búsqueda -->
                <form class="d-flex" role="search" style="flex-grow: 1; margin: 0 20px;">
                    <input class="form-control me-2" id="buscarEx" type="search" placeholder="Buscar productos, marcas y más..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fa fa-search"></i></button>
                </form>

                <!-- Carrito y usuario -->
                <div class="d-flex align-items-center">
                    <a class="nav-link" href="../views/inventario.php">
                    <i class="fa fa-warehouse"></i> Inventario
                    </a>
                    <a class="nav-link" href="../views/compras.php">
                        <i class="fa fa-shopping-bag"></i> Compras
                    </a>
                    <a class="nav-link" href="../views/usuarios.php">
                        <i class="fa fa-users"></i> Usuarios
                    </a>

                    <!-- <a class="nav-link" href="login.php">
                        <i class="fas fa-user-circle"></i> Ingresar
                    </a>-->

                    <!-- Dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog"></i> Soporte
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                           
                            <a class="dropdown-item" href="../views/about.php"><i class="fa fa-question-circle"></i> Acerca De</a>



                            <?php if (isset($_SESSION['usuario'])): ?>
                                <a class="dropdown-item" href="../includes/sesion/cerrarSesion.php"><i class="fa fa-sign-out"></i> Cerrar Sesion</a>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>
        </nav>


    </header>
</body>

</html>