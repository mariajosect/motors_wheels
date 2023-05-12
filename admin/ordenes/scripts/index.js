const listaOrdenes = document.querySelector('#lista-ordenes')

document.addEventListener('DOMContentLoaded', () => {


    listarOrdenes()
})

const listarOrdenes = () => {

    listaOrdenes.innerHTML = ''

    fetch('http://localhost/motors_wheels/admin/ordenes/controladores/listarOrdenes.php')
    .then(res => res.json())
    .then(data => {
        data.forEach(orden => {
            const tr = document.createElement('tr')
            tr.innerHTML = `
                <td>${orden.NOMBRE} ${orden.APELLIDO}</td>
                <td>${orden.DIRECCION} - ${orden.PAIS}</td>
                <td>${orden.CELULAR}</td>
                <td>${orden.CORREO}</td>
                <td>${orden.TOTAL_ORDEN}</td>
                <td>1</td>
                <td class="text-end">
                    <div class="d-flex">
                        <div class="dropdown ms-auto">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a data-bs-toggle="modal" data-bs-target="#Editar" class="dropdown-item editar-producto">Editar</a>
                            </div>
                        </div>
                    </div>
                </td>
            `
            listaOrdenes.appendChild(tr)
        });
    })
}