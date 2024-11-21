<?php
REQUIRE __DIR__ . '/../utilidades/conexion.php'; //Llamamos al archivo conexión
REQUIRE __DIR__ . '/../utilidades/utilidades.php'; //Llamamos al archivo utilidades 
if(!isset($_GET['id'])){ //Si no hay ID vuelve a la página productos
    header("Location:productos.php"); 
    exit();
}
$id=(INT)sanearCampos($_GET['id']); //Si hay ID, que lo sanee y lo convierta en INT
$q='delete from productos where id=?'; //Eliminar de productos donde el ID sea X
$stmt=mysqli_stmt_init($llave); //Iniciamos la sesión
mysqli_stmt_prepare($stmt, $q); //Preparamos la llave
mysqli_stmt_bind_param($stmt, 'i', $id); //Desparametrizamos
mysqli_stmt_execute($stmt); //Ejecutamos la consulta
mysqli_stmt_close($stmt); //Cerramos llave
mysqli_close($llave); //Cerramos sesión
header("Location:productos.php");
?>