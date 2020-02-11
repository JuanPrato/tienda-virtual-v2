<?php 
    include_once 'includes/templates/header.php';

    if(!isset($_SESSION['login'])):

?>
        <main class="main_productos_log_out contenedor bg_primario flex_grow">
            <h2 class="titulo_seccion anuncio_log_out">No tienes permisos para acceder a esta seccion</h2>
        </main>
    <?php else: ?>

        <main class="main_productos_log_in contenedor bg_primario">
            <h2 class="titulo_seccion">Productos</h2>

            <table>
                <thead>
                    <tr class="fila">
                        <th class="titulo_columna columna_id">id</th>
                        <th class="titulo_columna columna_nombre">nombre</th>
                        <th class="titulo_columna columna_precio">precio</th>
                        <th class="titulo_columna columna_categoria">categoria</th>
                        <th class="titulo_columna columna_descripcion">descripcion</th>
                        <th class="titulo_columna columna_imagen">imagen</th>
                        <th class="titulo_columna columna_acciones">acciones</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                        //Conexion a la base de datos
                        try {
                            require_once('includes/funciones/bd_conexion.php');
                            $sql = "SELECT producto_id, producto_nombre, producto_precio, producto_descripcion, producto_img, categoria_nombre";
                            $sql .= " FROM productos";
                            $sql .= " INNER JOIN categorias";
                            $sql .= " ON productos.id_cat_prod = categorias.categoria_id";
                            $sql .= " ORDER BY producto_id";
                            $resultado = $conn->query($sql);
                        } catch (\Exeption $e){
                            echo $e->getMessage();
                        }

                        $productos = array();
                        while ( $producto_datos = $resultado->fetch_assoc() ) {
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

                        foreach($productos as $producto): ?>
                        <tr class="fila <?php echo $producto['id']; ?>">
                            <td class="celda"><?php echo $producto['id']; ?></td>
                            <td class="celda"><?php echo $producto['nombre']; ?></td>
                            <td class="celda"><?php echo '$' . $producto['precio']; ?></td>
                            <td class="celda"><?php echo $producto['categoria']; ?></td>
                            <td class="celda"><?php echo $producto['descripcion']; ?></td>
                            <td class="celda"><?php echo $producto['imagen']; ?></td>
                            <td class="celda">
                                <div class="celda_acciones" id="<?php echo $producto['id'] ?>">
                                    <a href="#" class="editar"><i class="fas fa-pen btn_editar"></i></a>
                                    <a href="#" class="eliminar"><i class="far fa-trash-alt btn_eliminar"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <div class="agregar_producto">
                <i class="agregar fas fa-plus-circle"></i>
            </div> <!-- fin Agregar_producto -->

        </main>

    <?php
    endif;

    include_once 'includes/templates/footer.php';
    ?>