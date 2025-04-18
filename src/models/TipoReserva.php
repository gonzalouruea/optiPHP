<?php
namespace Models;

use Core\Database;
use PDO;

class TipoReserva
{
  public static function findAllWithCount()
  {
    $db = Database::getConnection();
    $sql = "SELECT tr.*,
                (SELECT COUNT(*) FROM transfer_reservas r WHERE r.id_tipo_reserva = tr.id_tipo_reserva) as num_reservas
                FROM transfer_tipo_reserva tr
                ORDER BY tr.id_tipo_reserva";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function create($data)
  {
    if (empty($data['descripcion'])) {
      return "Descripción requerida";
    }
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("INSERT INTO transfer_tipo_reserva (Descripción) VALUES (?)");
      $stmt->execute([$data['descripcion']]);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function update($data)
  {
    if (empty($data['id_tipo_reserva']) || empty($data['descripcion'])) {
      return "Faltan datos para actualizar tipo de reserva";
    }
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("UPDATE transfer_tipo_reserva SET Descripción = ? WHERE id_tipo_reserva = ?");
      $stmt->execute([$data['descripcion'], $data['id_tipo_reserva']]);
      return true;
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
  }

  public static function delete($id_tipo_reserva)
  {
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("DELETE FROM transfer_tipo_reserva WHERE id_tipo_reserva = ?");
      $stmt->execute([$id_tipo_reserva]);
      return true;
    } catch (\PDOException $e) {
      return "No se puede eliminar el tipo de reserva: " . $e->getMessage();
    }
  }
}
