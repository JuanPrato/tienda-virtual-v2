<?php
    include_once 'includes/templates/header.php';
?>


    <main class="main_index contenedor flex_grow">
        <div class="contenedor-filtros">
            <div class="menu-filtros">
                <h3>filtros</h3>
                <i class="fas fa-filter"></i>
            </div>
            <div class="filtros">
                <div class="filtro">
                    <input type="checkbox" class="filtro-check" id="<40" value="<40">   
                    <label for="<40">Menor que 40</label>
                </div>
                <div class="filtro">
                    <input type="checkbox" class="filtro-check" id=">40" value=">40">
                    <label for=">40">Mayor que 40</label>
                </div>
            </div>

        </div><!-- fin filtro -->
        <div class="productos">        
            <?php 
                try {
                    require_once('includes/funciones/bd_conexion.php');
                    $sql = "SELECT producto_id, producto_nombre, producto_precio, producto_descripcion, producto_img, categoria_nombre";
                    $sql .= " FROM productos";
                    $sql .= " INNER JOIN categorias";
                    $sql .= " ON productos.id_cat_prod = categorias.categoria_id";
                    $resultado = $conn->query($sql);
                } catch (\Exeption $e){
                    echo $e->getMessage();
                }
            
                $productos = array();
                while( $producto_datos = $resultado->fetch_assoc() ) {
                    $producto = array(
                        'id' => $producto_datos['producto_id'],
                        'nombre' => $producto_datos['producto_nombre'],
                        'precio' => $producto_datos['producto_precio'],
                        'categoria' => $producto_datos['categoria_nombre'],
                        'descripcion' => $producto_datos['producto_descripcion'],
                        'imagen' => $producto_datos['producto_img']
                    );

                    $productos[] = $producto;
                } 
            ?>
            <?php foreach($productos as $llave => $producto): ?>

                <div class="producto <?php echo $producto['id'] ?>">
                    <a href="/producto.php?id=<?php echo $producto['id']; ?>" class="link">
                        <div class="imagen">
                            <img src="img/<?php echo $producto['imagen'] ?>" alt="Imagen producto">
                        </div>
                    </a>
                    <div class="informacion_producto">
                        <a href="/producto.php?id=<?php echo $producto['id']; ?>" class="link">
                            <h3><?php echo $producto['nombre'] ?></h3>
                        </a>
                        <div class="precio_categoria">
                            <p><span class='subtitulo'>Precio:</span> <span class='info_especial'>$<?php echo $producto['precio'] ?></span></p>
                            <p><span class='subtitulo'>Categoria:</span> <span class='info_especial'><?php echo $producto['categoria'] ?></span></p>
                        </div>
                        <input type="hidden" value="1" id="cantidad">
                        <a class="btn btn-secundario agregar-carrito">Agregar al carrito</a>
                    </div>
                </div>
            <?php endforeach ?>

        </div><!-- fin productos -->
        <?php
            $conn->close();
        ?>
    </main>


<?php include_once 'includes/templates/footer.php'; ?>
