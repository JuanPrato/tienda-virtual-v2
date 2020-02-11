<?php 

$accion = $_POST['accion'];
$password = $_POST['password'];
$usuario = $_POST['usuario'];

if($accion === 'registro') {
    // Código para crear los usuarios
    
    // hashear passwords
    $opciones = array(
        'cost' => 12
    );
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
    // importar la conexion
    include '../funciones/bd_conexion.php';

    try {
        // Realizar la consulta a la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario_nombre, usuario_passw) VALUES (?, ?) ");
        $stmt->bind_param('ss', $usuario , $hash_password);
        $stmt->execute();
        if($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => $accion
            );
        }  else {
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

if($accion === 'login') {

    //login
    include '../funciones/bd_conexion.php';
    
    try {
        //Realizar consulta a la base de datos
        $stmt = $conn->prepare("SELECT usuario_id, usuario_nombre, usuario_passw FROM usuarios WHERE usuario_nombre = ?");
        $stmt->bind_param('s', $usuario );
        $stmt->execute();
        //Loguear
        $stmt->bind_result($usuario_id, $usuario_nombre, $usuario_passw);
        $stmt->fetch();
        if($usuario_nombre){
            //Verifico el password
            if(password_verify($password,$usuario_passw)){

                //Iniciar sesion en una session
                session_start();
                $_SESSION['nombre'] = $usuario;
                $_SESSION['id'] = $usuario_id;
                $_SESSION['login'] = true;

                $respuesta = array(
                    'respuesta' => 'exito',
                    'id' => $usuario_id,
                    'nombre'=> $usuario_nombre,
                    'tipo' => $accion
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    'error' => 'Contraseña Incorrecta',
                    'usuario' => $_POST['usuario'],
                    'password' => $_POST['password'],
                    'tipo' => $accion
                );
            }
        }else{
            $respuesta = array(
                'respuesta' => 'error',
                'error' => 'Usuario no existe',
                'tipo' => $accion
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

