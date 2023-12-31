window.onload = iniciar;

function iniciar() {
  document.getElementById("enviar").addEventListener('click', validar, false);
}

function validarProducto() {
  var elemento = document.getElementById("producto");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica('Elija Deudor');
    return false;
  }
  return true;
}

function validarTipo() {
  var elemento = document.getElementById("tipoMerma");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertica('Elija Tipo de Pago');
    return false;
  }
  return true;
}

function validarCantidad() {
  var elemento = document.getElementById("cantidad");
  if (elemento.value == "" || isNaN(elemento.value)) {
    alertica('Valor Erroneo');
    return false;
  }
  return true;
}



function validar(e) {
  if (validarProducto() && validarCantidad() && validarTipo()) {
    return true;
  } else {
    e.preventDefault();
    return false;
  }
}

// Alertica :v
function alertica(mensaje) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000
  });
  Toast.fire({
    type: 'error',
    title: '<span style="color: white" >' + mensaje + '</span>',
    background: 'rgba(0,0,0,0.9)'
  });
}