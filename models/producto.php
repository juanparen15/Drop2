<?php

class Producto
{
  private $db;
  private $id;
  private $usuario;
  private $restaurante;
  // private $nombre;
  private $precio;
  private $precioTotal;
  private $meses;
  private $interes;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET ID
  function getId()
  {
    return $this->id;
  }
  function setId($id)
  {
    $this->id = $id;
  }

  function getUsuario()
  {
    return $this->usuario;
  }
  function setUsuario($usuario)
  {
    $this->usuario = $this->db->real_escape_string($usuario);
  }

  function getRestaurante()
  {
    return $this->restaurante;
  }
  function setRestaurante($restaurante)
  {
    $this->restaurante = $this->db->real_escape_string($restaurante);
  }

  // // GET - SET Nombre
  // function getNombre()
  // {
  //   return $this->nombre;
  // }
  // function setNombre($nombre)
  // {
  //   $this->nombre = $this->db->real_escape_string($nombre);
  // }

  // GET - SET Precio
  function getPrecio()
  {
    return $this->precio;
  }
  function setPrecio($precio)
  {
    $this->precio = $this->db->real_escape_string($precio);
  }

  // GET - SET Precio
  function getPrecioTotal()
  {
    return $this->precioTotal;
  }
  function setPrecioTotal($precioTotal)
  {
    $this->precioTotal = $this->db->real_escape_string($precioTotal);
  }

  // GET - SET Meses
  function getMeses()
  {
    return $this->meses;
  }
  function setMeses($meses)
  {
    $this->meses = $this->db->real_escape_string($meses);
  }

  // GET - SET Interes
  function getInteres()
  {
    return $this->interes;
  }
  function setInteres($interes)
  {
    $this->interes = $this->db->real_escape_string($interes);
  }

  // Consultar Todos
  public function findPtos()
  {
    // Crear Sentencia
    $sql = "SELECT * FROM producto inner join usuarios on producto.usuario_idusuarios = usuarios.idusuarios inner join restaurante on producto.restaurante_idrestaurante = restaurante.idrestaurante inner join interes on producto.interes_id = interes.id";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }
  // Consultar Todos
  // public function findPtosI()
  // {
  //   // Crear Sentencia
  //   $sql = "SELECT * FROM interes";
  //   // Enviamos La Sentencia
  //   $result = $this->db->query($sql);
  //   return $result;
  // }

  public function findPtos1()
  {
    // Crear Sentencia
    $sql = "CALL findProducto()";
    // Enviamos La Sentencia
    $result = $this->db->query($sql);
    return $result;
  }

  public function findUtos()
  {
    // Crear Sentencia
    $sql = "CALL findDeudorID()";
    // Enviamos La Sentencia
    $producto = $this->db->query($sql);
    return $producto;
  }

  // Consultar Por ID
  public function findProductoID()
  {
    $sql = "SELECT * FROM producto INNER JOIN usuarios ON producto.usuario_idusuarios = usuarios.idusuarios WHERE producto.idproducto={$this->getId()}";
    $producto = $this->db->query($sql);
    return $producto->fetch_object();
    // return $producto;
  }



  // Registrar
  public function save()
  {
    $sql = "INSERT INTO producto (usuario_idusuarios, restaurante_idrestaurante, precioProducto, precioProductoTotal, numeroMeses, interes_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("iiddii", $this->getUsuario(), $this->getRestaurante(), $this->getPrecio(), $this->getPrecio(), $this->getMeses(), $this->getInteres());
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  // Editar
  public function update()
  {
    $sql = "UPDATE producto SET usuario_idusuarios='{$this->getUsuario()}', restaurante_idrestaurante='{$this->getRestaurante()}', precioProducto='{$this->getPrecio()}', numeroMeses='{$this->getMeses()}', interes_id='{$this->getInteres()}', updated_at=NOW() WHERE idproducto={$this->id}";
    $update = $this->db->query($sql);
    $result = false;
    if ($update) {
      $result = true;
    }
    return $result;
  }
  // public function update()
  // {
  //   $sql = "UPDATE producto SET usuario_idusuarios=?, restaurante_idrestaurante=?, precioProducto=?, precioProductoTotal=?, numeroMeses=?, interes_id=?, updated_at=NOW() WHERE idproducto=?";
  //   $stmt = $this->db->prepare($sql);
  //   $stmt->bind_param("iiddii", $this->getUsuario(), $this->getRestaurante(), $this->getPrecio(), $this->getPrecioTotal(), $this->getMeses(), $this->getInteres());
  //   $result = $stmt->execute();
  //   $stmt->close();

  //   return $result;
  // }
  // Eliminar
  public function delete()
  {
    $sql = "DELETE FROM producto WHERE idproducto = '{$this->id}'";
    $delete = $this->db->query($sql);
    $result = false;
    if ($delete) {
      $result = true;
    }
    return $result;
  }
}
