<?php 
include 'includes/templates/header.php';
include 'includes/funciones/config.php';
$total = $_SESSION['carrito']['total'];
?>

<main class="main_checkout contenedor bg_primario flex_grow">
    <section class="section_checkout center_text">
        <h2 class="titulo_seccion">Resumen</h2>
        <?php if(!isset($_SESSION['carrito'])):  ?><!--Caso de entrar a la pagina sin tener items en el carrito -->
                <h3 class="subtitulo_seccion center_text">No tenes items en tu carrito</h3>
                <p>Agregar productos haciendo click en "agregar al carrito"</p>
                <a href="/proyectosphp/proyecto-tienda-v2/" class="btn btn-secundario center_text btn_checkout">volver al inicio</a>
        <!-- Termina parte si no tenes items -->
        <?php else: ?><!--  en caso de tener items en el carrito  -->
            <?php 
                $carrito = $_SESSION['carrito'];
                foreach ($carrito as $producto){ ?> 
                    <?php if($producto['nombre'] != ''): ?>
                            <div class="producto_checkout <?php echo $producto['id'] ?>">
                                <h4><a class="enlace" href="/producto.php?id=<?php echo $producto['id'] ?>"><?php echo $producto['nombre'] ?>:</a></h4>
                                <p class="cantidad_checkout"><?php echo $producto['cantidad'] ?></p>
                                <p class="precio_checkout">$<?php echo $producto['precio'] ?></p>
                            </div><!-- producto_carrito -->
                    <?php endif ?>
                    <?php } ?>
        <!-- Termina parte si tenes items -->
        <p class="checkout_total">TOTAL: $<?php echo $total ?></p>

        <?php include 'includes/funciones/paypalCheckout.php'; ?>
        <?php endif ?>
    </section>
</main>

<?php
include 'includes/templates/footer.php';
?>