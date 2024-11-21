<?php
/* Crea una función reemplazarTexto($cadena, $buscado, $reemplazo) que reemplace todas las ocurrencias de un texto buscado por otro texto. Muestra el resultado */

function reemplazarTexto($cadena, $buscado, $reemplazo){
    $reemplazo=str_replace($buscado, $reemplazo, $cadena);
    echo "$reemplazo";
}

//Fuente: https://www.php.net/manual/es/function.str-replace.php

reemplazarTexto('Pepe se fue a la casa de miedo','miedo','la alegría');