<?php 
include 'includes/funciones/funciones.php';
include 'includes/funciones/sesiones.php';
if(isset($_GET['cerrar_sesion'])){
  $_SESSION = array();
} 
?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://kit.fontawesome.com/f58252c3ad.js" crossorigin="anonymous"></script>
  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->

  <header class="header contenedor">
    <div class="banner">
    </div>
    <div class="logo"><a href="/proyectosphp/proyecto-tienda-v2/">Cosas <span>Random</span></a></div>
    <div class="nav">
      <div class="icono contenedor">
        <i class="fas fa-bars fa-2x"></i>
        <p class="subtitulo">Menu</p>
      </div>

      <nav class="links">
        <a href="/proyectosphp/proyecto-tienda-v2/">Inicio</a>
        <a href="/proyectosphp/proyecto-tienda-v2/productos.php">Productos</a>
        <a href="#">Nosotros</a>
        <a href="/proyectosphp/proyecto-tienda-v2/contacto.php">Contactanos</a>
      </nav>
      <div class="controles-usuario">
        <!-- Mostrar para Iniciar Sesion o Controles de Usuario -->
        <?php if(isset($_SESSION['nombre'])): ?>
          <div class="carrito_contenedor">
            <a href="#" class="enlace carrito"><i class="fas fa-shopping-cart"></i></a>
            <div class="productos_carrito hidden">
                <?php 
                  if(!isset($_SESSION['carrito'])){
                    //aun no se agregaron productos al carrito
                    ?><p class="carrito_total">Todavia no tenes productos en tu carrito</p>
                    <div class="productos_contenedor">
                    </div> <!-- productos_contenedor --> 
                      <?php
                    } else {
                      $carrito = $_SESSION['carrito'];
                      ?> <p class="carrito_total">TOTAL: $<?php echo $_SESSION['carrito']['total'] ?></p> 
                      <div class="productos_contenedor">
                            <?php
                          foreach ($carrito as $producto) {
                            if($producto['nombre'] != ''):
                            ?>
                            <div class="producto_carrito <?php echo $producto['id']; ?>">
                              <h4><a class="enlace" href="/proyectosphp/proyecto-tienda-v2/producto.php?id=<?php echo $producto['id']; ?>"><?php echo $producto['nombre'] ?>:</a></h4>
                              <p class="cantidad_carrito"><?php echo $producto['cantidad'] ?></p>
                              <p class="precio_carrito">$<?php echo $producto['precio'] ?></p>
                            </div><!-- producto_carrito -->
                            <?php
                            endif;
                          }
                          ?></div> <!-- productos_contenedor --><?php
                        }
                      ?>
                      
                <a href="/proyectosphp/proyecto-tienda-v2/checkout.php" class="enlace enlace_carrito">Ir al resumen</a>
            </div><!-- productos_carrito -->
          </div><!-- carrito_contenedor -->

          <p class="datos-usuario">Usuario: <?php echo $_SESSION['nombre'] ?></p>
          <a href="/proyectosphp/proyecto-tienda-v2/login.php?cerrar_sesion=true" class="enlace" id="cerrar_sesion">Cerrar sesion</a>
        <?php else: ?>
          <a href="/proyectosphp/proyecto-tienda-v2/login.php" class="enlace">Ingresa a tu cuenta</a>
          <a href="/proyectosphp/proyecto-tienda-v2/signin.php" class="enlace">Registrate ahora mismo</a>

        <?php endif ?>

      </div>
    </div>
  </header>

  <div class="flex">