<?php
/* Crea una función buscarEnArray($array, $elemento) que busque
un elemento en un arreglo, y que retorne si lo encuentra true, y false si no */

function buscarEnArray($elemento, $array){
    if(in_array($elemento, $array)==true){
        return true;
    } else  {
        return false;
    }
    
}

$nombres=['Javier','María','Isaac'];
$encontrar=buscarEnArray("Isaac", $nombres);
echo "El resultado de la búsqueda es " . ($encontrar ? 'true' : 'false');
//Explicación de la línea anterior:
//Si $encontrar es true, entonces se imprime 'true', si no, se imprime 'false'