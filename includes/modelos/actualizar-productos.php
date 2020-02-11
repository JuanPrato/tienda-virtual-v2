<?php 

$accion = $_POST['accion'];

if( $accion === 'eliminar'){

    $id = $_POST['id'];

    try {
        require_once('../funciones/bd_conexion.php');
        //Realizar la consulta a la base de datos para eliminar
        $stmt = $conn->prepare("DELETE FROM productos WHERE producto_id =(?)");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_borrado' => $id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch(Exception $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);  
}

if( $accion === 'agregar'){

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $precio = (string)$precio;
    $categoria = (string)$categoria;

    include '../funciones/bd_conexion.php';
    
    try {
        
        //Realizar la consulta a la base de datos para agregar
        $stmt = $conn->prepare("INSERT INTO productos (producto_nombre,producto_precio,producto_descripcion,id_cat_prod,producto_img) VALUES (?,?,?,?,?) ");
        $stmt->bind_param('sdsis', $nombre, $precio, $descripcion, $categoria, $imagen);
        $stmt->execute();
        if($stmt->affected_rows > 0) {
            $stmt2 = $conn->prepare("SELECT categoria_nombre FROM categorias WHERE categoria_id =(?)");
            $stmt2->bind_param('s', $categoria);
            $stmt2->execute();
            //Guardo resultado
            $stmt2->bind_result($categoria_nombre);
            $stmt2->fetch();
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'nombre' => $nombre,
                'precio' => $precio,
                'categoria' => $categoria_nombre,
                'descripcion' => $descripcion,
                'imagen' => $imagen,
                'accion' => $accion
            );
            $stmt2->close();
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch(Exception $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);  
}

if( $accion === 'editar'){

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];

    $precio = (string)$precio;
    $categoria = (string)$categoria;

    include '../funciones/bd_conexion.php';
    
    try {
        
        //Realizar la consulta a la base de datos para agregar
        $stmt = $conn->prepare("UPDATE productos SET producto_nombre= ?, producto_precio=?, producto_descripcion=?, id_cat_prod= ?,producto_img=? WHERE producto_id = (?)");
        $stmt->bind_param('sdsisi', $nombre, $precio, $descripcion, $categoria, $imagen, $id);
        $stmt->execute();
        if($stmt->affected_rows > 0) {
            $stmt2 = $conn->prepare("SELECT categoria_nombre FROM categorias WHERE categoria_id =(?)");
            $stmt2->bind_param('s', $categoria);
            $stmt2->execute();
            //Guardo resultado
            $stmt2->bind_result($categoria_nombre);
            $stmt2->fetch();
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $id,
                'nombre' => $nombre,
                'precio' => $precio,
                'categoria' => $categoria_nombre,
                'descripcion' => $descripcion,
                'imagen' => $imagen,
                'accion' => $accion
            );
            $stmt2->close();
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch(Exception $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);  
}
?>