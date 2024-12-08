<!-- Modal -->

<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Articulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="formAdd">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Descripcion: </label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo">Stock: </label>
                                <input type="number" min="1" class="form-control" id="stock" name="stock" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">PrecioVenta: </label>
                                <input type="number" min="1" class="form-control" id="precioVenta" name="precioVenta" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_rol">Status: </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Selecciona una opcion</option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="No Disponible">No Disponible</option>
                                    <option value="Agotado">Agotado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password">Categoria: </label>
                        <select name="id_cat" id="id_cat" class="form-control">
                            <option value="">Selecciona una opcion</option>
                            <?php
                            include("../includes/db.php");
                            $sql = "SELECT * FROM categorias ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['categoria'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="accion" value="SaveArt">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#formAdd').submit(function(e) {
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