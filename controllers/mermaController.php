<?php
require_once 'models/merma.php';
require_once 'models/producto.php';

class MermaController
{
  public function consultarMerma()
  {
    // Utils::isAdmin();
    $m = new Merma();
    $merma = $m->All();
    require_once 'views/merma/consultarMerma.php';
  }
  public static function getAll()
  {
    $p = new Merma();
    $ptos = $p->Allmerma();
    return $ptos;
  }

  // Registro
  public function registro()
  {
    // Utils::isAdmin();
    require_once 'views/merma/registrar.php';
  }

  // public function ver(){
  //   Utils::isCocina();
  //   $idPedido = $_GET['id'];
  //   $pedHP = new PedidoHP();
  //   $pedHP->setIdPedido($idPedido);
  //   $p = $pedHP->find();
  //   require_once 'views/nose/pedidoHp.php';
  // }

  //PDF
  public function pdf()
  {
    $mr = new Merma();
    $merma = $mr->All();
    require_once 'librerias/pdf/merma/pdfMerma.php';
  }

  public function registrar()
  {
    // Utils::isAdmin();
    // Verificamos si hay datos por POST
    if (isset($_POST) && (!empty($_POST['producto']) || !empty($_GET['id'])) && !empty($_POST['cantidad']) && !empty($_POST['tipoMerma'])) {
      // Creamos el contenedor
      $merma = new Merma();
      // Si esta editando
      if (!empty($_GET['id'])) {
        $m = new Merma();
        $p = new Producto();
        $m->setIdMerma($_GET['id']);

        $rrr = $m->findMermaID();
        $pr = $p->findProductoID();

        $cantActual = $rrr->cantidadMerma;

        $restante = $cantActual + ($_POST['cantidad']);
        // $restaurante = $rrr->restaurante_idrestaurante;
        if ($restante < 0) {
          $_SESSION['saveEdit'] = 'Yuca';
          header('Location: ' . baseUrl . 'producto/editar&id=' . $_GET['id']);
          die();
        }
        //
        $merma->setIdMerma($_GET['id']);
        $merma->setIdProducto($rrr->producto_idproducto);
        $merma->setCantidad($restante);
      } elseif (!empty($_POST['producto'])) {

        $merma->setIdProducto($_POST['producto']);
        $merma->setCantidad($_POST['cantidad']);
      }
      $merma->setIdTipoMerma($_POST['tipoMerma']);




      if ($merma->getIdTipoMerma() == 1 || $merma->getIdTipoMerma() == 2 || $merma->getIdTipoMerma() == 3) {
        // Calcular Restante
        $cantidad = isset($_GET['id']) ? $restante : $_POST['cantidad'];
        $p = new Producto();
        $p->setId(isset($_GET['id']) ? $rrr->producto_idproducto : $_POST['producto']);

        $result = $p->findProductoID();
        $precio = $result->precioProducto;
        $perdida = $precio - $cantidad;
        if ($perdida < '0') {
          $_SESSION['saveEdit'] = 'Yuca';
          header('Location: ' . baseUrl . 'merma/registro');
          die();
        }
        $merma->setPerdida($perdida);
        $productoId = $_POST['producto'];
        $db = new mysqli('localhost', 'root', '', 'drop2');
        $consulta1 = "UPDATE producto SET precioProducto = $perdida WHERE idProducto = $productoId";
        $resultado1 = $db->query($consulta1);




        if ($resultado1) {
          // Actualización exitosa
          $_SESSION['saveEdit'] = 'Precio actualizado';
        } else {
          // Error en la actualización
          $_SESSION['saveEdit'] = 'Error en la actualización del precio';
        }
      } else {
        $merma->setPerdida(0);
        $p->setPrecio(0);
      }
      // Realizamos el Registro
      if (isset($_GET['id'])) {
        $save = $merma->update();
      } else {
        $save = $merma->save();
      }
      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
      }
      header('Location: ' . baseUrl . 'merma/consultarMerma');
    } else {
      if (isset($_GET['id'])) {
        $_SESSION['saveEdit'] = 'Vacios';
        header('Location: ' . baseUrl . 'merma/editar&id=' . $_GET['id']);
      } else {
        $_SESSION['saveEdit'] = 'Vacios';
        header('Location: ' . baseUrl . 'merma/registro');
      }
    }
  }
  // Editar
  public function editar()
  {
    // Utils::isAdmin();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $mr = new Merma();
      //
      $mr->setIdMerma($id);
      $mr = $mr->findMermaID();
      require_once 'views/merma/registrar.php';
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  // Eliminar
  public function eliminar()
  {
    // Utils::isAdmin();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $mr = new Merma();
      $mr->setIdMerma($id);
      $delete = $mr->delete();
      $_SESSION['delete'] = 'Eliminado';
      if (!$delete) {
        $_SESSION['delete'] = 'Error';
      }
    } else {
      $_SESSION['estado'] = 'Vacios';
    }
    header('Location: ' . baseUrl . 'merma/consultarMerma');
  }
}
