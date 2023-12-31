<?php

class Merma
{
  private $db;
  private $idMerma;
  private $cantidad;
  // private $motivo;
  private $idTipoMerma;
  private $idProducto;
  private $perdida;

  
  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  //
  function getIdMerma()
  {
    return $this->idMerma;
  }
  function setIdMerma($idMerma)
  {
    $this->idMerma = $idMerma;
  }

  // GET - SET Cantidad
  function getCantidad()
  {
    return $this->cantidad;
  }
  function setCantidad($cantidad)
  {
    $this->cantidad = $this->db->real_escape_string($cantidad);
  }

  // GET - SET Motivo
  // function getMotivo()
  // {
  //   return $this->motivo;
  // }
  // function setMotivo($motivo)
  // {
  //   $this->motivo = $this->db->real_escape_string($motivo);
  // }


  // GET - SET Tipo de Merma
  function getIdTipoMerma()
  {
    return $this->idTipoMerma;
  }
  function setIdTipoMerma($idTipoMerma)
  {
    $this->idTipoMerma = $this->db->real_escape_string($idTipoMerma);
  }
  // GET - SET ID Producto
  function getIdProducto()
  {
    return $this->idProducto;
  }
  function setIdProducto($idProducto)
  {
    $this->idProducto = $this->db->real_escape_string($idProducto);
  }

  function getPerdida()
  {
    return $this->perdida;
  }
  function setPerdida($perdida)
  {
    $this->perdida = $this->db->real_escape_string($perdida);
  }

  public function Allmerma()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM merma";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Todos
  public function All()
  {
    // Crear Sentencia
    $sql = "CALL findMerma({$_SESSION['identity']->idrestaurante})";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  // Consultar Por ID
  public function findMermaID()
  {
    $sql = "SELECT * FROM merma WHERE idmerma={$this->getIdMerma()}";
    $producto = $this->db->query($sql);
    return $producto->fetch_object();
  }

  //Registrar
  public function save()
  {
    $sql = "INSERT INTO merma (cantidadMerma, perdida, tipoMerma_idtipoMerma, producto_idproducto, restaurante_idrestaurante ) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ddiii", $this->getCantidad(), $this->getPerdida(), $this->getIdTipoMerma(), $this->getIdProducto(), $_SESSION['identity']->idrestaurante);

    $result = $stmt->execute();
    $stmt->close();

    return $result;



    // $sql = "INSERT INTO merma VALUES ('{$this->getCantidad()}', '{$this->getPerdida()}', '{$this->getIdTipoMerma()}', {$_SESSION['identity']->idrestaurante}, '{$this->getIdProducto()}')";
    // $saved = $this->db->query($sql);

    // if ($saved) {
    //   $result = true;
    // } else {
    //   echo "Error en la consulta: " . $this->db->error;
    //   $result = false;
    // }

    // return $result;
  }
  // Editar
  public function update()
  {
    $sql = "UPDATE merma SET cantidadMerma='{$this->getCantidad()}', perdida='{$this->getPerdida()}', tipoMerma_idtipoMerma='{$this->getIdTipoMerma()}', updated_at=NOW() WHERE idmerma={$this->idMerma} AND restaurante_idrestaurante={$_SESSION['identity']->idrestaurante}";
    $update = $this->db->query($sql);
    $result = false;
    if ($update) {
      $result = true;
    }
    return $result;
  }
  // Eliminar
  public function delete()
  {
    $sql = "DELETE FROM merma WHERE idmerma = '{$this->idMerma}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
