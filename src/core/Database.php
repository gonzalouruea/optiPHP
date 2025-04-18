<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
  private static $instance = null;
  private $conn;

  private function __construct()
  {
    $host = 'db';
    $dbname = 'viajes';
    $user = 'user';
    $pass = 'user_password';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    try {
      $this->conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]);
    } catch (PDOException $e) {
      error_log("Error de conexión: " . $e->getMessage());
      die("Error en el servidor. Por favor intenta más tarde.");
    }
  }

  public static function getConnection()
  {
    if (!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance->conn;
  }
}
