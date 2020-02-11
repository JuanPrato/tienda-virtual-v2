<?php 
    $conn = new mysqli('localhost', 'root', '', 'proyecto-tienda-v2');

    if($conn->connect_error){
        echo $error -> $conn->connect_error;
    }
?>