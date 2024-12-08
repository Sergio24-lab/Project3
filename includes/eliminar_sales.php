<?php


$id = $_GET['id'];
require_once("db.php");
$query = mysqli_query($conexion, "DELETE FROM vendidos WHERE id = '$id'");

header('Location: ../views/shopping.php?m=1');
