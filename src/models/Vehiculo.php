<?php
namespace Models;

use Core\Database;
use PDO;

class Vehiculo
{
  public static function findAll()
  {
    $db = Database::getConnection();
    return $db->query("SELECT * FROM transfer_vehiculo ORDER BY id_vehiculo")->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function create($data)
  {
    if (empty($data['descripcion']) || empty($data['email']) || empty($data['password'])) {
      return "Faltan datos para crear vehículo";
    }
    $db = Database::getConnection();
    $stmt = $db->prepare("INSERT INTO transfer_vehiculo (Descripción, email_conductor, password)
                              VALUES (?, ?, ?)");
    try {
      $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
      $stmt->execute([$data['descripcion'], $data['email'], $passwordHash]);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function update($data)
  {
    if (empty($data['id_vehiculo']) || empty($data['descripcion']) || empty($data['email'])) {
      return "Faltan datos para actualizar vehículo";
    }
    $db = Database::getConnection();
    $sql = "UPDATE transfer_vehiculo
                SET Descripción = ?,
                    email_conductor = ?";
    $params = [$data['descripcion'], $data['email']];
    if (!empty($data['password'])) {
      $sql .= ", password = ?";
      $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
    $sql .= " WHERE id_vehiculo = ?";
    $params[] = $data['id_vehiculo'];

    try {
      $stmt = $db->prepare($sql);
      $stmt->execute($params);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function delete($id_vehiculo)
  {
    $db = Database::getConnection();
    try {
      // Comprobar reservas asociadas si quieres
      $stmt = $db->prepare("DELETE FROM transfer_vehiculo WHERE id_vehiculo = ?");
      $stmt->execute([$id_vehiculo]);
      return true;
    } catch (\PDOException $e) {
      return "Error al eliminar vehículo: " . $e->getMessage();
    }
  }

  public static function countAll()
  {
    $db = Database::getConnection();
    return $db->query("SELECT COUNT(*) FROM transfer_vehiculo")->fetchColumn();
  }
}
