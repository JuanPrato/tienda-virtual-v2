<?php
    include_once 'includes/templates/header.php';
?>

<main class="main_producto contenedor flex_grow">
    
    <?php
        try {
            //conxion a base de datos
            require_once ('includes/funciones/bd_conexion.php');
            $id = $_GET['id'];
            $sql = "SELECT producto_id, producto_nombre, producto_precio, producto_descripcion, producto_img, categoria_nombre";
            $sql .= " FROM productos";
            $sql .= " INNER JOIN categorias";
            $sql .= " ON productos.id_cat_prod = categorias.categoria_id";
            $sql .= " WHERE producto_id =".$id;
            $resultado = $conn->query($sql);

            $producto_datos = $resultado->fetch_assoc();
        } catch (\Exeption $e){
            echo $e->getMessage();
        }

    ?>
    <h1 class="titulo_seccion">Producto: <?php echo $producto_datos['producto_nombre'] ?></h1>
    <div class="producto_especifico">
        <div class="imagen">
            <img src="img/<?php echo $producto_datos['producto_img'] ?>" alt="Imagen producto">
        </div>
        <div class="informacion_contenedor <?php echo $producto_datos['producto_id'] ?>">
            <div class="informacion">
                <div class="descripcion">
                    <h3 class="subtitulo_seccion">Descripcion:</h3>
                    <p><?php echo $producto_datos['producto_descripcion'] ?></p>
                </div>
                <div class="precio">
                    <h3 class="subtitulo_seccion">Precio:</h3>
                    <p>$<?php echo $producto_datos['producto_precio'] ?></p>
                </div>
            </div>
            <form class="formulario">
                <div class="campo">
                    <label for="cantidad" class="label">Cantidad</label>
                    <input type="number" min="1" value="1" id="cantidad">
                </div>
                <input type="submit" value="Agregar al Carro" class="btn btn-secundario agregar-carrito">
            </form>
        </div>
    </div>

</main>

<?php include_once 'includes/templates/footer.php'; ?>