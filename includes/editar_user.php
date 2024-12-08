<!-- Modal -->

<div class="modal fade" id="editar<?php echo $fila['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm<?php echo $fila['id']; ?>">

                    <div class="register-page">
                        <label for="usuario"><i class="fas fa-user"></i> Usuario: </label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $fila['usuario']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="correo"><i class="fas fa-envelope"></i> Email: </label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $fila['correo']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="id_rol"><i class="fas fa-user"></i> Tipo User: </label>
                        <select name="id_rol" id="id_rol" class="form-control">
                            <option <?php echo $fila['id_rol'] === 'id_rol' ? "selected='selected' " : "" ?> value="<?php echo $fila['id_rol']; ?>"><?php echo $fila['rol']; ?> </option>
                            <?php

                            include("../includes/db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM permisos ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['rol'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="accion" value="editar_user">
                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="editForm(<?php echo $fila['id']; ?>)">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editForm(id) {
        var datosFormulario = $("#editForm" + id).serialize();

        $.ajax({
            url: "../includes/functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "correcto") {
                    alert('Datos Modificados: El registro se ha actualizado correctamente.');
                    window.location.reload();
                } else {
                    alert('Error: Ha ocurrido un error al actualizar el registro.');
                }
            },
            error: function() {
                alert('Error: Ha ocurrido un error al comunicarse con el servidor.');
            }
        });
    }
</script>