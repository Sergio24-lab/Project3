<?php
include "../includes/header.php"; ?>
<?php
extract($_GET);
require_once("db.php");
$consult = "SELECT i.id, i.descripcion, i.stock, i.precioVenta, i.status, 
i.id_cat, i.name_file, i.fecha, c.categoria FROM inventario i INNER JOIN categorias c ON i.id_cat = c.id 
WHERE i.id = '$id'";
$result = mysqli_query($conexion, $consult);
if ($result->num_rows > 0) {
    foreach ($result as $key => $fila) {
        $ruta_imagen = $fila["name_file"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Editar Articulo</h2>
        <br>
        <form id="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario">Descripcion: </label>
                        <input type="text" class="form-control" data-id="<?php echo $fila['id']; ?>" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo">Stock: </label>
                        <input type="number" min="1" class="form-control" id="stock" name="stock" value="<?php echo $fila['stock']; ?>" required>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">PrecioVenta: </label>
                        <input type="number" min="1" class="form-control" id="precioVenta" name="precioVenta" value="<?php echo $fila['precioVenta']; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_rol">Categoria: </label>
                        <select name="status" id="status" class="form-control">
                            <option <?php echo $fila['status'] === 'Disponible' ? "selected='selected' " : "" ?> value="Disponible">Disponible</option>
                            <option <?php echo $fila['status'] === 'No Disponible' ? "selected='selected' " : "" ?> value="No Disponible">No Disponible</option>
                            <option <?php echo $fila['status'] === 'Agotado' ? "selected='selected' " : "" ?> value="Agotado">Agotado</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="password">Categoria: </label>
                <select name="id_cat" id="id_cat" class="form-control">
                    <option <?php echo $fila['id_cat'] === 'id_cat' ? "selected='selected' " : "" ?> value="<?php echo $fila['id_cat']; ?>"><?php echo $fila['categoria']; ?> </option>
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
            <br>

            <center>
                <div class="form-group">
                    <button type="button" id="submitedit" class="btn btn-primary">Guardar</button>
                    <a href="../views/inventario.php" class="btn btn-danger">Cancelar</a>
                </div>
            </center>
            <br>
        </form>
    </div>
</body>
<script>
    $("#submitedit").click(function(e) {
        e.preventDefault();

        var datos = new FormData();
        datos.append('accion', 'editarArt');
        datos.append('id', $("#descripcion").data("id"));
        datos.append('descripcion', $("#descripcion").val());
        datos.append('stock', $("#stock").val());
        datos.append('precioVenta', $("#precioVenta").val());
        datos.append('status', $("#status").val());
        datos.append('id_cat', $("#id_cat").val());

        fetch('functions.php', {
                method: 'POST',
                body: datos
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.statusText);
                }
                return response.json();
            })
            .then(response => {
                confirmation(response);
            })
            .catch(error => {
                console.error(error);
            });
    });

    function confirmation(r) {
        if (r && r === "updated") {
            alert('Datos Modificados');
            setTimeout(function() {
                url = "../views/inventario.php";
                $(location).attr('href', url);
            }, 1000);
        }
    }
</script>
<?php include "../includes/footer.php"; ?>

</html>