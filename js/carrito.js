$(function(){
    
    const agregarCarrito = $('.agregar-carrito');
    const carrito = $('.carrito');
    let carrito_productos =  $('.productos_carrito');
    carrito_productos.hide();
    carrito_productos.removeClass('hidden');
    const reso = $(window).width() + "px";
    if($(window).width() < 768){
        carrito_productos.css('width',reso);
    }

    agregarCarrito.on('click', agregarAlCarrito);

    carrito.on('click', mostrarCarrito);

});

function agregarAlCarrito(e) {
    e.preventDefault();

    let cantidad = $('#cantidad');
    
    let id = e.target.parentNode.parentNode.classList[1];
    const accion = 'agregar';

    cantidad = cantidad[0].value;

    id = parseInt(id,10);

    $.ajax({
        type:'POST', 
        url: 'includes/modelos/carrito.php',
        datatype:'JSON',
        data: {id:id,cantidad:cantidad,accion:accion},//aqui tus datos
        success:function(data){
            data = JSON.parse(data);

            if( data['respuesta'] === 'exito' ){
                mostrarNotificacion('exito','producto agregado al carrito satisfactoriamente');
                agregarAlCarritoJs(data['datos'], cantidad);
            }
        },
       error:function(data){
        //lo que devuelve si falla tu archivo mifuncion.php
            mostrarNotificacion('error','ocurrio un error al agregar el producto');
        }
    });
}

function mostrarCarrito(e) {
    e.preventDefault();
    let carrito_productos =  $('.productos_carrito');
    carrito_productos.slideToggle('fast');
    // carrito_productos.slideToggle('fast');
}

function agregarAlCarritoJs(datos, cantidadNueva) {

    if(datos['ya_esta']){
        //actualizo cantidad
        let producto = $('.producto_carrito.' + datos['id']);
        let campos = producto[0].children;

        campos[1].textContent = datos['cantidad'];

        let texto = $('.carrito_total');
        let total = texto[0];
        total = total.textContent;
        total = total.replace("TOTAL: $","");
        total = (Number(total)) + (datos['precio'] * cantidadNueva);
        texto[0].textContent = 'TOTAL: $' + total;
    } else {
        //agrego
        const productos_contenedor = $('.productos_contenedor');
        let producto_carrito = document.createElement('div');
        if(productos_contenedor[0].children.length <= 0){
            const texto = $('.carrito_total');
            let total = datos['precio'] * cantidadNueva;
            texto[0].textContent ='TOTAL: $' + total;
        } else {
            let texto = $('.carrito_total');
            let total = texto[0];
            total = total.textContent;
            console.log(total);
            total = total.replace("TOTAL: $","");
            console.log(total);
            total = (Number(total)) + (datos['precio'] * cantidadNueva);
            console.log(total);
            texto[0].textContent ='TOTAL: $' + total;
        }
        producto_carrito.classList.add('producto_carrito',datos['id']);

        producto_carrito.innerHTML = 
        `
        <h4><a class="enlace" href="/proyectosphp/proyecto-tienda-v2/producto.php?id=${datos['id']}">${datos['nombre']}:</a></h4>
        <p class="cantidad_carrito">${datos['cantidad']}</p>
        <p class="precio_carrito">$${datos['precio']}</p>
        `
        productos_contenedor[0].appendChild(producto_carrito);

    }
}