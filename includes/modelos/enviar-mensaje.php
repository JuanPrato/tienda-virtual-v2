<?php
$nombre = $_POST['nombre'];
$mail = $_POST['email'];
$contenido = $_POST['mensaje'];
$telefono = $_POST['telefono'];

$header = 'From: ' . $mail . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . ",\r\n";
$mensaje .= "Su e-mail es: " . $mail . " \r\n";
$mensaje .= "Mensaje: " . $_POST['mensaje'] . " \r\n";
$mensaje .= "Mi telefono/celular: " . $telefono . "\r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = 'pratojuanmanuel2@gmail.com';
$asunto = 'Mensaje de mi sitio web';

mail($para, $asunto, utf8_decode($mensaje), $header);

header("Location:../../contacto.php?enviado=true");
?>