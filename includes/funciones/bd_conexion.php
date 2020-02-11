<?php 
    $conn = new mysqli('us-cdbr-iron-east-04.cleardb.net', 'bad5f07c31eefe', '4a615280', 'proyecto-tienda-v2');

    if($conn->connect_error){
        echo $error -> $conn->connect_error;
    }
?>
