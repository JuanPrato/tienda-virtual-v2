$(function(){
    const boton = $('#boton');

    boton.on('click', validarFormulario);

});

function validarFormulario(e){
    e.preventDefault();
    
    if(usuario.value === "" || password.value === ""){
        mostrarNotificacion('error','Todos los campos deben llenarse');
    } else {
        let datos = new FormData();
        datos.append('usuario',usuario.value);
        datos.append('password',password.value);
        datos.append('accion', accion.value);

        const xhr = new XMLHttpRequest();

        xhr.open('POST', 'includes/modelos/modelo-usuario.php', true);
        
        xhr.onload = function(){
            if(this.status === 200){
                const respuesta = JSON.parse(xhr.responseText);

                if(respuesta.tipo === 'registro'){
                    mostrarNotificacion('exito', 'Usuario registrado correctamente');
                    setTimeout(() => {
                        window.location.href = '/login.php';
                    }, 5000);

                } else if(respuesta.tipo === 'login'){
                    if(respuesta.respuesta === 'exito'){
                        mostrarNotificacion('exito', 'Logeado exitosamente');
                        setTimeout(() => {
                           window.location.href = '/';
                        }, 4000);
                    } else {
                        mostrarNotificacion(respuesta.respuesta,respuesta.error);
                    }
                }
            } else {
                mostrarNotificacion('error', 'Hubo un error en el registro');
            }
        }

        xhr.send(datos);
    }
}
