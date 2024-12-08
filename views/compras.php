<?php
include "../includes/header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
</head>

<body>
    <div class="col-xs-12">
        <br>
        <center>
            <h1><b>COMPRAS</b></h1>
        </center>
        <br>
        <div class="container">
            <div class="col-sm-12">

                <div>
                    <a href="../index.php" target="_blank" class="btn btn-warning"> Ir A Compras
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>

            </div>
        </div>

        <br>
        <div class="container">
            <div class="table-responsive ">
                <table class=" table table-striped" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Referencia</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        require_once("../includes/db.php");
                        $sql = "SELECT v.id,v.total,v.fecha, v.estado,v.registro, u.usuario, 
                        u.correo FROM vendidos v INNER JOIN usuarios u ON v.id_user = u.id ORDER BY v.fecha";
                        $results = mysqli_query($conexion, $sql);
                        $count = 1; // Inicializamos el contador
                        if ($results->num_rows > 0) {
                            foreach ($results as $key => $fila) {
                                $idVenta = $fila['id'];
                        ?>
                                <tr>
                                    <td style="color: green;"><b><?php echo $count++; ?></b></td>
                                    <td><?php echo $fila['correo']; ?></td>
                                    <td><?php echo $fila['registro']; ?></td>
                                    <td><?php echo '$' . $fila['total']; ?></td>
                                    <td><?php echo $fila['estado']; ?></td>
                                    <td>
                                        <a href="../includes/editarInvStatus.php?id=<?php echo $fila['id'] ?> " class="btn btn-primary">
                                            <i class="fa fa-edit "></i></a>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar<?php echo $idVenta; ?>">
                                            <i class="fa fa-search "></i>
                                        </button>
                                        <a href="../includes/eliminar_sales.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
                                            <i class="fa fa-trash "></i></a>


                                    </td>
                                </tr>

                        <?php     }
                        }
                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>
<?php include "../includes/footer.php"; ?>

</html>