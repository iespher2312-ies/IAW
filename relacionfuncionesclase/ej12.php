<?php
/* Crea una función precioFinal3($precio, $porcentaje, $tipo) que reciba
un precio original un porcentaje y un tipo. Tipo valdrá -1 su el porcentaje 
es para rebajar el precio y 1 si es para subirlo. Filtraremos los valores
para dar un mensaje de error:
$precio =>float, mayor que cero
$porcentaje=>floar, entre 1 y 100
$tipo=>int -1 o 1 */

function precioFinal3($precio, $porcentaje, $tipo){
    $errores=false;
    $mensajeError=[];
    if($precio < 0){
        $errores=true;
        $mensajeError=['El campo precio es menor que cero.'];
    }
    if(intval($porcentaje) < 1 ||intval($porcentaje) > 100){
        $errores=true;
        $mensajeError=['El campo porcentaje no es valido.'];
    }
    if(!$tipo==-1||!$tipo==1){
        $errores=true;
        $mensajeError=['El campo tipo no es valido.'];
    }
    if($errores){
        echo "<h1>Se han encontrado los siguientes errores:</h1>";
        echo "<ol>";
        foreach($mensajeError as $mensaje){
            echo "<li>$mensaje</li>";
        };
        echo "</ol>";
    } elseif($tipo==-1) {
        $percent=intval($porcentaje);
        //Fuente: https://www.php.net/manual/en/function.intval.php
        $calculo="0.".$percent;
        $aDescontar=$precio*$calculo;
        return $precio-$aDescontar;
    } else {
        $percent=intval($porcentaje);
        //Fuente: https://www.php.net/manual/en/function.intval.php
        $calculo="0.".$percent;
        $aSumar=$precio*$calculo;
        return $precio+$aSumar;
    }
}

$precioFinal=precioFinal3(20, '21%', 1);

echo "El precio final es de $precioFinal.<br/>";

$precioFinal=precioFinal3(20, '21%', -1);

echo "El precio final es de $precioFinal.<br/>";