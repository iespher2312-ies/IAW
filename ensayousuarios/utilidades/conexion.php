<?php
try{
    //Declaramos llave
    $llave=mysqli_connect('127.0.0.1','user3','secret0','ENSAYO1');
} catch(Exception $ex){
    die("Error en la conexión.".$ex->getMessage());
}