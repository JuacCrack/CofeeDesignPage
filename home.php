<?php        
    error_reporting(0); 
    include ("backend/php/db.php");
    $categorias = "SELECT * FROM categorias";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frontend/styles/home.css">
    <title>Design</title>
</head>
<body>
    
    <section class="head">

        <div class="titulo">

            <h2>Diseño</h2>

        </div>

        <nav class="btnes">

                <a href="home.php">Home</a>

        </nav>

    </section>

    <section class="body">

        <div class="title">

            <h2>Categorias</h2>

            <a class="crear" href="#post">Crear</a>

        </div>
        
        <div class="categorias" id="categorias">

            <?php 
                $items = mysqli_query($conexion, $categorias);
                while ($row = mysqli_fetch_assoc ($items)) {
                  // Obtener la imagen en formato base64
                    $imagen_base64 = base64_encode($row['image_categoria']);
                    // Generar el código de fondo CSS con la imagen base64
                    $bg_bd = "background-image: url('data:image/jpeg;base64, " . $imagen_base64 . "');";
            ?>



                    <div class="menu-item" style="<?php echo $bg_bd; ?>">

                        <div class="blur">

                            <h2 class="h2"><?php echo $row ["nombre"]; ?></h2>

                            <div class="links">

                                <a class="a" href="#delete-<?php echo $row ["id"]; ?>">❌</a>
                                <a  class="a" href="#put-<?php echo $row ["id"]; ?>">📝</a>

                            </div>

                        </div>

                    </div>



                    <div class="popup-container" id="delete-<?php echo $row ["id"]; ?>">
            
                        <div class="popup">

                            <h4 class="delete">¿Desea eliminar la categoria <?php echo $row ["nombre"]; ?>? (Recuerde que se eliminaran todos los productos relacionados)</h4>

                            <div class="links">

                            <a class="a confirm" href="backend/php/backend.php?type=categorias&id=<?php echo $row["id"]; ?>&task=delete">SI</a>
                                <a  class="a" href="#">NO</a>

                            </div>

                        </div>

                    </div>

                    <div class="popup-container" id="put-<?php echo $row ["id"]; ?>">
            
                        <div class="popup">

                            <a href="#" class="cerrar">❌</a>

                            <form action="backend/php/backend.php?type=categorias&id=<?php echo $row["id"]; ?>&task=put" method="post" enctype="multipart/form-data" id="form_put">

                                <h3>Actualizar Categoria</h3>

                                <input type="text" name="namecput" id="" placeholder="Nombre" value="<?php echo $row ["nombre"]; ?>" required>

                                <label for="file_<?php echo $row ["id"]; ?>_put" class="emoji-upload"></label>
                                <input type="file" name="imgcput" id="file_<?php echo $row ["id"]; ?>_put">

                                <button class="btnsubmit" type="submit">Actualizar</button>

                            </form>

                        </div>

                    </div>
            
            <?php } ?>

        </div>

        <div class="popup-container" id="post">

            <div class="popup">

                <a href="#" class="cerrar">❌</a>

                <form action="backend/php/backend.php?type=categorias&task=post" method="post" enctype="multipart/form-data" id="form_categorias_post">

                    <h3>Crear nueva Categoria</h3>

                    <input type="text" name="namecpost" id="" placeholder="Nombre" required>

                    <h6>Añadir imagen</h6>

                    <label for="file_categorias_post" class="emoji-upload"></label>
                    <input type="file" name="imgcpost" id="file_categorias_post">

                    <button class="btnsubmit" type="submit">Cargar</button>

                </form>

            </div>

		</div>

        <div class="popup-container" id="200">

            <div class="popup">

                <a href="#" class="cerrar">❌</a>

                <h4>¡Consulta realizado con exito!</h4>

            </div>

        </div>

        <div class="popup-container" id="400">

            <div class="popup">

                <a href="#" class="cerrar">❌</a>

                <h4>No se pudo realizar la consulta</h4>

             </div>

        </div>

    </section>

    <section class="foot"><h6>© 2023 Coffee Break</h6></section>

    <script src="backend/scripts/script.js"></script>

</body>
</html>

