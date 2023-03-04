<?php

   //INCLUIR DB 

   include ("db.php");

   //INCLUIR VARIABLES

   include ("var.php");

   // Obtener los valores de la id y la task desde la URL
   $id = $_GET['id'];
   $task = $_GET['task'];
   $type = $_GET['type'];

   //Datos de Categorias
   //POST CATEGORIAS
   $namecpost = $_POST['namecpost'];
   $checkpost = getimagesize($_FILES["imgcpost"]["tmp_name"]);
   $imagepost = $_FILES['imgcpost']['tmp_name'];
   $imgcpost = addslashes(file_get_contents($imagepost));
   //PUT CATEGORIAS
   $namecput = $_POST['namecput'];
   $checkput = getimagesize($_FILES["imgcput"]["tmp_name"]);
   $imageput = $_FILES['imgcput']['tmp_name'];
   $imgcput = addslashes(file_get_contents($imageput));
   
  
   //Verifica el tipo de dato
   if ($type == 'categorias') {

         // Ejecutar la task correspondiente
      if ($task == 'delete') {

         // delete la fila correspondiente a la id
         $sql = "DELETE FROM categorias WHERE id = $id";
      
         if ($conn->query($sql) === TRUE) {
         header('Location: ../../home.php#200');
         } else {
            header('Location: ../../home.php#400');
         }

      } elseif ($task == 'put') {

         $sql = "UPDATE categorias SET nombre='$namecput', image_categoria='$imgcput' WHERE id='$id'";
      
         if ($conn->query($sql) === TRUE) {
            header('Location: ../../home.php#200');
         } else {
            header('Location: ../../home.php#400');
         }

      } elseif ($task == 'post') {

         $sql = "INSERT INTO categorias VALUES (DEFAULT, '$namecpost', '$imgcpost', NOW())";
      
         if ($conn->query($sql) === TRUE) {
            header('Location: ../../home.php#200');
         } else {
            header('Location: ../../home.php#400');
         }

      } elseif ($task == 'get') {
         // Obtener una fila específica o todas las filas
         // ...
      } else {
         echo "task no válida";
      }

   }
   elseif ($type == 'productos') {

      // Ejecutar la task correspondiente
   if ($task == 'delete') {
      // delete la fila correspondiente a la id
      $sql = "DELETE FROM categorias WHERE id = $id";
    
      if ($conn->query($sql) === TRUE) {
         header('Location: ../../home.php#200');
      } else {
        echo "Error al delete fila: " . $conn->error;
      }
    } elseif ($task == 'put') {
      // put la fila correspondiente a la id
      // ...
    } elseif ($task == 'post') {
      // post una nueva fila
      // ...
    } elseif ($task == 'get') {
      // Obtener una fila específica o todas las filas
      // ...
    } else {
      echo "task no válida";
    }

   }
   
   // Cerrar la conexión
   $conn->close();
   ?>
   
