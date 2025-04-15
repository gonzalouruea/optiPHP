<?php
namespace Models;

use Core\Database;
use PDO;

class Reserva
{
  public static function findAll()
  {
    $db = Database::getConnection();
    $sql = "SELECT r.*,
                       v.Descripción as vehiculo_nombre,
                       h.usuario as hotel_nombre,
                       tr.Descripción as tipo_reserva_nombre
                FROM transfer_reservas r
                LEFT JOIN transfer_vehiculo v ON r.id_vehiculo = v.id_vehiculo
                LEFT JOIN tranfer_hotel h ON r.id_hotel = h.id_hotel
                LEFT JOIN transfer_tipo_reserva tr ON r.id_tipo_reserva = tr.id_tipo_reserva
                ORDER BY r.fecha_reserva DESC";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findByEmail($email)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT r.*,
                       v.Descripción as vehiculo_nombre,
                       h.usuario as hotel_nombre,
                       tr.Descripción as tipo_reserva_nombre
                FROM transfer_reservas r
                LEFT JOIN transfer_vehiculo v ON r.id_vehiculo = v.id_vehiculo
                LEFT JOIN tranfer_hotel h ON r.id_hotel = h.id_hotel
                LEFT JOIN transfer_tipo_reserva tr ON r.id_tipo_reserva = tr.id_tipo_reserva
                WHERE r.email_cliente = ?
                ORDER BY r.fecha_reserva DESC");
    $stmt->execute([$email]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findById($id)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Lógica para insertar
  public static function crearReserva($data, $rolUsuario)
  {
    // Validaciones mínimas
    if (
      empty($data['tipo_trayecto']) ||
      empty($data['num_viajeros']) ||
      empty($data['id_vehiculo']) ||
      empty($data['id_hotel'])
    ) {
      return "Faltan campos obligatorios para la reserva";
    }

    // Si no es admin, comprobar 48h si hay fecha_entrada
    if ($rolUsuario !== 'admin' && !empty($data['fecha_entrada']) && !empty($data['hora_entrada'])) {
      $t = strtotime($data['fecha_entrada'] . ' ' . $data['hora_entrada']);
      if ($t - time() < 48 * 3600) {
        return "Las reservas deben hacerse con mínimo 48 horas de antelación";
      }
    }

    $localizador = self::generarLocalizador();

    $db = Database::getConnection();
    $sql = "INSERT INTO transfer_reservas
                (localizador, id_tipo_reserva, email_cliente, fecha_reserva, fecha_modificacion,
                 id_hotel, fecha_entrada, hora_entrada, numero_vuelo_entrada,
                 fecha_vuelo_salida, hora_vuelo_salida, hora_recogida,
                 num_viajeros, id_vehiculo, creado_por_admin)
                VALUES
                (:loc, :tipo, :email, NOW(), NOW(),
                 :hotel, :fentrada, :hentrada, :vuelo_entrada,
                 :fsalida, :hsalida, :hrecogida,
                 :viajeros, :vehiculo, :admin)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
      ':loc' => $localizador,
      ':tipo' => $data['tipo_trayecto'],
      ':email' => $data['email_cliente'],
      ':hotel' => $data['id_hotel'],
      ':fentrada' => $data['fecha_entrada'],
      ':hentrada' => $data['hora_entrada'],
      ':vuelo_entrada' => $data['numero_vuelo_entrada'] ?? null,
      ':fsalida' => $data['fecha_vuelo_salida'],
      ':hsalida' => $data['hora_vuelo_salida'],
      ':hrecogida' => $data['hora_recogida'],
      ':viajeros' => $data['num_viajeros'],
      ':vehiculo' => $data['id_vehiculo'],
      ':admin' => ($rolUsuario === 'admin' ? 1 : 0),
    ]);

    // (Opcional) Enviar email con mail(...)
    return true;
  }

  public static function updateReserva($data, $oldReserva, $rolUsuario)
  {
    // Check 48h si no es admin
    if ($rolUsuario !== 'admin') {
      $fReserva = null;
      if (!empty($oldReserva['fecha_entrada'])) {
        $fReserva = strtotime($oldReserva['fecha_entrada'] . ' ' . $oldReserva['hora_entrada']);
      } elseif (!empty($oldReserva['fecha_vuelo_salida'])) {
        $fReserva = strtotime($oldReserva['fecha_vuelo_salida'] . ' ' . $oldReserva['hora_vuelo_salida']);
      }
      if ($fReserva && ($fReserva - time() < 48 * 3600)) {
        return "No se puede modificar una reserva con menos de 48 horas";
      }
    }

    $db = Database::getConnection();
    $sql = "UPDATE transfer_reservas SET
                id_hotel = :hotel,
                id_vehiculo = :vehiculo,
                num_viajeros = :viajeros,
                fecha_entrada = :fentrada,
                hora_entrada = :hentrada,
                numero_vuelo_entrada = :vuelo_entrada,
                origen_vuelo_entrada = :origen_vuelo,
                fecha_vuelo_salida = :fsalida,
                hora_vuelo_salida = :hsalida,
                hora_recogida = :hrecogida,
                fecha_modificacion = NOW()
                WHERE id_reserva = :id_reserva";
    $stmt = $db->prepare($sql);

    try {
      $stmt->execute([
        ':hotel' => $data['id_hotel'],
        ':vehiculo' => $data['id_vehiculo'],
        ':viajeros' => $data['num_viajeros'],
        ':fentrada' => $data['fecha_entrada'],
        ':hentrada' => $data['hora_entrada'],
        ':vuelo_entrada' => $data['numero_vuelo_entrada'],
        ':origen_vuelo' => $data['origen_vuelo_entrada'] ?? null,
        ':fsalida' => $data['fecha_vuelo_salida'],
        ':hsalida' => $data['hora_vuelo_salida'],
        ':hrecogida' => $data['hora_recogida'],
        ':id_reserva' => $data['id_reserva']
      ]);
      return true;
    } catch (\PDOException $e) {
      return "Error al actualizar reserva: " . $e->getMessage();
    }
  }

  public static function deleteById($id)
  {
    $db = Database::getConnection();
    try {
      $stmt = $db->prepare("DELETE FROM transfer_reservas WHERE id_reserva = ?");
      $stmt->execute([$id]);
      return true;
    } catch (\PDOException $e) {
      return "Error al eliminar la reserva: " . $e->getMessage();
    }
  }

  public static function findForDetail($id, $email, $esAdmin)
  {
    $db = Database::getConnection();
    // Filtrar por email si no es admin
    $condicion = $esAdmin ? "" : "AND r.email_cliente = :email";
    $sql = "SELECT r.*,
                v.Descripción as vehiculo,
                h.usuario as hotel
                FROM transfer_reservas r
                JOIN transfer_vehiculo v ON r.id_vehiculo = v.id_vehiculo
                LEFT JOIN tranfer_hotel h ON r.id_hotel = h.id_hotel
                WHERE r.id_reserva = :id $condicion";
    $stmt = $db->prepare($sql);
    $params = [':id' => $id];
    if (!$esAdmin)
      $params[':email'] = $email;
    $stmt->execute($params);

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function findInRange($vista, $fecha)
  {
    // tu lógica de calculo de rangos
    $db = Database::getConnection();

    $inicio = new \DateTime($fecha);
    $fin = clone $inicio;

    switch ($vista) {
      case 'dia':
        // $inicio se mantiene igual
        $fin->modify('+1 day');
        break;
      case 'semana':
        $inicio->modify('monday this week');
        $fin->modify('sunday this week');
        break;
      default: // mes
        $inicio->modify('first day of this month');
        $fin->modify('last day of this month');
        break;
    }

    $sql = "SELECT r.*,
                       h.usuario as hotel_nombre,
                       v.Descripción as vehiculo_descripcion,
                       tr.Descripción as tipo_reserva_descripcion
                FROM transfer_reservas r
                LEFT JOIN tranfer_hotel h ON r.id_hotel = h.id_hotel
                LEFT JOIN transfer_vehiculo v ON r.id_vehiculo = v.id_vehiculo
                LEFT JOIN transfer_tipo_reserva tr ON r.id_tipo_reserva = tr.id_tipo_reserva
                WHERE (fecha_entrada BETWEEN :inicio AND :fin)
                   OR (fecha_vuelo_salida BETWEEN :inicio AND :fin)
                ORDER BY fecha_entrada, hora_entrada, fecha_vuelo_salida, hora_vuelo_salida";

    $stmt = $db->prepare($sql);
    $stmt->execute([
      ':inicio' => $inicio->format('Y-m-d'),
      ':fin' => $fin->format('Y-m-d'),
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  private static function generarLocalizador()
  {
    $db = Database::getConnection();
    do {
      $loc = strtoupper(substr(uniqid(), -8));
      $stmt = $db->prepare("SELECT COUNT(*) FROM transfer_reservas WHERE localizador = ?");
      $stmt->execute([$loc]);
    } while ($stmt->fetchColumn() > 0);
    return $loc;
  }

  // Para estadísticas
  public static function countAll()
  {
    $db = Database::getConnection();
    return $db->query("SELECT COUNT(*) FROM transfer_reservas")->fetchColumn();
  }

  public static function countToday()
  {
    $db = Database::getConnection();
    return $db->query("SELECT COUNT(*) FROM transfer_reservas WHERE DATE(fecha_reserva) = CURDATE()")->fetchColumn();
  }
}
