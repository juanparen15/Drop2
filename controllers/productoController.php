<?php
require_once 'models/producto.php';
require_once 'models/merma.php';

class ProductoController
{
  public function gestion()
  {

    $p = new Producto();
    $ptos = $p->findPtos();
    require_once 'views/producto/crud.php';
  }
  public static function getAll()
  {
    $p = new Producto();
    $ptos = $p->findPtos();
    return $ptos;
  }
  public static function getPAll()
  {
    $p = new Producto();
    $ptos = $p->findPtos1();
    return $ptos;
  }

  // Método para encontrar un producto por su ID
  public function findProductoID($id)
  {
    $producto = new Producto();
    $producto->setId($id);
    return $producto->findProductoID(); // Asegúrate de que este método exista en tu modelo Producto
  }



  // public static function getUAll()
  // {
  //   $p = new Producto();
  //   $ptos = $p->findUtos();
  //   return $ptos;
  // }
  // Registrar Y Editar
  public function registrar()
  {

    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['usuario']) && !empty($_POST['precio']) && !empty($_POST['meses'])) {
      // Almacenamos los Datos en variables
      $usuario = $_POST['usuario'];
      $restaurante = $_POST['restaurante'];
      $precio = $_POST['precio'];
      $meses = $_POST['meses'];
      // Creamos un Objeto Restaurante
      $pro = new Producto();
      // Almacenamos los Datos
      $pro->setUsuario($usuario);
      $pro->setRestaurante($restaurante);
      //$pro->setNombre($nombre);
      $pro->setPrecio($precio);
      $pro->setMeses($meses);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro->setId($id);
        $save = $pro->update();
        if ($save) {
          // Actualizar el precio del producto en caso de una actualización exitosa
          $merma = new Merma();
          $restante = $merma->getPerdida(); // Suponiendo que tienes un método getPerdida
          $pro->setPrecio($restante); // Actualizar el precio del producto
        }
      } else {
        $save = $pro->save();
      }
      // Verificamos si fue Exitoso :v
      if ($save) {
        if (isset($_GET['id'])) {
          $_SESSION['saveEdit'] = 'Editado';
        } else {
          $_SESSION['saveEdit'] = 'Registrado';
        }
      } else {
        $_SESSION['error'] = 'ErrorRegistro';
      }
    } else {
      $_SESSION['notData'] = 'ErrorDatos';
    }
    header('Location: ' . baseUrl . 'producto/gestion');
  }


  // Editar
  public function editar()
  {

    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $pro = new Producto();
      //
      $pro->setId($id);
      $proEdit = $pro->findProductoID();
      require_once 'views/producto/crud.php';
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }

  // Eliminar
  public function eliminar()
  {

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $p = new Producto();
      $p->setId($id);
      $delete = $p->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'producto/gestion');
  }
}
