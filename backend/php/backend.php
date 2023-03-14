<?php
   //INCLUIR DB 
   include ("db.php");

   //INCLUIR VARIABLES
// Obtener los valores de la id y la task desde la URL
$id = $_GET['id'];
$task = $_GET['task'];
$type = $_GET['type'];
$misc = $_GET['misc'];

//Datos de Categorias
$namec = $_POST['namec'];

//Datos de Productos
$namep = $_POST['namep'];
$id_catep = $_POST['id_catep'];
$descp = $_POST['descp'];
$pricep = $_POST['pricep'];

//IMAGEN 
$imagefilec = $_FILES['img']['tmp_name'];
$checkc = getimagesize($_FILES["img"]["tmp_name"]);

// Ruta donde se almacenarán las imágenes de categorías y productos
$dirc = 'img_comprimida/categorias/';
$dirp = 'img_comprimida/productos/';

// Función para comprimir imágenes
function compress_image($source_url, $quality) {
   $info = getimagesize($source_url);
   if ($info['mime'] == 'image/jpeg') {
       $image = imagecreatefromjpeg($source_url);
   } elseif ($info['mime'] == 'image/gif') {
       $image = imagecreatefromgif($source_url);
   } elseif ($info['mime'] == 'image/png') {
       $image = imagecreatefrompng($source_url);
   }
   ob_start(); // iniciar el búfer de salida
   imagejpeg($image, NULL, $quality); // generar la imagen comprimida
   $compressed_image = ob_get_contents(); // obtener la imagen comprimida como cadena de bytes
   ob_end_clean(); // limpiar el búfer de salida y desactivarlo
   return $compressed_image; // devolver la imagen comprimida
}

   //Verifica el tipo de dato
   if ($type == 'categorias') {
      try {
         if ($task == 'delete') {

            // eliminar imagen de la carpeta
            $filenamec = 'img_comprimida/categorias/' . $id . "bg.jpg";
            if (file_exists($filenamec)) {
               unlink($filenamec);
            }

            $sql = "DELETE FROM categorias WHERE id = '$id' ";

         } elseif ($task == 'put') {

         // Comprimir la imagen y obtener la imagen comprimida como una cadena de bytes
         $compressed_image = compress_image($imagefilec, 10);
         // Mover la imagen comprimida a la carpeta de destino
         $filenamec = basename($_FILES["img"]["name"]);
         $filenamec = pathinfo($filenamec, PATHINFO_FILENAME);
         $filenamec = $namec . "bg" . ".jpg"; // Agregar una marca de tiempo para evitar duplicados
         $target_filec = $dir . $filenamec;
         file_put_contents($target_filec, $compressed_image); // guardar la imagen comprimida en la ubicación de destino

            $sql = "UPDATE categorias SET nombre='$namec', fecha=NOW() WHERE id='$id'";

         } elseif ($task == 'post') {

         // Comprimir la imagen y obtener la imagen comprimida como una cadena de bytes
         $compressed_image = compress_image($imagefilec, 10);
         // Mover la imagen comprimida a la carpeta de destino
         $filenamec = basename($_FILES["img"]["name"]);
         $filenamec = pathinfo($filenamec, PATHINFO_FILENAME);
         // Verificar si la tabla está vacía y ejecutar TRUNCATE si es necesario
         $result = mysqli_query($conn, "SELECT COUNT(*) FROM categorias");
         $row = mysqli_fetch_row($result);
         $num_rows = $row[0];
         if ($num_rows == 0) {
            mysqli_query($conn, "ALTER TABLE categorias AUTO_INCREMENT = 1");
         }
         // Obtener el último ID
         $result = mysqli_query($conn, "SELECT MAX(id) FROM categorias");
         $row = mysqli_fetch_row($result);
         $last_id = $row[0];
         // Calcular el nuevo ID
         $new_id = $last_id + 1;
         // Utilizar el nuevo ID para nombrar la imagen comprimida
         $filenamec = $new_id . "bg.jpg";
         $target_filec = $dirc . $filenamec;
         file_put_contents($target_filec, $compressed_image); // guardar la imagen comprimida en la ubicación de destino

         $sql = "INSERT INTO categorias (nombre, fecha) VALUES ('$namec', NOW())";

         } elseif ($task == 'get') {
            // Obtener una fila específica o todas las filas
            // ...
         } else {
            throw new Exception("Tarea no válida: " . $task);
         }

         if ($task == 'get') {
            // Ejecutar consulta para obtener filas específicas o todas las filas
            // ...
         } else {
            if ($conn->query($sql) === TRUE) {
               $_SESSION['good_message'] = "La consulta se realizó con éxito";
               header('Location: ../../home.php#200');
               exit;
            } else {
               throw new Exception($conn->error);
            }
         }
      }  catch (Exception $e) {
         session_start();
         $_SESSION['error_message'] = "Error en la consulta: " . $e->getMessage();
         header('Location: ../../home.php#400');
         exit;
     }
   } elseif ($type == 'productos') {
      try {
        if ($task == 'delete') {

          // eliminar imagen de la carpeta
          $filenamec = 'img_comprimida/productos/' . $id . "bg.jpg";
          if (file_exists($filenamec)) {
             unlink($filenamec);
          }

          $sql = "DELETE FROM productos WHERE id = '$id' ";

        } elseif ($task == 'put') {
          // ...
        } elseif ($task == 'post') {

         // Comprimir la imagen y obtener la imagen comprimida como una cadena de bytes
         $compressed_image = compress_image($imagefilec, 8);
         // Mover la imagen comprimida a la carpeta de destino
         $filenamec = basename($_FILES["img"]["name"]);
         $filenamec = pathinfo($filenamec, PATHINFO_FILENAME);
         // Verificar si la tabla está vacía y ejecutar TRUNCATE si es necesario
         $result = mysqli_query($conn, "SELECT COUNT(*) FROM productos");
         $row = mysqli_fetch_row($result);
         $num_rows = $row[0];
         if ($num_rows == 0) {
            mysqli_query($conn, "ALTER TABLE productos AUTO_INCREMENT = 1");
         }
         // Obtener el último ID
         $result = mysqli_query($conn, "SELECT MAX(id) FROM productos");
         $row = mysqli_fetch_row($result);
         $last_id = $row[0];
         // Calcular el nuevo ID
         $new_id = $last_id + 1;
         // Utilizar el nuevo ID para nombrar la imagen comprimida
         $filenamec = $new_id . "bg.jpg";
         $target_filec = $dirp . $filenamec;
         file_put_contents($target_filec, $compressed_image); // guardar la imagen comprimida en la ubicación de destino
        
         $sql = "INSERT INTO productos (id_categoria, nombre, descripcion, precio, fecha) VALUES ('$id_catep', '$namep', '$descp', $pricep, NOW())";

        } elseif ($task == 'get') {
          // ...
        } else {
          throw new Exception("Tarea no válida: " . $task);
        }
        
        if ($task == 'get') {
          // ...
        } else {
          if ($conn->query($sql) === TRUE) {
            header('Location: ../../home.php#200');
          } else {
            throw new Exception($conn->error);
          }
        }
      }  catch (Exception $e) {
         session_start();
         $_SESSION['error_message'] = "Error en la consulta: " . $e->getMessage();
         header('Location: ../../home.php#400');
         exit;
     }
   } else {
      header('Location: ../../home.php#400');
      echo "Tipo de dato no válido: " . $type;
    }
   

   // Liberar Memoria
   $result->free();
      
   // Cerrar la conexión
   $conn->close();
?>


   
