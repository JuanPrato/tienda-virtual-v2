$(function(){

    const submit = $('#submit');
    const nombre = $('#nombre');
    const email = $('#email');
    const tel = $('#tel');
    const mensaje = $('#mensaje');

    submit.on('click', validarContacto );

    const enviado = $('.enviado');

    if(enviado[0].id === 'true'){
        mostrarNotificacion('exito','mensaje enviado con exito');
    }

    nombre.on('focus', cambiarColor);
    email.on('focus', cambiarColor);
    tel.on('focus', cambiarColor);
    mensaje.on('focus', cambiarColor);

    nombre.on('blur', cambiarColor);
    email.on('blur', cambiarColor);
    tel.on('blur', cambiarColor);
    mensaje.on('blur', cambiarColor);

});

function validarContacto(e){

    if(nombre.value === '' || email.value === '' || tel.value === '' || mensaje.value === ''){
        e.preventDefault();
        mostrarNotificacion('error', 'todos los campos son obligatorios');
    } else if( parseInt(tel.value) < 100000000 || parseInt(tel.value) > 999999999 ){
        e.preventDefault();
        mostrarNotificacion('error', 'Ingresar un celular valido');
        tel.focus();
    } else if(mensaje.value.length < 10 ){
        e.preventDefault();
        mostrarNotificacion('error', 'El mensaje debe contener al menos 10 carateres');
        mensaje.focus();
    }
}

function cambiarColor(e){
    // console.log(e.currentTarget);
    e.currentTarget.classList.toggle('input_selected');
}