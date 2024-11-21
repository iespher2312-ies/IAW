<?php
/* 10:Crea una función precioFinal1($precio, $rebaja) que reciba un precio originaly un porcentaje de rebaja. Calcula y retorna el precio final tras aplicar la rebaja. */

function precioFinal1($precio, $rebaja){
    $percent=intval($rebaja);
    //Fuente: https://www.php.net/manual/en/function.intval.php
    $calculo="0.".$percent;
    $aDescontar=$precio*$calculo;
    return $precio-$aDescontar;
}

$promocionAplicada=precioFinal1(100, '50%');
echo "El precio final del articulo es $promocionAplicada.";