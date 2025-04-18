<?php
namespace Models;

use Core\Database;
use PDO;

class Hotel
{
  public static function findAll()
  {
    $db = Database::getConnection();
    $sql = "SELECT h.*, z.descripcion as zona_nombre
                FROM transfer_hotel h
                LEFT JOIN transfer_zona z ON h.id_zona = z.id_zona
                ORDER BY h.id_hotel";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function create($data)
  {
    // Validar
    if (empty($data['id_zona']) || empty($data['descripcion']) || empty($data['comision']) || empty($data['usuario']) || empty($data['password'])) {
      return "Faltan datos para crear hotel";
    }
    $db = Database::getConnection();
    $stmt = $db->prepare("INSERT INTO transfer_hotel (descripcion, id_zona, Comision, usuario, password)
                              VALUES (?, ?, ?, ?, ?)");
    try {
      $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
      $stmt->execute([$data['descripcion'], $data['id_zona'], $data['comision'], $data['usuario'], $passwordHash]);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function update($data)
  {
    if (empty($data['id_hotel']) || empty($data['descripcion']) || empty($data['id_zona']) || empty($data['comision']) || empty($data['usuario'])) {
      return "Faltan datos para actualizar hotel";
    }
    $db = Database::getConnection();
    $sql = "UPDATE transfer_hotel
                SET id_zona = ?,
                    descripcion = ?,
                    Comision = ?,
                    usuario = ?";
    $params = [$data['id_zona'], $data['descripcion'], $data['comision'], $data['usuario']];
    if (!empty($data['password'])) {
      $sql .= ", password = ?";
      $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    $sql .= " WHERE id_hotel = ?";
    $params[] = $data['id_hotel'];

    try {
      $stmt = $db->prepare($sql);
      $stmt->execute($params);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function delete($id_hotel)
  {
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("DELETE FROM transfer_hotel WHERE id_hotel = ?");
      $stmt->execute([$id_hotel]);
      return true;
    } catch (\PDOException $e) {
      return "No se puede eliminar el hotel. Detalle: " . $e->getMessage();
    }
  }

  public static function countAll()
  {
    $db = Database::getConnection();
    return $db->query("SELECT COUNT(*) FROM transfer_hotel")->fetchColumn();
  }
}
