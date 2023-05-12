const formulario_inicio = document.querySelector('#formulario_inicio')
const mensajes          = document.querySelector('#mensaje')

formulario_inicio.addEventListener('submit', (e) => {
    e.preventDefault()

    const datos = new FormData(formulario_inicio)

    fetch('http://localhost/motors_wheels/admin/usuarios/controladores/iniciarSesion.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === "success"){
            mensajes.classList.add('alert','alert-success')
            mensajes.textContent = data.message
            setTimeout(() => {
                window.location.href = 'http://localhost/motors_wheels/admin/dashboard/vistas/index.php'
            }, 2500);
        }else{
            mensajes.classList.add('alert','alert-danger')
            mensajes.textContent = data.message
            setTimeout(() => {
                mensajes.classList.remove('alert','alert-danger')
                mensajes.textContent = ''
            }, 3000);
        }
    })
})