<?php

//DB SECOND

// Conexión a la base de datos (poner los valores correctos)
 $servername = "containers-us-west-45.railway.app";
 $username = "root";
 $password = "xlHxGLoU1ZSl5vzATMjZ";
 $dbname = "railway";
 $port = 7966;
 $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

//VERIFICAR LA CONEXION
 if (!$conn) {
   die("Error de conexión: " . mysqli_connect_error());
 }
 

//DB

$conexion = mysqli_connect("containers-us-west-45.railway.app", "root", "xlHxGLoU1ZSl5vzATMjZ", "railway", 7966) or die("ERROR DE CONEXION");
    
?>