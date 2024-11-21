<?php
/* Crea una función logitudcadena($cadena) que reciba 
una cadena y retorne su longitud */
function longitudcadena($cadena){
    return strlen($cadena);
}

$cadena="Supercalifragrillisticoespialidoso";
$longcadena=longitudcadena($cadena);
echo "La longitud de la cadena <b>$cadena</b> es de $longcadena";