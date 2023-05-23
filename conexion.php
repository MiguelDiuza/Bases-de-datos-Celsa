<?php

$servidor = "localhost";
$db = "id20735043_universidad_bd";
$username = "id20735043_rootmigueldiuza";
$password = "A@ronbebe5927";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$db", $username, $password);



} catch(Exception $e) {
    echo $e->getMessage();
}

?>