<?php
/* Crea una funcion precioFinal2($precio, $impuesto) que reciba un precio original y un porcentaje de impuesto. Calcula y retorna el precio tras aplicar el impuesto */

function precioFinal2($precio, $impuesto){
    $percent=intval($impuesto);
    //Fuente: https://www.php.net/manual/en/function.intval.php
    $calculo="0.".$percent;
    $aSumar=$precio*$calculo;
    return $precio+$aSumar;
}

$precioConImpuestos=precioFinal2(10, '21%');
echo "El precio final con impuestos del artículo es de $precioConImpuestos";