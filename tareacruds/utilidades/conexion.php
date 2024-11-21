<?php
try {
    $llave = mysqli_connect('127.0.0.1', 'user2', 'secret0', 'CRUD1');
} catch (Exception $ex) {
    die('Error de conexión: ' . $ex->getMessage());
}
