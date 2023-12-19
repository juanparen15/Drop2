<?php
require_once 'models/interes.php';

class InteresController
{
  public function gestion()
  {
    // Utils::isAdmin();
    $i = new Interes();
    $interes = $i->findInteres();
    require_once 'views/interes/crud.php';
  }
  public static function getAll()
  {
    $i = new Interes();
    $interes = $i->findInteres();
    return $interes;
  }
  // Registrar
  public function registrar()
  {
    // Utils::isAdmin();
    // Verificamos si se Manda Algo por POST
    if (isset($_POST) && !empty($_POST['interes'])) {
      // Almacenamos los Datos en variables
      $interes = $_POST['interes'];
      // Creamos un Objeto Restaurante
      $interes = new Interes();
      // Almacenamos los Datos
      $interes->setInteres($interes);
      // Realizamos el INSERT O UPDATE
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $interes->setId($id);
        $save = $interes->update();
      } else {
        $save = $interes->save();
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
    header('Location: ' . baseUrl . 'cargo/gestion');
  }

  // Editar
  public function editar()
  {
    // Utils::isAdmin();
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $editar = true;
      //
      $id = $_GET['id'];
      $interes = new Interes();
      //
      $interes->setId($id);
      $carEdit = $interes->findInteresID();
      require_once 'views/interes/crud.php';
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
      $i = new Interes();
      $i->setId($id);
      $delete = $i->delete();
      if ($delete) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoQuery';
      }
    }
    header('Location: ' . baseUrl . 'interes/gestion');
  }
}
