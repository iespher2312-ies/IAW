<?php
$id=(int)$_GET['id'];
require __DIR__ . "/../utilidades/conexion.php";
$q="delete from usuarios where id=?";
$stmt=mysqli_stmt_init($llave);
mysqli_stmt_prepare($stmt, $q);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location:usuarios.php");