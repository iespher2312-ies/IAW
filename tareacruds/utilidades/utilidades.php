<?php
REQUIRE __DIR__ . '/../utilidades/conexion.php';
session_start();

function sanearCampos($campo)
{
    return htmlspecialchars(trim($campo));
};

function showError($campo)
{
    if (isset($_SESSION['error' . $campo])) {
        echo "<p class='text-red-600'>" . $_SESSION['error' . $campo] . "</p>";
        unset($_SESSION['error' . $campo]);
    }
}

function comprobarTexto($min, $max, $campo, $ncampo){
    if(strlen($campo) < $min || strlen($campo) > $max){
        $_SESSION['error'.$ncampo]="**El campo $ncampo debe de tener entre $min y $max carácteres.";
        return false;
    }
    return true;
}

function existeProducto($nombre, $llave){
    $q = 'select * from productos where nombre LIKE ?';
    $stmt = mysqli_stmt_init($llave);
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 's', $nombre);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $filas = mysqli_stmt_num_rows($stmt);
    if ($filas >= 1) {
        $_SESSION['errornombre'] = "****Error en el campo nombre. Ya EXISTE un producto con lo que has introducido. Indica otro nombre.";
        return true;
    }
    return false;
}

