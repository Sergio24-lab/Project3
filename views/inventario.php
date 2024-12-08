<?php
include "../includes/header.php"; ?>

<div class="col-xs-12">
    <br>
    <center>
        <h1><b>INVENTARIO</b></h1>
    </center>
    <br>
    <div class="container">
        <div class="col-sm-12">

            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregar"> Agregar
                    <i class="fa fa-plus"></i>
                </button>
            </div>

        </div>
    </div>

    <br>
    <div class="container">
        <div class="table-responsive ">
            <table class=" table table-striped" id="table_id">
                <thead>
                    <tr>
                        <th>Articulo</th>
                        <th>Stock</th>
                        <th>PrecioVenta</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once("../includes/db.php");
                    $result = mysqli_query($conexion, "SELECT i.id, i.descripcion, i.stock, i.precioVenta, i.status, 
                    i.id_cat, i.fecha, c.categoria FROM inventario i INNER JOIN categorias c ON i.id_cat = c.id");
                    while ($fila = mysqli_fetch_assoc($result)) :

                    ?>
                        <tr>
                            <td><?php echo $fila['descripcion']; ?></td>
                            <td><?php echo $fila['stock']; ?></td>
                            <td><?php echo '$' . $fila['precioVenta']; ?></td>
                            <td><?php echo $fila['status']; ?></td>
                            <td><?php echo $fila['categoria']; ?></td>
                            <td><?php echo $fila['fecha']; ?></td>
                            <td>

                                <a href="../includes/editarInv.php?id=<?php echo $fila['id'] ?> " class="btn btn-warning">
                                    <i class="fa fa-edit "></i></a>
                                <a href="../includes/eliminar_inv.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
                                    <i class="fa fa-trash "></i></a>


                            </td>
                        </tr>



                    <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>



    <?php include "agregar_Art.php"; ?>
    <?php include "../includes/footer.php"; ?>
    </body>

    </html>