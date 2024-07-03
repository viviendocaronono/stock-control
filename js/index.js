//buscamos dentro del documento el elemento que tiene el nombre de usuario
let inp_nombre_usuario = document.getElementById('nombre');

//agrega el evento "cambio" al elemento y ejecuta la funcion verificar
inp_nombre_usuario.addEventListener("change", verificarNombreUsuario);

function verificarNombreUsuario() {
    //obtenemos el valor del nombre de usuario
    let nombre_usuario = inp_nombre_usuario.value;
    
    //consulta asincronica
    fetch('verificar_usuario.php', {
        method: 'POST',
        body: JSON.stringify({ 'usuario': nombre_usuario })
    })
    //el valor que vuelve del php es verdadero o falso
    .then(response => response.text())
    .then(data => {
        //informamos al usuario
        document.getElementById('msj').innerHTML = data
    });
}
