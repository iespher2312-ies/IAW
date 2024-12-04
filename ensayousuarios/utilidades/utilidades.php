<?php
session_start();

function sanearCampo($campo)
{
    return htmlspecialchars(trim($campo));
}

function validarCampo($min, $max, $campo, $nomCampo)
{
    if (strlen($campo) < $min || strlen($campo) > $max) {
        $_SESSION['err' . $nomCampo] = "Vaya, nos hemos perdido en $nomCampo. Revíselo e intentelo de nuevo";
        return true;
    }
    return false;
}

function validarEmail($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return false;
    }
    $_SESSION['errEmail']="Vaya, nos hemos perdido en el Email. Revíselo e intentelo de nuevo";
    return true;
}

function showError($campo){
    if(isset($_SESSION['err'.$campo])){
        echo "<p class='text-red-500 text-xs'>".$_SESSION['err'.$campo].'</p>';
        unset($_SESSION['err'.$campo]);
    }
}