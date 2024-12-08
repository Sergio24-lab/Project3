<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idArt = $_POST['idArt'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $status = $_POST['status'];
    $precioVenta = $_POST['precioVenta'];

    // Datos adicionales
    $nombre = $_POST['nombre'];
    $raza = $_POST['raza'];
    $contacto = $_POST['contacto'];
    $email = $_POST['email'];
    $otrosDatos = $_POST['otros_datos'];

    // Si no existe la sesión del carrito, inicializamos un arreglo vacío
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verificamos si el artículo ya está en el carrito
    $itemExists = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['idArt'] == $idArt) {
            $item['cantidad'] += $cantidad;  
            $itemExists = true;
            break;
        }
    }

    // Si el artículo no está en el carrito, lo agregamos
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
            'otros_datos' => $otrosDatos
        ];
    }

    echo json_encode(['success' => true]);
}
?>
