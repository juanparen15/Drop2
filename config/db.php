<?php

class DataBase
{
  public static function conectar()
  {
    // Crear Conexion
    $db = new mysqli('127.0.0.1', 'fabian', 'S0p0rt31957*a+', 'drop2');
    // Admitir Ñ y tildes de la Base de Datos
    $db->query("SET NAMES 'utf8'");
    return $db;
  }
}