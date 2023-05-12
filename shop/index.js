const listaCategorias   = document.querySelector('#lista-categorias')
const listaProductos    = document.querySelector('#lista-productos')
const totalProductos1   = document.querySelector('#total-productos1')
const totalProductos2   = document.querySelector('#total-productos2')
const carritoCompras    = document.querySelector('#carrito')
const vecearCarrito     = document.querySelector('#vacear-carrito')
const subtotal          = document.querySelector('#sub-total')

let carrito = []

document.addEventListener('DOMContentLoaded', () => {
    if(localStorage.getItem('carrito')){
        carrito = JSON.parse(localStorage.getItem('carrito'))
        cantidadProductos()
        mostrarCarrito()
    }

    listarCategorias()
    listarProductos()
    
})

listaProductos.addEventListener('click', (e) => {

    agregarCarrito(e)

})

carritoCompras.addEventListener('click', (e) => {

    eliminarProducto(e)

    cantidadProductos()
    mostrarCarrito()
})

vecearCarrito.addEventListener('click', (e) => {

    e.preventDefault()

    carrito = []
    localStorage.setItem('carrito', carrito)

    mostrarCarrito()
    cantidadProductos()
    
})

const eliminarProducto = (e) => {
    e.preventDefault()
    if(e.target.classList.contains('eliminar-producto')){
        const producto = e.target.parentElement.dataset.id
        carrito = carrito.filter(productoCarrito => productoCarrito.id !== parseInt(producto))
    }
    localStorage.setItem('carrito', JSON.stringify(carrito))
}

const mostrarCarrito = () => {

    carritoCompras.innerHTML = ''

    carrito.forEach(producto => {
        const div = document.createElement('div')
        div.classList.add('cartmini__widget-item')
        div.innerHTML = `
            <div class="cartmini__thumb">
                <a href="product-details.html">
                    <img src="http://localhost/motors_wheels/admin/productos/imagenes/${producto.img}" alt="">
                </a>
            </div>
            <div class="cartmini__content">
                <h5 class="cartmini__title"><a href="product-details.html">${producto.nombre}</a></h5>
                <div class="cartmini__price-wrapper">
                    <span class="cartmini__price">$${producto.precio}</span>
                    <span class="cartmini__quantity">x${producto.cantidad}</span>
                </div>
            </div>
            <a href="#" class="cartmini__del" data-id="${producto.id}">
                <i class="fa-regular fa-xmark eliminar-producto"></i>
            </a>
        `
        carritoCompras.appendChild(div)
    })

    subTotal()

}

const agregarCarrito = (e) => {
    if(e.target.classList.contains('agregar-carrito')) {

        const producto = e.target.dataset.id

        fetch('http://localhost/motors_wheels/admin/productos/apis/getProductoTienda.php?Id=' + producto)
        .then(res => res.json())
        .then(data => {
            const datosProducto = {
                id: data.ID_PRODUCTO,
                img: data.IMAGEN_PRODUCTO,
                nombre: data.NOMBRE,
                precio: data.PRECIO,
                cantidad: 1
            }
            if(carrito.some(producto => producto.id === datosProducto.id)){
                carrito.forEach(productoCarrito => {
                    if(productoCarrito.id === datosProducto.id){
                        productoCarrito.cantidad++
                    }
                })
            }else{
                carrito = [...carrito, datosProducto]
            }
            localStorage.setItem('carrito', JSON.stringify(carrito))
            cantidadProductos()
            mostrarCarrito()
        })
    }
}

const listarCategorias = () => {

    fetch('http://localhost/motors_wheels/admin/categorias/apis/getCategoriasTienda.php')
    .then(res => res.json())
    .then(data => {
        listaCategorias.innerHTML = ''

        data.forEach(categoria => {
            const div = document.createElement('div')
            div.classList.add('col')
            div.innerHTML = `
                <div class="tp-product-category-item text-center mb-40">
                    <div class="tp-product-category-thumb fix">
                        <a href="#">
                            <img src="http://localhost/motors_wheels/admin/categorias/imagenes/${categoria.IMAGEN}" alt="product-category" width="150px">
                        </a>
                    </div>
                    <div class="tp-product-category-content">
                        <h3 class="tp-product-category-title">
                            <a href="shop-category.html">${categoria.CATEGORIA}</a>
                        </h3>
                        <p>${categoria.TOTAL} Productos</p>
                    </div>
                </div>
            `
            listaCategorias.appendChild(div)
        })
    })
}

const listarProductos = () => {

    fetch('http://localhost/motors_wheels/admin/productos/apis/getProductosTienda.php')
    .then(res => res.json())
    .then(data => {
        listaProductos.innerHTML = ''

        data.forEach(producto => {
            const div = document.createElement('div')
            div.classList.add('col-xl-3', 'col-lg-3', 'col-sm-6')
            div.innerHTML = `
                <div class="tp-product-item p-relative transition-3 mb-25">
                    <div class="tp-product-thumb p-relative fix m-img">
                        <a href="#">
                            <img src="http://localhost/motors_wheels/admin/productos/imagenes/${producto.IMAGEN_PRODUCTO}" alt="${producto.NOMBRE}">
                        </a>

                        <div class="tp-product-badge">
                            <span class="product-hot">Hot</span>
                        </div>

                        <div class="tp-product-action">
                            <div class="tp-product-action-item d-flex flex-column">
                                <button type="button"
                                    class="tp-product-action-btn tp-product-add-cart-btn agregar-carrito" data-id="${producto.ID_PRODUCTO}">
                                    <svg width="20" height="20" viewBox="0 0 20 20" class="agregar-carrito" data-id="${producto.ID_PRODUCTO}"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.93795 5.34749L4.54095 12.5195C4.58495 13.0715 5.03594 13.4855 5.58695 13.4855H5.59095H16.5019H16.5039C17.0249 13.4855 17.4699 13.0975 17.5439 12.5825L18.4939 6.02349C18.5159 5.86749 18.4769 5.71149 18.3819 5.58549C18.2879 5.45849 18.1499 5.37649 17.9939 5.35449C17.7849 5.36249 9.11195 5.35049 3.93795 5.34749ZM5.58495 14.9855C4.26795 14.9855 3.15295 13.9575 3.04595 12.6425L2.12995 1.74849L0.622945 1.48849C0.213945 1.41649 -0.0590549 1.02949 0.0109451 0.620487C0.082945 0.211487 0.477945 -0.054513 0.877945 0.00948704L2.95795 0.369487C3.29295 0.428487 3.54795 0.706487 3.57695 1.04649L3.81194 3.84749C18.0879 3.85349 18.1339 3.86049 18.2029 3.86849C18.7599 3.94949 19.2499 4.24049 19.5839 4.68849C19.9179 5.13549 20.0579 5.68649 19.9779 6.23849L19.0289 12.7965C18.8499 14.0445 17.7659 14.9855 16.5059 14.9855H16.5009H5.59295H5.58495Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.8979 9.04382H12.1259C11.7109 9.04382 11.3759 8.70782 11.3759 8.29382C11.3759 7.87982 11.7109 7.54382 12.1259 7.54382H14.8979C15.3119 7.54382 15.6479 7.87982 15.6479 8.29382C15.6479 8.70782 15.3119 9.04382 14.8979 9.04382Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.15474 17.702C5.45574 17.702 5.69874 17.945 5.69874 18.246C5.69874 18.547 5.45574 18.791 5.15474 18.791C4.85274 18.791 4.60974 18.547 4.60974 18.246C4.60974 17.945 4.85274 17.702 5.15474 17.702Z"
                                            fill="currentColor" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.15374 18.0409C5.04074 18.0409 4.94874 18.1329 4.94874 18.2459C4.94874 18.4729 5.35974 18.4729 5.35974 18.2459C5.35974 18.1329 5.26674 18.0409 5.15374 18.0409ZM5.15374 19.5409C4.43974 19.5409 3.85974 18.9599 3.85974 18.2459C3.85974 17.5319 4.43974 16.9519 5.15374 16.9519C5.86774 16.9519 6.44874 17.5319 6.44874 18.2459C6.44874 18.9599 5.86774 19.5409 5.15374 19.5409Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.435 17.702C16.736 17.702 16.98 17.945 16.98 18.246C16.98 18.547 16.736 18.791 16.435 18.791C16.133 18.791 15.89 18.547 15.89 18.246C15.89 17.945 16.133 17.702 16.435 17.702Z"
                                            fill="currentColor" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.434 18.0409C16.322 18.0409 16.23 18.1329 16.23 18.2459C16.231 18.4749 16.641 18.4729 16.64 18.2459C16.64 18.1329 16.547 18.0409 16.434 18.0409ZM16.434 19.5409C15.72 19.5409 15.14 18.9599 15.14 18.2459C15.14 17.5319 15.72 16.9519 16.434 16.9519C17.149 16.9519 17.73 17.5319 17.73 18.2459C17.73 18.9599 17.149 19.5409 16.434 19.5409Z"
                                            fill="currentColor" />
                                    </svg>

                                    <span class="tp-product-tooltip">Agregar al Carrito</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tp-product-content">
                        <div class="tp-product-category">
                            <a href="#">${producto.CATEGORIA}</a>
                        </div>
                        <h3 class="tp-product-title">
                            <a href="#">
                                ${producto.NOMBRE}
                            </a>
                        </h3>
                        <div class="tp-product-rating d-flex align-items-center">
                            <div class="tp-product-rating-icon">
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star-half-stroke"></i></span>
                            </div>
                        </div>
                        <div class="tp-product-price-wrapper">
                            <span class="tp-product-price new-price">$${producto.PRECIO}</span>
                        </div>
                    </div>
                </div>
            `
            listaProductos.appendChild(div)
        })
    })

}

const cantidadProductos = () => {

    let cantidad = 0

    carrito.forEach(producto => {
        cantidad += producto.cantidad
    })

    totalProductos1.innerHTML = cantidad
    totalProductos2.innerHTML = cantidad

}

const subTotal = () => {

    let subTotal = 0

    carrito.forEach(producto => {
        subTotal += producto.cantidad * producto.precio
    })

    subtotal.innerHTML = `$${subTotal}`
}