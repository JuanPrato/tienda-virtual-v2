  </div>
    
    <footer class="footer">
      <div class="contenedor">
        <div class="datos">
          <p><i class="fas fa-phone-alt"></i> <span>comunicate</span> al 1234-5678</p>
          <p><i class="fas fa-envelope"></i> <span>email</span> : alguien@correo.com</p> 
          <p><i class="fas fa-map-marker-alt"></i> <span>Direccion</span> : King Street, Melbourne 5533</p>
        </div>
        <nav class="links">
          <a href="/">Inicio</a>
          <a href="/productos.php">Productos</a>
          <a href="#">Nosotros</a>
          <a href="/contacto.php">Contactanos</a>
        </nav>
      </div>
    </footer>


<script src="js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/carrito.js"></script>
  <?php 
  if(obtenerPaginaActual() === 'login' || obtenerPaginaActual() === 'signin'){
    echo ' <script src="js/formularios.js"></script>';
  }
  if(obtenerPaginaActual() === 'index'){
    echo ' <script src="js/filtros.js"></script>';
  }
  if(obtenerPaginaActual() === 'contacto'){
    echo '<script src="js/contacto.js"></script>';
  }
  if(obtenerPaginaActual() === 'productos' && isset($_SESSION['login'])){
    echo '<script src="js/productos.js"></script>';
  }
  ?>
  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set','transport','beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>
