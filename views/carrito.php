<link rel="stylesheet" href="../css/carrito.css">
<?php
include "encabezado.php";
include "../includes/db.php";
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_rol']) || !isset($_SESSION['usuario'])) {
    
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Acceso denegado</title>
        <link rel='stylesheet' href='../css/style.css'>
    </head>
    <body>
        <div class='container'>
        <div class='alert alert-warning' role='alert'>
        Para ver esta página, debes iniciar sesión.</div>
            <p></p>
            <a href='../includes/sesion/login.php' class='btn btn-primary'>Iniciar sesión</a>
        </div>
    </body>
    </html>";
    exit; 
}

$usuario = $_SESSION['usuario']; 
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $id_user = $row['id'];
    $user = $row['usuario'];
    $correo = $row['correo'];
} else {
    $user = 'Usuario desconocido';
    $correo = 'Correo desconocido';
}

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar al carrito</title>

    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/functions.js"></script>
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container">
        <form action="" method="post">
            <h3><b>AGREGAR AL CARRITO</b></h3>

            <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user; ?>">

            <p><b>Usuario: </b><?php echo $user; ?></p>
            <p><b>Correo: </b><?php echo $correo; ?></p>
            <p><b>Fecha: </b> <?php echo date('d-m-Y'); ?></p>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Artículo</th>
                            <th>Cant</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalGeneral = 0; // Inicializar el total

                        foreach ($carrito as $index => $item) :
                            $totalItem = $item['cantidad'] * $item['precioVenta'];
                            $totalGeneral += $totalItem;
                        ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $item['descripcion']; ?></td>
                                <td><?php echo $item['cantidad']; ?></td>
                                <td><?php echo '$' . $item['precioVenta']; ?></td>

                                <input type="hidden" name="idArt" id="idArt" value="<?php echo $item['idArt']; ?>">
                                <td>
                                    <button class="btn btn-danger eliminar-carrito" data-index="<?php echo $index; ?>"> <i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <h4>Total: <?php echo '$' . number_format($totalGeneral, 2); ?></h4> <!-- Muestra el total -->
            <br>
            <button type="button" id="SaveCompra" class="btn btn-primary">Guardar Registro</button>
        </form>
    </div>
    <!-- /.container-fluid -->

    <script>
        $(document).ready(function() {
            $('#SaveCompra').on('click', function(event) {
                event.preventDefault();

                var productos = <?php echo json_encode($carrito); ?>;
                var id_user = $('#id_user').val();
                var totalAmount = <?php echo $totalGeneral; ?>;


                if (productos.length === 0) {
                    alert('El carrito está vacío. Selecciona un artículo antes de generar la compra.');
                    return;
                }

                $.ajax({
                    url: '../includes/functions.php',
                    method: 'POST',
                    data: {
                        accion: 'saveItms',
                        id_user: id_user,
                        total: totalAmount,
                        productos: JSON.stringify(productos)
                    },
                    success: function(response) {
                        console.log(response);
                        var res = JSON.parse(response);
                        console.log(res);
                        if (res.status === 'success') {
                            alert(res.message);
                            window.location.reload();
                        } else {
                            alert('Error: ' + (res.message || 'No se pudo completar la operación'));
                        }
                    },

                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error: ' + textStatus);
                    }
                });
            });
        });
    </script>
    <?php include "pie.php"; ?>
</body>

</html>