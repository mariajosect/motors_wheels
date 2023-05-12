const listaProductos = document.querySelector('#lista-productos')
const total = document.querySelector('#total')
const boton = document.querySelector('#boton-registrar')
const formulario = document.querySelector('#formulario-orden')

document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('carrito')) {
        carrito = JSON.parse(localStorage.getItem('carrito'))
        listarProductosCarrito()
    }
})

boton.addEventListener('click', (e) => {

    e.preventDefault()

    const datos = new FormData(formulario)

    const datosCliente  = {
        nombres: datos.get('nombres'),
        apellidos: datos.get('apellidos'),
        email: datos.get('email'),
        celular: datos.get('celular'),
        direccion: datos.get('direccion'),
        pais: datos.get('pais')
    }

    const productosCarrito = {
        productos: carrito
    }

    const datosOrden = new FormData()

    datosOrden.append('datosCliente', JSON.stringify(datosCliente))
    datosOrden.append('productosCarrito', JSON.stringify(productosCarrito))

    fetch(`http://localhost/motors_wheels/admin/ordenes/controladores/registrarOrden.php`, {
        method: 'POST',
        body: datosOrden
    })
    .then(res => res.json())
    .then(data => {
        console.log(data)
    })
})

const listarProductosCarrito = () => {

    listaProductos.innerHTML = ''
    carrito.forEach(producto => {
        const li = document.createElement('li')
        li.classList.add('tp-order-info-list-desc')
        li.innerHTML = `
        <p>${producto.nombre} <span> x ${producto.cantidad}</span></p>
        <span>$${producto.cantidad*producto.precio}</span>
        `
        listaProductos.appendChild(li)
    })
    totalProductos()
}

const totalProductos = () => {
    total.innerHTML = ''
    let costoTotal = 0
    carrito.forEach(producto => {
        costoTotal += producto.precio * producto.cantidad
    })
    total.innerHTML = `$${costoTotal}`
}