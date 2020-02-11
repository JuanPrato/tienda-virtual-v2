<?php
    include_once 'includes/templates/header.php';
?>

<main class="main_login_registro contenedor">
    <h2 class="titulo_seccion">Inicio de sesion</h2>

    <form action="#" class="formulario">
        <div class="campo">
            <label for="usuario" class="label">Usuario</label>
            <input type="text" class="input" id="usuario" placeholder="PedroSanchez" autocomplete='off'>
        </div>
        <div class="campo">
            <label for="password" class="label">Contraseña</label>
            <input type="password" class="input" id="password" placeholder="Contraseña avanzada" autocomplete='off'>
        </div>
        <input type="hidden" value="login" id="accion">
        <input type="submit" value="Ingresar" class="btn btn-secundario" id="boton">
    </form>

    <a href="/proyectosphp/proyecto-tienda-v2/signin.php">No tienes una cuenta? Registrate</a>

</main>

<?php include_once 'includes/templates/footer.php'; ?>