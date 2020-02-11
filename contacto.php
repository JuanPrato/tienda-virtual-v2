<?php
    include_once 'includes/templates/header.php';
?>

<main class="main_contacto contenedor flex_grow bg_primario">
    <h2 class="titulo_seccion">Contactanos</h2>
    <div class="contacto">
        <form method='POST' action="includes/modelos/enviar-mensaje.php" class="form">
            <fieldset class="fieldset">
                <legend>Tus datos:</legend>
                <div class="campo">
                    <label for="nombre" class="label">Tu nombre:</label>
                    <input type="text" class="input" placeholder="Ingresa tu nombre" id="nombre" name="nombre" autocomplete="off">
                </div>
                <div class="campo">
                    <label for="email" class="label">Tu email:</label>
                    <input type="email" class="input" placeholder="ejemplo@ejemplo.com" id="email" name="email" autocomplete="off">
                </div>
                <div class="campo">
                    <label for="tel" class="label">Algun numero para comunicarnos:</label>
                    <input type="tel" class="input" placeholder="123456789" id="tel" name="tel" autocomplete="off">
                </div>
                <div class="campo">
                    <label for="mensaje" class="label">Ingresa tu mensaje:</label>
                    <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Ingrese aqui su mensaje"></textarea>
                </div>
                <input type="submit" class="btn btn-secundario" id='submit' value='enviar'>
            </fieldset>
        </form>
        <div class="contacto_datos">
            <h3 class="subtitulo_seccion">Tambien nos podes contactar por:</h3>
            <div class="informacion">
                <p><i class="fas fa-envelope"> </i> alguien@correo.com</p>
                <p><i class="fas fa-phone-alt"> </i> (+524) 1234-5678</p>
                <p><i class="fas fa-map-marker-alt"> </i> King Street, Melbourne 5533</p>
            </div>
        </div>
    </div>
</main>

<?php 

    if(isset($_GET['enviado'])){
        echo '<div class="enviado" id="true" style="display: none"></div>';
    } else {
        echo '<div class="enviado" id="false" style="display: none"></div>';
    }

    include_once 'includes/templates/footer.php';
?>