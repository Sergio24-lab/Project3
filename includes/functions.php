<?php
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros
        case 'SaveUser':
            SaveUser();
            break;

        case 'SaveUser2':
            SaveUser2();
            break;

        case 'SaveArt':
            SaveArt();
            break;

        case 'editar_user':
            editar_user();
            break;

        case 'saveItms':
            saveItms();
            break;

        case 'editarArt':
            editarArt();
            break;

        case 'editarStatus':
            editarStatus();
            break;
    }
}

/*
Querido programador: 
cuando escribí este código, solo Dios y yo sabíamos cómo funcionaba. 
¡Ahora solo Dios lo sabe! 

Asi que si estas tratando de 'optimizar' esta rutina fracasa (seguramente),
porfavor incrementa el siguiente contador como una advertencia
para el siguiente colega:

total_de_horas_perdidas_aqui = 0 (CHISTE PARA ALEGRAR EL DIA)

Codigo fuente Original de SOFTCODEPM by Emmanuel. (Puedes usarlo para cualquier proposito que tengas)..
Sin embargo si vas a usar nuestro material para subir a Youtube o algun otro medio y hacerlo pasar por tuyo,
te agradeceriamos mucho si pudieras nombrarnos en los creditos o nos veremos obligados a DENUNCIAR tu contenido y Youtube eliminara el video
Hasta ahora van 4/6 canales con videos BORRADOS, evitanos la pena de hacerlo :v fuera de eso espero que te sirva este codigo

Mucha Suerte, modificalo a tu gusto!! 

*/
// Función para agregar un artículo al carrito




function agregarAlCarrito($idArt, $descripcion, $cantidad, $status, $precioVenta, $nombre, $raza, $contacto, $email, $otrosDatos)
{
    session_start();

    // Verificamos si ya existe un carrito en la sesión
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Comprobamos si el producto ya existe en el carrito
    $itemExists = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['idArt'] == $idArt) {
            // Si ya existe, solo actualizamos la cantidad
            $item['cantidad'] += $cantidad;
            $itemExists = true;
            break;
        }
    }

    // Si el producto no estaba en el carrito, lo añadimos
    if (!$itemExists) {
        $_SESSION['carrito'][] = [
            'idArt' => $idArt,
            'descripcion' => $descripcion,
            'cantidad' => $cantidad,
            'status' => $status,
            'precioVenta' => $precioVenta,
            'nombre' => $nombre,
            'raza' => $raza,
            'contacto' => $contacto,
            'email' => $email,
            'otrosDatos' => $otrosDatos
        ];
    }

    // Respuesta para indicar que el artículo fue agregado al carrito
    return json_encode(['status' => 'success', 'message' => 'Producto agregado al carrito']);
}

function saveItms()
{
    try {
        global $conexion;
        include "db.php";

        session_start();

        // Datos principales
        $total = $_POST['total'];
        $id_user = $_POST['id_user'];
        $estado = 'Pendiente'; // Estado inicial
        $productos = json_decode($_POST['productos'], true);
        $currentDate = date("Y-m-d");

        // Insertar en la tabla `vendidos`
        $addsalida = $conexion->query("INSERT INTO `vendidos`(`total`, `fecha`, `id_user`, `estado`) 
        VALUES ('$total', '$currentDate', '$id_user', '$estado')");
        $lastInsertedId = $conexion->insert_id;

        // Insertar productos en la tabla `prod_vendidos`
        foreach ($productos as $value) {
            $id = $value['idArt'];
            $cantidad = $value['cantidad'];
            $nombre = $value['nombre'];
            $raza = $value['raza'];
            $contacto = $value['contacto'];
            $email = $value['email'];
            $otrosDatos = $value['otrosDatos'];

            // Insertar en `prod_vendidos`
            $result = $conexion->query("INSERT INTO `prod_vendidos`(`id_producto`, `cantidad`, `id_venta`, `nombre`, `raza`, `contacto`, `email`, `otros_datos`) 
            VALUES ('$id', '$cantidad', '$lastInsertedId', '$nombre', '$raza', '$contacto', '$email', '$otrosDatos')");

            // Actualizar el stock en la tabla `inventario`
            $updateProducts = $conexion->query("UPDATE `inventario` SET `stock` = stock - $cantidad WHERE `id` = $id");
        }

        // Vaciar el carrito después de guardar
        unset($_SESSION['carrito']);

        // Respuesta
        $response = array("status" => "success", "message" => "Registro guardado exitosamente");
    } catch (Exception $e) {
        $response = array("status" => "error", "message" => $e->getMessage());
    }

    echo json_encode($response);
}



function SaveArt()
{
    global $conexion;
    extract($_POST);
    include "db.php";
    $fecha_subida = date('Y-m-d H:i:s');
    $consulta = "INSERT INTO inventario (descripcion, stock, precioVenta, status, id_cat, fecha) 
    VALUES ('$descripcion', '$stock', '$precioVenta', '$status', '$id_cat','$fecha_subida')";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        // Inserción exitosa
        $response = array(
            'status' => 'success',
            'message' => 'Los datos se guardaron correctamente'
        );
    } else {
        // Error al insertar en la base de datos
        $response = array(
            'status' => 'error',
            'message' => 'Ocurrió un error inesperado'
        );
    }
    echo json_encode($response);
}

function SaveUser()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    // Verificar si el correo electrónico ya existe
    $consulta_existencia = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
    if (mysqli_num_rows($resultado_existencia) > 0) {
        // El correo electrónico ya existe, devolver un mensaje de error
        $response = array(
            'status' => 'error',
            'message' => 'El correo electrónico ya está registrado'
        );
    } else {
        // Hash de la contraseña
        $hash_clave = password_hash($clave, PASSWORD_DEFAULT);

        // El correo electrónico no existe, proceder con la inserción
        $consulta = "INSERT INTO usuarios (usuario, correo, clave, id_rol) VALUES ('$usuario', '$correo', '$hash_clave', '$id_rol')";
        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
            // Inserción exitosa
            $response = array(
                'status' => 'success',
                'message' => 'Los datos se guardaron correctamente'
            );
        } else {
            // Error al insertar en la base de datos
            $response = array(
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado'
            );
        }
    }

    echo json_encode($response);
}


function SaveUser2()
{
    global $conexion;
    extract($_POST);
    include "db.php";
    $correo = $_POST['correo'];
    // Verificar si el correo electrnico ya existe
    $consulta_existencia = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
    if (mysqli_num_rows($resultado_existencia) > 0) {
        // El correo electrónico ya existe, devolver un mensaje de error
        $response = array(
            'status' => 'error',
            'message' => 'El correo electrónico ya está registrado'
        );
    } else {
        // Hash de la contraseña
        $hash_clave = password_hash($clave, PASSWORD_DEFAULT);

        // El correo electrónico no existe, proceder con la inserciónx
        $consulta = "INSERT INTO usuarios (usuario, correo, clave, id_rol) VALUES ('$usuario', '$correo', '$hash_clave', '$id_rol')";
        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
            // Inserción exitosa
            $response = array(
                'status' => 'success',
                'message' => 'Los datos se guardaron correctamente'
            );
        } else {
            // Error al insertar en la base de datos
            $response = array(
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado'
            );
        }
    }

    echo json_encode($response);
}

function editar_user()
{
    global $conexion;
    extract($_POST);
    include "db.php";

    $consulta = "UPDATE usuarios SET usuario = '$usuario',correo = '$correo',
    id_rol = '$id_rol' WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}



function editarArt()
{
    require_once("db.php");
    extract($_POST);


    if (!empty($_FILES['name_file']['name'])) {


        $consulta = "UPDATE inventario SET descripcion = '$descripcion', stock = '$stock', precioVenta = '$precioVenta', status = '$status',
        id_cat = '$id_cat' WHERE id = '$id' ";
    } else {

        $consulta = "UPDATE inventario SET descripcion = '$descripcion', stock = '$stock', precioVenta = '$precioVenta', status = '$status',
        id_cat = '$id_cat' WHERE id = '$id' ";
    }

    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado === true) {
        echo json_encode("updated");
    } else {
        echo json_encode("error");
    }
}

function editarStatus()
{
    require_once("db.php");
    extract($_POST);


    $consulta = "UPDATE vendidos SET estado = '$estado' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo json_encode("correcto");
    } else {
        echo json_encode("error");
    }
}
