$(function(){
    'use strict';
    let header = $('.header');
    let nav = $('.links').first();
    let activador = $('.icono ');
    const icono = $('.icono i.fa-bars');
    icono.on('click', desplegar);

    let reso = screen.width;
    if(reso < 768){
        nav.hide();
    } else {
        nav.show();
        activador.hide();
    }

    $(window).resize(function(){
        let reso = screen.width;
        if(reso < 768){
            nav.hide();
            activador.show();
        } else {
            nav.show();
            activador.hide();
        }
    })
    function desplegar(){
        nav.removeClass('hidden');
        nav.slideToggle('fast');
        icono.toggleClass('rotado');
    }

});

function mostrarNotificacion( tipo, texto){
    const notificacion = document.createElement('div');
    notificacion.innerText = texto ;
    notificacion.classList.add('notificacion');
    notificacion.classList.add('desvanecer');
    if(tipo === 'exito'){
        notificacion.classList.add('notificacion_exito');
    } else if(tipo === 'error') {
        notificacion.classList.add('notificacion_error');
    }
    document.querySelector('.header').appendChild(notificacion);
    setTimeout(() => {
        document.querySelector('.notificacion').classList.remove('desvanecer');
    }, 50);
    
    
    setTimeout(() => {
        document.querySelector('.notificacion').classList.add('desvanecer');
        setTimeout(() => {
            document.querySelector('.notificacion').remove();
        }, 500);
    }, 2000);
}