<?php
include "../includes/header.php"; ?>
<?php
extract($_GET);
require_once("db.php");
$consult = "SELECT * FROM vendidos WHERE id = '$id'";
$result = mysqli_query($conexion, $consult);
if ($result->num_rows > 0) {
    foreach ($result as $key => $fila) {
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Status</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Editar Status</h2>
        <br>
        <form id="editStatus<?php echo $fila['id']; ?>" method="POST">

            <br>
            <div class="form-group">
                <label for="password">Status: </label>
                <select name="estado" id="estado" class="form-control">
                    <option <?php echo $fila['estado'] === 'Confirmado' ? "selected='selected' " : "" ?> value="Confirmado">Confirmado</option>
                    <option <?php echo $fila['estado'] === 'Pendiente' ? "selected='selected' " : "" ?> value="Pendiente">Pendiente</option>
                    <option <?php echo $fila['estado'] === 'Rechazado' ? "selected='selected' " : "" ?> value="Rechazado">Rechazado</option>
                </select>
            </div>

            <br>
            <input type="hidden" name="accion" value="editarStatus">
            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="editStatus(<?php echo $fila['id']; ?>)">Guardar</button>
                <a href="../views/compras.php" class="btn btn-danger">Cancelar</a>
            </div>

            <br>
        </form>
    </div>
</body>
<script>
    function editStatus(id) {
        var datosFormulario = $("#editStatus" + id).serialize();

        $.ajax({
            url: "functions.php",
            type: "POST",
            data: datosFormulario,
            dataType: "json",
            success: function(response) {
                if (response === "correcto") {
                    alert("El registro se ha actualizado correctamente.");
                    location.assign('../views/compras.php');
                } else {
                    alert("Ha ocurrido un error al actualizar el registro.");
                }
            },
            error: function() {
                alert("Ha ocurrido un error al comunicarse con el servidor.");
            }
        });
    }
</script>

<?php include "../includes/footer.php"; ?>

</html>