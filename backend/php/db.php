<?php

//DB SECOND

 // Conexión a la base de datos (poner los valores correctos)
 $servername = "bwefysr6dcffve1scrwm-mysql.services.clever-cloud.com";
 $username = "uszjl41ji4inbcc2";
 $password = "RBbqlirlw9xEpFGTCqNc";
 $dbname = "bwefysr6dcffve1scrwm";
 
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 // Verificar la conexión
 if ($conn->connect_error) {
   die("Error de conexión: " . $conn->connect_error);
 }

//DB

$conexion = mysqli_connect("bwefysr6dcffve1scrwm-mysql.services.clever-cloud.com","uszjl41ji4inbcc2","RBbqlirlw9xEpFGTCqNc","bwefysr6dcffve1scrwm")or die(
    "ERROR DE CONEXION");
    
?>