<?php
    include '../funciones/sesiones.php';

    $accion = $_POST['accion'];

    (integer)$id[] = $_POST['id'];
    $id_producto = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    if(isset($_SESSION['carrito'][$id_producto]['id']) === false){
        try {
            require_once('../funciones/bd_conexion.php');

            //Realizar consulta a la base de datos
            $stmt = $conn->prepare("SELECT producto_id, producto_nombre, producto_precio FROM productos WHERE producto_id = ?");
            $stmt->bind_param('i', $id_producto);
            $stmt->execute();
            //Guardo resultados
            $stmt->bind_result($id_producto, $nombre, $precio);
            $stmt->fetch();

            $_SESSION['carrito'][$id_producto] = array(
                'id' => $id_producto,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'precio' => $precio
            );
            if(!isset($_SESSION['carrito']['total'])){
                $_SESSION['carrito']['total'] = $precio * $cantidad;
            } else{
                $_SESSION['carrito']['total'] += $precio * $cantidad;
            }

            $_SESSION['carrito'][$id_producto]['ya_esta'] = false;

            $respuesta = array(
                'respuesta' => 'exito',
                'datos' => $_SESSION['carrito'][$id_producto]
            );

            $stmt->close();
            $conn->close();
        } catch(Exception $e) {
            // En caso de un error, tomar la exepcion
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }

    } else {
        $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;

        $_SESSION['carrito']['total'] += $_SESSION['carrito'][$id_producto]['precio'] * $cantidad;
        $_SESSION['carrito'][$id_producto]['ya_esta'] = true;
        $respuesta = array(
            'respuesta' => 'exito',
            'datos' => $_SESSION['carrito'][$id_producto]
        );
    }
    echo json_encode($respuesta);
?>