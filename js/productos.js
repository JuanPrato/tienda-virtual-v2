$(function(){

    const editar = $('.editar');
    const borrar = $('.eliminar');
    const agregar = $('.agregar_producto i');

    editar.on('click', editarCrearProducto);
    borrar.on('click', borrarProducto);
    agregar.on('click', editarCrearProducto);

});

function editarCrearProducto(e){
    e.preventDefault();

    const objetivo = e.currentTarget;
    const accion = objetivo.classList[0];

    //Consigo los valores del producto

    const id = e.currentTarget.parentNode.parentNode ;

    crearFormulario(objetivo, accion);

}

function crearFormulario( objetivo, accion ) {
    let id = 0;
    let nombre = '';
    let precio = '';
    let categoria = '';
    let descripcion = '';
    let imagen = 'default-productos-img.svg';

    if(accion === 'editar'){
        const fila = objetivo.parentNode.parentNode.parentNode;
        id = fila.childNodes[1].textContent;
        id = parseInt(id);
        nombre = fila.childNodes[3].textContent;
        precio = fila.childNodes[5].textContent;
        categoria = fila.childNodes[7].textContent;
        descripcion = fila.childNodes[9].textContent;
        imagen = fila.childNodes[11].textContent;
        precio = precio.replace('$','');
    }

    let modificar_producto = document.createElement('div');
    modificar_producto.classList.add('modificar_producto');

    let contenedor_form = document.createElement('div');
    contenedor_form.classList.add('contenedor_form');

    let form = document.createElement('form');

    //Proximamente: recibir nombres de categorias de la bd para imprimirlos

    form.innerHTML = `
    <fieldset>
        <legend class="subtitulo_seccion">Datos del producto</legend>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id='nombre' placeholder='Nombre del producto' autocomplete="off" value="${nombre}">
        </div>
        <div class="campo">
            <label for="precio">Precio</label>
            <input type="number" step='0.01' id='precio' placeholder='Precio del producto' autocomplete="off" value="${precio}">
        </div>
        <div class="campo">
            <label for="categoria">Categoria</label>
            <select name="categoria" class="categoria" id="categoria">
                <option value="1">frutas</option>
                <option value="2">deportes</option>
                <option value="3">dibujo</option>
            </select>
        </div>
        <div class="campo">
            <label for="descripcion">Descripcion</label>
            <textarea class="textarea_producto" name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripcion del producto" autocomplete="off">${descripcion}</textarea>
        </div>
        <div class="campo">
            <label for="imagen">Imagen</label>
            <input type="text" id="imagen" name='imagen' placeholder='Nombre de la imagen' autocomplete="off" value="${imagen}">
        </div>
    </fieldset>
    <div class="botones">
        <input type="hidden" id="id_accion" value="${id},${accion}">
        <input type="submit" value="${ accion }" class="btn btn-secundario" id="submit">
        <button value="cancelar" class="btn btn-danger boton_cancelar">cancelar</button>
    </div>
    `;

    contenedor_form.appendChild(form);

    modificar_producto.appendChild(contenedor_form);

    const main_productos = $('.main_productos_log_in');

    main_productos[0].appendChild(modificar_producto);

    const modificar = $('.modificar_producto');
    const cancelar = $('.boton_cancelar');

    modificar.css("height", $(window).height());
    modificar.css("width", $(window).width());

    modificar.on('click', cerrarEditor);

    cancelar.on('click', cerrarEditor);
    
    if(accion == 'editar'){
        const select = $('.categoria');
        opciones = select.children();
        
        let i = 0;
        while((opciones[i].innerHTML != categoria) && (i < opciones.length)){
            i++;
        }
        opciones[i].setAttribute('selected','selected');
    }

    const submit = $('#submit');

    submit.on('click', subirDatos);

}

function borrarProducto(e){
    e.preventDefault();

    if(confirm('Seguro que desea eliminar?')){
        const objetivo = e.currentTarget;
        const fila_objetivo = objetivo.parentNode.parentNode.parentNode;
        const id = parseInt(objetivo.parentNode.id);
        const accion = objetivo.classList[0];

        let datos = new FormData();
        datos.append('id', id);
        datos.append('accion', accion);

        const xhr = new XMLHttpRequest();

        xhr.open('POST','includes/modelos/actualizar-productos.php', true);

        xhr.onload = function(){
            if(this.status === 200){
                const respuesta = JSON.parse(xhr.responseText);

                if(respuesta['respuesta'] === 'correcto'){
                    fila_objetivo.remove();
                    mostrarNotificacion('exito', 'Producto borrado exitosamente');
                } else {
                    mostrarNotificacion('error', 'ocurrio un error al borrar');
                }
            } else {
                mostrarNotificacion('error', 'ocurrio un error al borrar');
            }
        }
        xhr.send(datos);
    }
}

function cerrarEditor(e) {
    e.preventDefault();

    const modificar = $('.modificar_producto');

    if(e.target === modificar[0] || e.currentTarget.value === 'cancelar'){
        modificar.remove();
    }
}

function subirDatos() {

    const formulario = document.querySelector('.modificar_producto');

    let nombre = document.querySelector('#nombre').value;
    let precio = document.querySelector('#precio').value;
    let categoria = document.querySelector('#categoria').value;
    let descripcion = document.querySelector('#descripcion').value;
    let imagen = document.querySelector('#imagen').value;
    let accion_id = document.querySelector('#id_accion').value;
    accion_id = accion_id.split(',');
    let accion = accion_id[1];
    let id = accion_id[0];

    nombre = nombre.replace('<','');
    nombre = nombre.replace('>','');
    console.log(nombre);
    
    let datos = new FormData();
    if(accion === 'editar'){
        datos.append('id', id);
    }
    datos.append('nombre',nombre);
    datos.append('precio',precio);
    datos.append('categoria', categoria);
    datos.append('descripcion',descripcion);
    datos.append('imagen',imagen);
    datos.append('accion', accion);
    
    const xhr = new XMLHttpRequest();

        xhr.open('POST','includes/modelos/actualizar-productos.php', true);

        xhr.onload = function(){
            if(this.status === 200){
                const respuesta = JSON.parse(xhr.responseText);

                if(respuesta['respuesta'] === 'correcto'){
                    formulario.remove();
                    if(respuesta['accion'] === 'agregar'){
                        mostrarNotificacion('exito', 'Producto agregado exitosamente');
                        agregarFila(respuesta);
                    } else {
                        mostrarNotificacion('exito', 'producto actualizado exitosamente');
                        updateFila(respuesta);
                    }
                    } else {
                        mostrarNotificacion('error', 'ocurrio un error al agregar');
                    }
                }
        }
        xhr.send(datos);
}

function agregarFila(respuesta) {


    const tabla = $('.tbody');
    let fila = document.createElement('tr');
    fila.classList.add('fila');
    fila.classList.add(respuesta['id']);

    fila.innerHTML = `
        <td class="celda">${respuesta['id_insertado']}</td>
        <td class="celda">${respuesta['nombre']}</td>
        <td class="celda">$${respuesta['precio']}</td>
        <td class="celda">${respuesta['categoria']}</td>
        <td class="celda">${respuesta['descripcion']}</td>
        <td class="celda">${respuesta['imagen']}</td>
        <td class="celda">
            <div class="celda_acciones" id="${respuesta['id_insertado']}">
                <a href="#" class="editar"><i class="fas fa-pen btn_editar"></i></a>
                <a href="#" class="eliminar"><i class="far fa-trash-alt btn_eliminar"></i></a>
            </div>
        </td>
    `;

    tabla[0].appendChild(fila);

    const editar = $('.editar:last');
    const borrar = $('.eliminar:last');
    
    editar.on('click',editarCrearProducto);
    borrar.on('click',borrarProducto);
}

function updateFila(respuesta) {
    //Se colocan los nuevos valores en las celdas
    id = respuesta['id_actualizado'];
    fila = $('.fila.' + id);
    celdas = fila.children();

    celdas[1].innerHTML = respuesta['nombre'];
    celdas[2].innerHTML = '$' + respuesta['precio'];
    celdas[3].innerHTML = respuesta['categoria'];
    celdas[4].innerHTML = respuesta['descripcion'];
    celdas[5].innerHTML = respuesta['imagen'];
}