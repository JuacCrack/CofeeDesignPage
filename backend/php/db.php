<?php

// Conexión a la base de datos "cafeteria"
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafeteria";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if (!$conn) {
   die("Error de conexión: " . mysqli_connect_error());
}

?>
