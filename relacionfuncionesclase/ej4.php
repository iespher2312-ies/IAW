<?php
/* Crea una función celsiusFahrenheit($celsius) que convierta
la temperatura de Celsius a Fahrenheit. Muestra el resultado de convertir 25
grados celsius */

function celsiusFahrenheit($celsius){
    $conversion=(($celsius*9/5)+32);
    echo "<b>$celsius ºC</b> equivalen a <b>$conversion ºF</b>";
}

celsiusFahrenheit(25);