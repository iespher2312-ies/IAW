<?php
/* Crea una función contarPalabras($texto) que reciba un texto
y retorne la cantidad de palabras en él */

function contarPalabras($texto){
    return str_word_count($texto);
}

//Fuente: https://www.php.net/manual/es/function.str-word-count.php

$contar=contarPalabras("Doña Uzeada de Ribera Maldonado de Bracamonte y Anaya era baja, rechoncha, abigotada. Ya no existia razon para llamar talle al suyo. Sus colores vivos, sanos, podian mas que el albayalde y el soliman del afeite, con que se blanqueaba por simular melancolias. Gastaba dos parches oscuros, adheridos a las sienes y que fingian medicamentos. Tenia los ojitos ratoniles, maliciosos. Sabia dilatarlos duramente o desmayarlos con recato o levantarlos con disimulo. Caminaba contoneando las imposibles caderas y era dificil, al verla, no asociar su estampa achaparrada con la de ciertos palmipedos domesticos. Sortijas celestes y azules le ahorcaban las falanges");
echo "La longitud del texto indicado en la función, tiene un total de <b>$contar palabras.</b>";

/* Con explode puede hacerse */