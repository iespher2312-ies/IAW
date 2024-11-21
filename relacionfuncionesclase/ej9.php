<?php
/* Crea una funcion generarCuadrados($n) que genere y retorne un array con los cuadrados de los numeros del 1 al $n*/

function generarCuadrados($n){
    $cuadrados=[];
    for($i=1;$i<=$n;$i++){
        $calculo=$i*$i;
        $cuadrados[]=$calculo;
    }
    return var_dump($cuadrados);
}

$genCua=generarCuadrados(120);
echo "$genCua";