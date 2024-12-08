<!-- Modal -->

<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUser">

                    <div class="register-page">
                        <label for="usuario"><i class="fas fa-user"></i> Usuario: </label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="correo"><i class="fas fa-envelope"></i> Email: </label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="example@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password: </label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Password..." required>
                    </div>
                    <div class="form-group">
                        <label for="id_rol"><i class="fas fa-user"></i> Tipo User: </label>
                        <select name="id_rol" id="id_rol" class="form-control">
                            <option value="">Selecciona una opcion</option>
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

                    <input type="hidden" name="accion" value="SaveUser">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#formUser').submit(function(e) {
            e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
            var formData = $(this).serialize(); // Serializa los datos del formulario
            $.ajax({
                url: '../includes/functions.php',
                type: 'POST',
                data: formData,
                dataType: 'json', // Espera una respuesta en formato JSON
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Los datos se guardaron correctamente');
                        window.location.reload();
                    } else {
                        alert(response.message); // Muestra el mensaje de error del servidor
                    }
                },
                error: function(xhr, status, error) {
                    alert('Ocurrió un error inesperado');
                }
            });
        });
    });
</script>