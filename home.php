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

            <a class="btnhead" href="WebFlow/index.php"><h2 class="fix"></h2></a>

        </nav>

    </section>

    <section class="body">

        <div class="title">

            <h2>Categorias</h2>

            <a class="crear" href="#postc">Crear</a>

        </div>

        <!-- CATEGORIAS -->

        <script>
    window.onload = function() {
        detectarDivsc();
        detectarDivsp();
    }

    function detectarDivsc() {
        const categoriasBox = document.getElementById('categoriasbox');
        if (categoriasBox) {
            const divs = categoriasBox.getElementsByTagName('div');
            if (divs.length === 0) {
                const h3 = document.createElement('h3');
                const textoH3 = document.createTextNode('No hay categorías');
                h3.appendChild(textoH3);

                const h4 = document.createElement('h4');
                const textoH4 = document.createTextNode('Pulse en el botón crear para agregar una categoría');
                h4.appendChild(textoH4);

                categoriasBox.appendChild(h3);
                categoriasBox.appendChild(h4);
            }
        }
    }

    function detectarDivsp() {
        const productosBox = document.getElementById('productos');
        if (productosBox) {
            const divs = productosBox.getElementsByTagName('div');
            if (divs.length === 0) {
                const h3 = document.createElement('h3');
                const textoH3 = document.createTextNode('No hay productos');
                h3.appendChild(textoH3);

                const h4 = document.createElement('h4');
                const textoH4 = document.createTextNode('Pulse en el botón crear para agregar un producto a su correspondiente categoría');
                h4.appendChild(textoH4);

                productosBox.appendChild(h3);
                productosBox.appendChild(h4);
            }
        }
    }
</script>

        
        <div class="categorias" id="categoriasbox">

            <?php 
                $items = mysqli_query($conn, $categorias);
                while ($row = mysqli_fetch_assoc ($items)) {
            ?>



                    <div class="menu-item" style="background-image:url(backend/php/img_comprimida/categorias/<?php echo $row ["id"]; ?>bg.jpg);">

                        <a class="delete animate" href="#delete-<?php echo $row ["id"]; ?>">🗑️</a>

                        <div class="blur"><?php echo $row ["nombre"]; ?></div>

                        <a  class="put animate" href="#put-<?php echo $row ["id"]; ?>">📝</a>

                    </div>

                    <div class="popup-container" id="delete-<?php echo $row ["id"]; ?>">
            
                        <div class="popup">

                            <h4 class="">¿Desea eliminar la categoria <?php echo $row ["nombre"]; ?>? (Recuerde que se eliminaran todos los productos relacionados)</h4>

                            <div class="links">

                             <a class="a confirm" href="backend/php/backend.php?type=categorias&id=<?php echo $row["id"]; ?>&task=delete">SI</a>
                             <a  class="a deny" href="#">NO</a>

                            </div>

                        </div>

                    </div>

                    <div class="popup-container" id="put-<?php echo $row ["id"]; ?>">
            
                        <div class="popup">

                            <a href="#" class="cerrar">X</a>

                            <form action="backend/php/backend.php?type=categorias&id=<?php echo $row["id"]; ?>&task=put" method="post" enctype="multipart/form-data" id="form_categoria_put">

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
                    <input type="file" name="img" id="file_categorias_post" required>

                    <button class="btnsubmit" type="submit">Cargar</button>

                </form>

            </div>

		</div>

        <!-- PRODUCTOS -->

        <div class="title">

         <h2 id="products">Productos</h2>

         <a class="crear" href="#postp">Crear</a>

        </div>

       <div class="containerp">

       <div id="productos">

        <?php 
        $items = mysqli_query($conn, $categorias);
        while ($row = mysqli_fetch_assoc ($items)) {
        ?>

    <div class="cate_min" style=""><a href="#cate-<?php echo $row ["id"]; ?>" id="afull"><?php echo $row ["nombre"]; ?></a></div>

    <div class='popup-container' id="cate-<?php echo $row ["id"]; ?>">
        <div class='popup'>
            <a href='#' class='cerrar'>X</a>

            <div class="productos">

                <?php
                    $productos = "SELECT * FROM productos WHERE id_categoria = {$row['id']}";
                    $productos_items = mysqli_query($conn, $productos);
                    while ($rowp = mysqli_fetch_assoc($productos_items)) {
                ?>

                <div class="item-producto">

                    <form action="backend/php/backend.php?type=productos&id=<?php echo $row["id"]; ?>&task=put" method="post" enctype="multipart/form-data" id="form_productos_put">

                        <div class="img-producto" style="background-image:url(backend/php/img_comprimida/productos/<?php echo $rowp ["id"]; ?>bg.jpg);">
                        
                            <label for="file_productos_<?php echo $row["id"]; ?>_put" class="emoji-upload"></label>
                            <input type="file" name="img" id="file_productos_<?php echo $row["id"]; ?>_put">

                        </div>

                        <input type="text" name="namep" value="<?php echo $rowp ["nombre"]; ?>" id="namep_put">

                        <textarea name="descp"  cols="" rows=""><?php echo $rowp ["descripcion"]; ?></textarea>

                        <input type="number" name="pricep" class="price" value="<?php echo $rowp ["precio"]; ?>" id="">

                        <div class="links">

                         <a class="button borrar" href="backend/php/backend.php?type=productos&id=<?php echo $row["id"]; ?>&task=delete">Borrar</a>

                         <button type="submit" class="button">Actualizar</button>

                        </div>

                    </form>

                </div>

                <?php } ?>

            </div>
            
        </div>
        
    </div>

<?php } ?>

</div>

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
                        $items = mysqli_query($conn, $categorias);
                        while ($row = mysqli_fetch_assoc ($items)) {
                    ?>

                    <option value="<?php echo $row ["id"]; ?>"><?php echo $row ["nombre"]; ?></option>

                    <?php } ?>

                    </select>

                    <h6>Nombre del Producto</h6>

                    <input type="text" name="namep" id="" placeholder="Nombre" required>

                    <h6>Añadir una Descripción</h6>

                    <input type="text" name="descp" id="" placeholder="Descripción" required>

                    <h6>Añadir un Precio</h6>

                    <input type="number" name="pricep" id="" placeholder="Precio" required>

                    <h6>Añadir imagen</h6>

                    <label for="file_productos_post" class="emoji-upload"></label>
                    <input type="file" name="img" id="file_productos_post" required>

                    <button class="btnsubmit" type="submit">Cargar</button>

                </form>

            </div>

		</div>

    <!-- PERSONAL -->

        <div class="title">

            <h2 id="products">Personal</h2>

            <a class="crear" href="#postpr">Crear</a>

        </div>

        <div class="categorias fix2">

            <?php 
            $personal = "SELECT * FROM personal";
            $items = mysqli_query($conn, $personal);
            while ($rowpr = mysqli_fetch_assoc ($items)) {
            ?>

            <div class="slide">

                <div class="boxpr"><a href="backend/php/backend.php?type=personal&id=<?php echo $rowpr["id"]; ?>&task=delete" class="deletepr">🗑️</a></div>

                <div class="target">
                <div class="staff-data img-staff" style="background-image:url(backend/php/img_comprimida/personal/<?php echo $rowpr ["id"]; ?>bg.jpg);"></div>
                <div class="staff-data">
                    <h3 class="staff-name"><?php echo $rowpr ["nombre"]; ?></h3>
                    <h5 class="staff-nickname"><?php echo $rowpr ["apodo"]; ?></h5>
                    <p class="staff-description"><?php echo $rowpr ["descripcion"]; ?></p>
                </div>
                </div>

                <div class="boxpr"><a href="#put_personal_<?php echo $rowpr ["id"]; ?>" class="putpr">📝</a></div>

            </div>  
            
            <div class='popup-container' id='put_personal_<?php echo $rowpr ["id"]; ?>'>
                <div class='popup'>
                    <a href='#' class='cerrar'>X</a>
                    <form action="backend/php/backend.php?type=personal&id=<?php echo $rowpr["id"]; ?>&task=put" method="post" enctype="multipart/form-data" id="personal_put_<?php echo $rowpr ["id"]; ?>">
                        <h4>Actualizar una tarjeta de personal</h4>
                        <h6>Nombre del trabajador</h6>
                        <input type="text" name="namepr" value="<?php echo $rowpr ["nombre"]; ?>" id="" placeholder="Nombre">
                        <h6>Apodo del trabajador</h6>
                        <input type="text" name="apodo" id="" value="<?php echo $rowpr ["apodo"]; ?>" placeholder="Apodo">
                        <h6>Descripción de su trabajo</h6>
                        <input type="text" name="descpr" id="" value="<?php echo $rowpr ["descripcion"]; ?>" placeholder="Descripción">
                        <h6>Añadir imagen</h6>
                        <label for="file_personal_put" class="emoji-upload"></label>
                        <input type="file" name="img" id="file_personal_put">
                        <button class="btnsubmit" type="submit">Actualizar</button>
                    </form>
                </div>
            </div>

            <?php } ?>

        </div>

    <!-- POST-PERSONAL --> 

        <div class='popup-container' id='postpr'>
            <div class='popup'>
                <a href='#' class='cerrar'>X</a>
                <form action="backend/php/backend.php?type=personal&task=post" method="post" enctype="multipart/form-data" id="personal_post">
                    <h4>Crear una tarjeta de personal</h4>
                    <h6>Nombre del trabajador</h6>
                    <input type="text" name="namepr" id="" placeholder="Nombre">
                    <h6>Apodo del trabajador</h6>
                    <input type="text" name="apodo" id="" placeholder="Apodo">
                    <h6>Descripción de su trabajo</h6>
                    <input type="text" name="descpr" id="" placeholder="Descripción">
                    <h6>Añadir imagen</h6>
                    <label for="file_personal_post" class="emoji-upload"></label>
                    <input type="file" name="img" id="file_personal_post" required>
                    <button class="btnsubmit" type="submit">Cargar</button>
                </form>
            </div>
        </div>

        <!-- RESPUESTAS -->

        <div class='popup-container' id='200'>
            <div class='popup'>
                <a href='#' class='cerrar'>X</a>
                <h4>¡Consulta exitosa!</h4>
            </div>
        </div>

    </section>

    <section class="foot"><h6>© 2023 Coffee Break</h6></section>

</body>
</html>

