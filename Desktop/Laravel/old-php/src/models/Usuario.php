<?php
namespace Models;

use Core\Database;
use PDO;

class Usuario
{
  public static function findByEmail($email)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function create($data)
  {
    // Verificar si ya existe un usuario con este email
    $existeEmail = self::findByEmail($data['email']);
    if ($existeEmail) {
      return "Error: Ya existe un usuario registrado con el email " . $data['email'];
    }
    
    $db = Database::getConnection();
    $sql = "INSERT INTO transfer_viajeros
                (nombre, apellido1, apellido2, direccion, codigoPostal,
                 ciudad, pais, email, password, rol)
            VALUES
                (:nombre, :apellido1, :apellido2, :direccion, :cp,
                 :ciudad, :pais, :email, :password, :rol)";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':rol', $data['rol'] ?? 'usuario');
    $stmt->bindValue(':nombre', $data['nombre']);
    $stmt->bindValue(':apellido1', $data['apellido1']);
    $stmt->bindValue(':apellido2', $data['apellido2']);
    $stmt->bindValue(':direccion', $data['direccion']);
    $stmt->bindValue(':cp', $data['codPostal']);
    $stmt->bindValue(':ciudad', $data['ciudad']);
    $stmt->bindValue(':pais', $data['pais']);
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT));

    try {
      $stmt->execute();
      return true;
    } catch (\PDOException $e) {
      if ($e->getCode() == 23000) {
        return "El email ya está registrado";
      }
      return "Error al crear usuario: " . $e->getMessage();
    }
  }

  public static function findAll()
  {
    $db = Database::getConnection();
    return $db->query("SELECT * FROM transfer_viajeros ORDER BY email")->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function findEmailById($id_viajero)
  {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT email FROM transfer_viajeros WHERE id_viajero = ?");
    $stmt->execute([$id_viajero]);
    return $stmt->fetchColumn();
  }

  public static function updateAllData($oldEmail, $fields)
  {
    $db = Database::getConnection();
    $usuario = self::findByEmail($oldEmail);
    if (!$usuario) {
      return "El usuario no existe";
    }

    $nombre = $fields['nombre'] ?: $usuario['nombre'];
    $apellido1 = $fields['apellido1'] ?: $usuario['apellido1'];
    $apellido2 = $fields['apellido2'] ?: $usuario['apellido2'];
    $email = $fields['email'] ?: $oldEmail;

    if (!empty($fields['password'])) {
      $password = password_hash($fields['password'], PASSWORD_BCRYPT);
    } else {
      $password = $usuario['password']; // Sin cambios
    }

    // Actualizar
    $sql = "UPDATE transfer_viajeros
                SET nombre = :nombre, 
                email = :nuevoEmail, 
                password = :pass,
                apellido1 = :apellido1,
                apellido2 = :apellido2
                WHERE email = :oldEmail";

    $stmt = $db->prepare($sql);
    $stmt->execute([
      ':nombre' => $nombre,
      ':apellido1' => $apellido1,
      ':apellido2' => $apellido2,
      ':nuevoEmail' => $email,
      ':pass' => $password,
      ':oldEmail' => $oldEmail
    ]);
    return true;
  }

  public static function countStandardUsers()
  {
    $db = Database::getConnection();
    $stmt = $db->query("SELECT COUNT(*) FROM transfer_viajeros WHERE rol = 'usuario'");
    return $stmt->fetchColumn();
  }
}
