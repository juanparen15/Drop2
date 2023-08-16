<?php

class ArchivoController
{
  private $db;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }

  public function gestion()
  {
    $sql = "SELECT idArchivo, descripcion, document, idUser, nombre, apellido, created_at FROM archivos INNER JOIN usuarios ON archivos.idUser = usuarios.idusuarios";
    $docs = $this->db->query($sql);
    require_once 'views/archivo/gestion.php';
  }

  public function eliminar()
  {
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $idArc = $_GET['id'];
      $sql = "DELETE FROM archivos WHERE idArchivo=$idArc AND idUser={$_SESSION['identity']->idusuarios}";
      $result = $this->db->query($sql);
      if ($result) {
        $_SESSION['delete'] = 'Eliminado';
      } else {
        $_SESSION['delete'] = 'NoSePuede';
      }
      header('Location: ' . baseUrl . 'archivo/gestion');
    }
  }

  public function registrar()
  {
    if (isset($_POST) && !empty($_POST['descripcion'])) {
      $descripcion = $_POST['descripcion'];

      $file = $_FILES['archivo'];
      $name = $file['name'];
      $tipo = strtolower(pathinfo($name, PATHINFO_EXTENSION));

      $sql = "SELECT * FROM archivos";

      $result = $this->db->query($sql);

      if ($result) {
        $count = 0;
        while ($d = $result->fetch_object()) {
          if ($d->document == $name) {
            $count++;
          }
        }
        if ($count > 0) {
          $_SESSION['save'] = 'YaExiste';
          header('Location: ' . baseUrl . 'archivo/gestion');
        } else {
          if ($tipo == 'docx' || $tipo == 'doc' || $tipo == 'pdf' || $tipo == 'jpg' || $tipo == 'jpeg' || $tipo == 'png') {
            if (!is_dir('uploads')) {
              mkdir('uploads/archivos', 0777, true);
            }
            move_uploaded_file($file['tmp_name'], 'uploads/archivos/' . $name);

            $sql = "INSERT INTO archivos VALUES (NULL, '$descripcion', '$name', {$_SESSION['identity']->idusuarios}, NOW())";

            $insert = $this->db->query($sql);
            if ($insert) {
              $_SESSION['save'] = 'Registrado';
              header('Location: ' . baseUrl . 'archivo/gestion');
            } else {
              $_SESSION['save'] = 'Error';
              header('Location: ' . baseUrl . 'archivo/gestion');
            }
          } else {
            $_SESSION['save'] = 'NoAdmitido';
            header('Location: ' . baseUrl . 'archivo/gestion');
          }
        }
      } else {
        echo 'Yuca';
      }
    } else {
      $_SESSION['notData'] = 'ErrorDatos';
      header('Location: ' . baseUrl . 'archivo/gestion');
    }
  }

  public function descargar()
  {
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $nombreArchivo = $_GET['id'];
      $rutaArchivo = 'uploads/archivos/' . $nombreArchivo;

      if (file_exists($rutaArchivo)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        // header("Content-Transfer-Encoding: Binary");
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        header('Expires: 0');
        header("Cache-Control: public");
        header('Pragma: public');
        header('Content-Length: ' . filesize($rutaArchivo));
        ob_end_flush();
        readfile($rutaArchivo);
        exit;
      } else {
        // Manejar el caso en que el archivo no existe
      }
    }
  }
}
