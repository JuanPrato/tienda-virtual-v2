<?php
    include_once 'includes/templates/header.php';
?>

<main class="main_login_registro contenedor">
    <h2 class="titulo_seccion">Registrate</h2>

    <form action="#" class="formulario">
        <div class="campo">
            <label for="usuario" class="label">Usuario</label>
            <input type="text" class="input" id="usuario" placeholder="PedroSanchez" autocomplete='off'>
        </div>
        <div class="campo">
            <label for="password" class="label">Contraseña</label>
            <input type="password" class="input" id="password" placeholder="Contraseña avanzada" autocomplete='off'>
        </div>
        <input type="hidden" value="registro" id="accion">
        <input type="submit" value="Registrarse" class="btn btn-secundario" id="boton">
    </form>

    <a href="/proyectosphp/proyecto-tienda-v2/login.php">Ya tienes cuenta? Inicia sesion</a>
    
</main>

<?php include_once 'includes/templates/footer.php'; ?>