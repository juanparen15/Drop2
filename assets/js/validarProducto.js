window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

function validarPrecio() {
  var elemento = document.getElementById("precio");
  if (elemento.value == "" || isNaN(elemento.value)) {
    alertica('Precio Erroneo');
    return false;
  }
  return true;
}

function validarMeses() {
  var elemento = document.getElementById("meses");
  if (elemento.value == "" || isNaN(elemento.value) || parseInt(elemento.value) <= 0) {
    alertica('Meses Erroneos');
    return false;
  }
  return true;
}

function validar(e) {
  if (validarPrecio() && validarMeses()) {
    return true;
  } else {
    e.preventDefault();
    return false;
  }
}

function alertica(mensaje) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 5000
  });
  Toast.fire({
    type: 'error',
    title: '<span style="color: white">' + mensaje + '</span>',
    background: 'rgba(0,0,0,0.9)'
  });
}
