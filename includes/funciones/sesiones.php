<?php

function revisar_usuario(){
    return isset($_SESSION['nombre']);
}

session_start();
