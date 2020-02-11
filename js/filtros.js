document.addEventListener("DOMContentLoaded",function(event){
    const filtros = document.querySelectorAll('.filtro .filtro-check');
    const productos = document.querySelectorAll('.productos .producto');
    
    // filtros.addEventListener('check', filtrarProductos);
    
});

function filtrarProductos(){
    productos.forEach(producto => {
        producto.style.display = 'none';
    })
}