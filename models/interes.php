<?php

class Interes
{
    private $db;
    private $id;
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

    // GET - SET Nombre
    function getInteres()
    {
        return $this->interes;
    }
    function setInteres($interes)
    {
        $this->interes = $this->db->real_escape_string($interes);
    }

    // Consultar Todos Los Restaurantes
    public function findInteres()
    {
        // Crear Sentencia
        $sql = "SELECT * FROM interes";
        // Enviamos La Sentencia
        $result = $this->db->query($sql);
        return $result;
    }

    // Consultar Usuario Por ID
    public function findInteresID()
    {
        $sql = "SELECT * FROM interes WHERE id={$this->getId()}";
        $interes = $this->db->query($sql);
        return $interes->fetch_object();
    }

    //Registrar
    public function save()
    {
        $sql = "INSERT INTO interes VALUES (NULL, '{$this->getInteres()}')";
        $saved = $this->db->query($sql);
        $result = false;
        if ($saved) {
            $result = true;
        }
        return $result;
    }
    // Editar
    public function update()
    {
        $sql = "UPDATE interes SET interes='{$this->getInteres()}' WHERE id='{$this->id}'";
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
        $sql = "DELETE FROM interes WHERE id= '{$this->id}'";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}
