<?php
/* Crea una función calcularPtomedio($array) que reciba un arreglo
de numeros y retorne su promedio */

$numeros=[5,5,6,23,48,75,96,11,5,458];

function calcularPromedio($array){
    $keys=count($array);
    $suma=0;
    foreach($array as $num){
        $suma+=$num;
    };
    return $suma/$keys;

}

$promedio=calcularPromedio($numeros);
echo "El promedio del siguiente array es $promedio:";
echo "<hr/>";
var_dump($numeros);