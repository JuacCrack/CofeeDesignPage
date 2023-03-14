<?php       
 
 session_start();
if (isset($_SESSION['error_message'])) {
    echo "<div class='popup-container' id='400'>
            <div class='popup'>
                <a href='#' class='cerrar'>X</a>
                <h4>¡No se pudo realizar la consulta!</h4>
                <label for='mostrar-error' class='ver-detalles'>Ver detalles</label>
                <input type='checkbox' id='mostrar-error' class='oculto'>
                <div class='detalles'>
                    <h5>Detalles del Error</h5>
                    <p>".$_SESSION['error_message']."</p>
                </div>
            </div>
        </div>";
    // Limpiar la variable de sesión para que el mensaje de error no se muestre en futuras visitas
    unset($_SESSION['error_message']);
} elseif (isset($_SESSION['good_message'])) {
   
}

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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <title>Design</title>
</head>
<body>
    
    <section class="head">

        <nav class="btnes">

            <a class="btnhead" href="home.php">Diseño</a>

            <a class="btnhead" href="home.php"><h2 class="fix">Inicio</h2></a>

            <a class="btnhead" href="home.php">Edicion</a>

        </nav>

    </section>

    <section class="body">

        <div class="title">

            <h2>Categorias</h2>

            <a class="crear" href="#postc">Crear</a>

        </div>

        <!-- CATEGORIAS -->
        
        <div class="categorias" id="categorias">

            <?php 
                $items = mysqli_query($conexion, $categorias);
                while ($row = mysqli_fetch_assoc ($items)) {
            ?>



                    <div class="menu-item" style="background-image:url(backend/php/img_comprimida/categorias/<?php echo $row ["id"]; ?>bg.jpg);">

                        <div class="blur">

                            <h2 class="h2"><?php echo $row ["nombre"]; ?></h2>

                            <div class="links">

                                <a class="a" href="#delete-<?php echo $row ["id"]; ?>">🗑️</a>
                                <a  class="a" href="#put-<?php echo $row ["id"]; ?>">📝</a>

                            </div>

                        </div>

                    </div>

                    <div class="popup-container" id="delete-<?php echo $row ["id"]; ?>">
            
                        <div class="popup">

                            <h4 class="delete">¿Desea eliminar la categoria <?php echo $row ["nombre"]; ?>? (Recuerde que se eliminaran todos los productos relacionados)</h4>

                            <div class="links">

                            <a class="a confirm" href="backend/php/backend.php?type=categorias&id=<?php echo $row["id"]; ?>&task=delete">SI</a>
                                <a  class="a deny" href="#">NO</a>

                            </div>

                        </div>

                    </div>

                    <div class="popup-container" id="put-<?php echo $row ["id"]; ?>">
            
                        <div class="popup">

                            <a href="#" class="cerrar">X</a>

                            <form action="backend/php/backend.php?type=categorias&id=<?php echo $row["id"]; ?>&task=put" method="post" enctype="multipart/form-data" id="form_put">

                                <h3>Actualizar Categoria</h3>

                                <input type="text" name="namec" id="" placeholder="Nombre" value="<?php echo $row ["nombre"]; ?>" required>

                                <h6>Añadir imagen</h6>

                                <label for="file_<?php echo $row ["id"]; ?>_put" class="emoji-upload"></label>
                                <input type="file" name="img" id="file_<?php echo $row ["id"]; ?>_put">

                                <button class="btnsubmit" type="submit">Actualizar</button>

                            </form>

                        </div>

                    </div>
            
            <?php } ?>

        </div>

        <!-- CATEGORIAS POST -->

        <div class="popup-container" id="postc">

            <div class="popup">

                <a href="#" class="cerrar">X</a>

                <form action="backend/php/backend.php?type=categorias&task=post" method="post" enctype="multipart/form-data" id="form_categorias_post">

                    <h3>Crear nueva Categoria</h3>

                    <input type="text" name="namec" id="" placeholder="Nombre" required>

                    <h6>Añadir imagen</h6>

                    <label for="file_categorias_post" class="emoji-upload"></label>
                    <input type="file" name="img" id="file_categorias_post">

                    <button class="btnsubmit" type="submit">Cargar</button>

                </form>

            </div>

		</div>

        <!-- PRODUCTOS -->

        <div class="title">

         <h2>Productos</h2>

         <a class="crear" href="#postp">Crear</a>

        </div>

        <div class="categorias" id="productos">

            <?php 
             $items = mysqli_query($conexion, $categorias);
             while ($row = mysqli_fetch_assoc ($items)) {
             ?>

                <div class="cate_min" style=""><a href="#cate-<?php echo $row ["id"]; ?>" id="afull"><?php echo $row ["nombre"]; ?></a></div>

                <div class='popup-container' id="cate-<?php echo $row ["id"]; ?>">
                    <div class='popup'>
                        <a href='#' class='cerrar'>X</a>

                        <div class="productos">

                            <?php
                                $productos = "SELECT * FROM productos WHERE id_categoria = {$row['id']}";
                                $productos_items = mysqli_query($conexion, $productos);
                                while ($rowp = mysqli_fetch_assoc($productos_items)) {
    
                            ?>

                            <div class="item-producto">

                                <div class="mitad center">
                                    <div class="img-producto" style="background-image:url(backend/php/img_comprimida/productos/<?php echo $rowp ["id"]; ?>bg.jpg);"></div>
                                </div>

                                <div class="mitad">
                                    <h5><?php echo $rowp ["nombre"]; ?></h5>
                                    <p><?php echo $rowp ["descripcion"]; ?></p>
                                    <button>$<?php echo $rowp ["precio"]; ?></button>
                                </div>

                            </div>

                            <?php } ?>

                        </div>
                        
                    </div>
                    
                </div>

            <?php } ?>

        </div>

        <!-- PRODUCTOS POST -->

        <div class="popup-container" id="postp">

            <div class="popup">

                <a href="#" class="cerrar">X</a>

                <form action="backend/php/backend.php?type=productos&task=post" method="post" enctype="multipart/form-data" id="form_productos_post">

                    <h3>Crear nuevo Producto</h3>

                    <h6>¿Para que Categoria?</h6>

                    <select name="id_catep" id="">

                    <?php 
                        $items = mysqli_query($conexion, $categorias);
                        while ($row = mysqli_fetch_assoc ($items)) {
                    ?>

                    <option value="<?php echo $row ["id"]; ?>"><?php echo $row ["nombre"]; ?></option>

                    <?php } ?>

                    </select>

                    <h6>Nombre del Producto</h6>

                    <input type="text" name="" id="" placeholder="Nombre" required>

                    <h6>Añadir una Descripción</h6>

                    <input type="text" name="descp" id="" placeholder="Descripción" required>

                    <h6>Añadir un Precio</h6>

                    <input type="number" name="pricep" id="" placeholder="Precio" required>

                    <h6>Añadir imagen</h6>

                    <label for="file_productos_post" class="emoji-upload"></label>
                    <input type="file" name="img" id="file_productos_post">

                    <button class="btnsubmit" type="submit">Cargar</button>

                </form>

            </div>

		</div>

        <!-- PRODUCTOS DELETE -->

        <?php

         // Obtener los valores desde la URL
         $idpurl = $_GET['id'];
         $namepurl = $_GET['name'];

        ?>

        <div class='popup-container' id='deletep'>
            <div class='popup'>
                <a href='#' class='cerrar'>X</a>

                <h4 class="delete">¿Desea eliminar la categoria <?php echo $namepurl ?>? (Recuerde que esta acción es irreversible)</h4>

                <div class="links">

                    <a class="a confirm" href="backend/php/backend.php?type=productos&id=<?php echo $idpurl ?>&task=delete">SI</a>
                    <a  class="a deny" href="#">NO</a>

                </div>

            </div>
        </div>


        <!-- RESPUESTAS -->

        <div class='popup-container' id='200'>
            <div class='popup'>
                <a href='#' class='cerrar'>X</a>
                <h4>¡Consulta exitosa!</h4>
                <label for='mostrar-detalles' class='ver-detalles'>Ver detalles</label>
                <input type='checkbox' id='mostrar-detalles' class='oculto'>
                <div class='detalles'>
                    <h5>Detalles de la consulta</h5>
                    <p>".$_SESSION['good_message']."</p>
                </div>
            </div>
        </div>

    </section>

    <section class="foot"><h6>© 2023 Coffee Break</h6></section>

</body>
</html>

