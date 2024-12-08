<?php


$id = $_GET['id'];
require_once("db.php");
$query = mysqli_query($conexion, "DELETE FROM inventario WHERE id = '$id'");

header('Location: ../views/inventario.php?m=1');
