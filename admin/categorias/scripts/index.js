const listaCategorias       = document.querySelector('#lista-categorias')
const formulario_editar     = document.querySelector('#formulario-editar')
const formulario_registrar  = document.querySelector('#formulario-registrar')
const boton_editar          = document.querySelectorAll('.editar-categoria')
const mensaje               = document.querySelector('#mensaje')
const buscar                = document.querySelector('#buscar')

buscar.addEventListener('keyup', (e) => {
    e.preventDefault()

    const texto = buscar.value.toLowerCase()
    const filas = listaCategorias.querySelectorAll('tr')

    filas.forEach(fila => {
        const nombre = fila.childNodes[3].textContent.toLowerCase()

        if(nombre.indexOf(texto) !== -1){
            fila.style.display = 'table-row'
        }else{
            fila.style.display = 'none'
        }
    })
})

listaCategorias.addEventListener('click', (e) => {
    e.preventDefault()

    editarCategoria(e)
    
})

formulario_registrar.addEventListener('submit', (e) => {
    e.preventDefault()

    const datos = new FormData(formulario_registrar)

    fetch('http://localhost/motors_wheels/admin/categorias/controladores/registrarCategoria.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            formulario_registrar.reset()
            mostrarMensaje(formulario_registrar, data.message, 'success')
        }else{
            mostrarMensaje(formulario_registrar, data.message, 'danger')
        }
        listarCategorias()
    })
})

formulario_editar.addEventListener('submit', (e) => {
    e.preventDefault()

    const datos = new FormData(formulario_editar)

    fetch('http://localhost/motors_wheels/admin/categorias/controladores/editarCategoria.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            mostrarMensaje(formulario_editar, data.message, 'success')
        }else{
            mostrarMensaje(formulario_editar, data.message, 'danger')
        }
        listarCategorias()
    })

})

document.addEventListener('DOMContentLoaded', () => {
    listarCategorias()
})

const editarCategoria = (e) => {
    if(e.target.classList.contains('editar-categoria')){
        const id = e.target.dataset.id
        fetch(`http://localhost/motors_wheels/admin/categorias/controladores/getCategoria.php?Id=${id}`)
        .then(response => response.json())
        .then(data => {
            
            formulario_editar.nombre.value          = data.CATEGORIA
            formulario_editar.id.value              = data.ID_CATEGORIA
            formulario_editar.foto_anterior.value   = data.IMAGEN
        })
    }
}

const listarCategorias = () => {
    listaCategorias.innerHTML = ``
    fetch('http://localhost/motors_wheels/admin/categorias/controladores/getCategorias.php')
    .then(reponse => reponse.json())
    .then(data => {
        data.forEach(resultado => {
            const row = document.createElement('tr')
            row.innerHTML = `
                <td>
                    <img src="../imagenes/${resultado.IMAGEN}" class="rounded" width="50" alt="${resultado.CATEGORIA}">
                </td>
                <td>
                    <span class="text-success">${resultado.CATEGORIA}</span>  
                </td>
                <td class="text-end">
                    <div class="d-flex">
                        <div class="dropdown ms-auto">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a data-bs-toggle="modal" data-bs-target="#Editar" data-id="${resultado.ID_CATEGORIA}" class="dropdown-item editar-categoria">Editar</a>
                            </div>
                        </div>
                    </div>
                </td>
            `
            listaCategorias.appendChild(row)
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