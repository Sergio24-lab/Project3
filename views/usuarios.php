<?php
include "../includes/header.php"; ?>

<div class="col-xs-12">
    <br>
    <center>
        <h1><b>USUARIOS</b></h1>
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
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once("../includes/db.php");
                    $result = mysqli_query($conexion, "SELECT u.id, u.usuario, u.correo, u.clave, u.fecha,u.id_rol,
                     p.rol FROM usuarios u INNER JOIN permisos p ON u.id_rol = p.id");
                    while ($fila = mysqli_fetch_assoc($result)) :

                    ?>
                        <tr>
                            <td><?php echo $fila['usuario']; ?></td>
                            <td><?php echo $fila['correo']; ?></td>
                            <td><?php echo $fila['id_rol']; ?></td>
                            <td><?php echo $fila['fecha']; ?></td>

                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editar<?php echo $fila['id']; ?>">
                                    <i class="fa fa-edit "></i>
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#change<?php echo $fila['id']; ?>">
                                    <i class="fa fa-key"></i>
                                </button>
                                <a href="../includes/eliminar_user.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
                                    <i class="fa fa-trash "></i></a></button>


                            </td>
                        </tr>

                        <?php include "../includes/editar_user.php"; ?>
                        <?php include "../includes/change_password.php"; ?>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>



    <?php include "agregar_user.php"; ?>
    <?php include "../includes/footer.php"; ?>
    </body>

    </html>