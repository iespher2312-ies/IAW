<?php
/* Crea una función saludar ($nombre) que reciba un nombre y devuelva
un saludo personalizado */
function saludo($nombre){
    echo "Hola, $nombre.<br/>";
}

saludo("Isaac");
$nombre="Juan";
saludo($nombre);