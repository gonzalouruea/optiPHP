<?php
namespace Models;

use Core\Database;
use PDO;

class Zona
{
  public static function findAll()
  {
    $db = Database::getConnection();
    $sql = "SELECT z.*,
                (SELECT COUNT(*) FROM tranfer_hotel h WHERE h.id_zona = z.id_zona) as num_hoteles
                FROM transfer_zona z
                ORDER BY z.id_zona";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function create($data)
  {
    if (empty($data['descripcion'])) {
      return "Descripción de zona requerida";
    }
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("INSERT INTO transfer_zona (descripcion) VALUES (?)");
      $stmt->execute([trim($data['descripcion'])]);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function update($data)
  {
    if (empty($data['id_zona']) || empty($data['descripcion'])) {
      return "Faltan datos para actualizar zona";
    }
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("UPDATE transfer_zona SET descripcion = ? WHERE id_zona = ?");
      $stmt->execute([trim($data['descripcion']), $data['id_zona']]);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function delete($id_zona)
  {
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("DELETE FROM transfer_zona WHERE id_zona = ?");
      $stmt->execute([$id_zona]);
      return true;
    } catch (\PDOException $e) {
      return "Error al eliminar zona: " . $e->getMessage();
    }
  }
}
