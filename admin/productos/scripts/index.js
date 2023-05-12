const listaProductos        = document.querySelector('#lista-productos')
const formulario_registrar  = document.querySelector('#formulario-registrar')
const formulario_editar     = document.querySelector('#formulario_editar')
const categorias_registrar  = document.querySelector('#categoria')
const categorias_editar     = document.querySelector('#categoria_editar')
const mensaje               = document.querySelector('#mensaje')
const buscar                = document.querySelector('#buscar')

buscar.addEventListener('keyup', (e) => {
    e.preventDefault()

    const texto = buscar.value.toLowerCase()
    const filas = listaProductos.querySelectorAll('tr')

    filas.forEach(fila => {
        const nombre = fila.childNodes[3].textContent.toLowerCase()

        if(nombre.indexOf(texto) !== -1){
            fila.style.display = 'table-row'
        }else{
            fila.style.display = 'none'
        }
    })
})

listaProductos.addEventListener('click', (e) => {
    e.preventDefault()

    editarProducto(e)

})

document.addEventListener('DOMContentLoaded', () => {
    listarProductos()
    listarCategorias(categorias_registrar)
    listarCategorias(categorias_editar)
})

formulario_registrar.addEventListener('submit', (e) => {
    e.preventDefault()

    const datos = new FormData(formulario_registrar)

    fetch('http://localhost/motors_wheels/admin/productos/controladores/registrarProducto.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            formulario_registrar.reset()
            mostrarMensaje(formulario_registrar, data.message, data.status)
        }else{
            mostrarMensaje(formulario_registrar, data.message, 'danger')
        }
        listarProductos()
    })
})

formulario_editar.addEventListener('submit', (e) => {
    e.preventDefault()

    const datos = new FormData(formulario_editar)

    fetch('http://localhost/motors_wheels/admin/productos/controladores/editarProducto.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            formulario_editar.reset()
            listarProductos()
            mostrarMensaje(formulario_editar, data.message, data.status)
        }else{
            mostrarMensaje(formulario_editar, data.message, 'danger')
        }
    })

})

const listarProductos = () => {
    listaProductos.innerHTML = ``
    fetch('http://localhost/motors_wheels/admin/productos/controladores/getProductos.php')
    .then(res => res.json())
    .then(data => {
        data.forEach(producto => {
            const row = document.createElement('tr')
            row.innerHTML = `
            <td>
                <a href="#">
                    <img src="../imagenes/${producto.IMAGEN_PRODUCTO}" class="rounded" width="100" alt="${producto.NOMBRE}">
                </a>
            </td>
            <td>${producto.NOMBRE}</td>
            <td>
                <span class="text-success">${producto.CATEGORIA}</span>
            </td>
            <td>$${producto.PRECIO}</td>
            <td>
                <span class="text-success">En Stock </span> #${producto.STOCK}
            </td>
            <td class="text-end">
                <div class="d-flex">
                    <div class="dropdown ms-auto">
                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a data-bs-toggle="modal" data-bs-target="#Editar" class="dropdown-item editar-producto" data-id="${producto.ID_PRODUCTO}">Editar</a>
                        </div>
                    </div>
                </div>
            </td>
            `
            listaProductos.appendChild(row)
        })
    })
}

const listarCategorias = (categorias) => {
    fetch('http://localhost/motors_wheels/admin/categorias/controladores/getCategorias.php')
    .then(res => res.json())
    .then(data => {
        data.forEach(categoria => {
            const option = document.createElement('option')
            option.value = categoria.ID_CATEGORIA
            option.textContent = categoria.CATEGORIA
            categorias.appendChild(option)
        })
    })
}

const mostrarMensaje = (formulario, texto, tipo) => {
    
    const modal = bootstrap.Modal.getInstance(formulario.parentNode.parentNode.parentNode.parentNode)
    modal.hide()

    mensaje.classList.add(`alert`,`alert-${tipo}`)
    mensaje.innerHTML = texto

    setTimeout(() => {
        mensaje.classList.remove(`alert`,`alert-${tipo}`)
        mensaje.innerHTML = ''
    }, 3000)
}

const editarProducto = (e) => {
    if(e.target.classList.contains('editar-producto')){
        const id = e.target.dataset.id
        fetch(`http://localhost/motors_wheels/admin/productos/controladores/getProducto.php?Id=${id}`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            formulario_editar.id.value                   = data.ID_PRODUCTO
            formulario_editar.foto_anterior.value        = data.IMAGEN_PRODUCTO
            formulario_editar.categoria.options[0].value = data.ID_CATEGORIA
            formulario_editar.categoria.options[0].text  = data.CATEGORIA
            formulario_editar.nombre.value               = data.NOMBRE 
            formulario_editar.descripcion.value          = data.DESCRIPCION 
            formulario_editar.precio.value               = data.PRECIO 
            formulario_editar.precio_promocion.value     = data.PRECIO_PROMOCION 
            formulario_editar.stock.value                = data.STOCK 
        })
    }
}