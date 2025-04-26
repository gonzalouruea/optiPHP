<?php
namespace Controllers;

use Models\Usuario;

class AuthController
{
  public function showLogin()
  {
    require __DIR__ . '/../views/auth/login.php';
  }

  public function login()
  {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
      $error = "Email y contraseña son obligatorios";
      require __DIR__ . '/../views/auth/login.php';
      return;
    }

    $usuario = Usuario::findByEmail($email);
    if ($usuario && password_verify($password, $usuario['password'])) {
      $_SESSION['email'] = $usuario['email'];
      $_SESSION['id_viajero'] = $usuario['id_viajero'];
      $_SESSION['rol'] = $usuario['rol'];
      $_SESSION['admin'] = ($usuario['rol'] == 'admin') ? 1 : 0;


      header("Location: index.php");
      exit;
    } else {
      $error = "Usuario o contraseña incorrectos";
      require __DIR__ . '/../views/auth/login.php';
    }
  }

  public function logout()
  {
    session_destroy();
    header("Location: index.php?controller=Auth&action=showLogin");
    exit;
  }

  public function showRegister()
  {
    require __DIR__ . '/../views/auth/register.php';
  }

  public function register()
  {
    $data = [
      'rol' => $_POST['rol'] ?? 'usuario', // <-- recogemos el rol
      'nombre' => $_POST['nombre'] ?? '',
      'apellido1' => $_POST['apellido1'] ?? '',
      'apellido2' => $_POST['apellido2'] ?? '',
      'email' => $_POST['email'] ?? '',
      'direccion' => $_POST['direccion'] ?? '',
      'codPostal' => $_POST['codPostal'] ?? '',
      'ciudad' => $_POST['ciudad'] ?? '',
      'pais' => $_POST['pais'] ?? '',
      'password' => $_POST['password'] ?? '',
    ];

    // Validar
    foreach ($data as $val) {
      if (empty($val)) {
        $error = "Todos los campos son obligatorios";
        require __DIR__ . '/../views/auth/register.php';
        return;
      }
    }

    // Rol por defecto = usuario
    $resultado = Usuario::create($data);
    if ($resultado === true) {
      $exito = "El usuario ha sido creado con éxito. Ahora inicia sesión.";
    } else {
      // Mensaje de error devuelto por el modelo
      $error = $resultado;
    }
    require __DIR__ . '/../views/auth/register.php';
  }

  public function showCambiarDatos()
  {
    // Aseguramos que está logueado
    if (!isset($_SESSION['email'])) {
      header("Location: index.php?controller=Auth&action=showLogin");
      exit;
    }
    $user = Usuario::findByEmail($_SESSION['email']);

    require __DIR__ . '/../views/auth/cambiar_datos.php';
  }

  public function cambiarDatos()
  {
    // Aseguramos que está logueado
    if (!isset($_SESSION['email'])) {
      header("Location: index.php?controller=Auth&action=showLogin");
      exit;
    }

    $oldEmail = $_SESSION['email'];

    $nombre = $_POST['nombre'] ?? '';
    $apellido1 = $_POST['apellido1'] ?? '';
    $apellido2 = $_POST['apellido2'] ?? '';
    $nuevoEmail = $_POST['email'] ?? $oldEmail;
    $password = $_POST['password'] ?? '';

    $ok = Usuario::updateAllData($oldEmail, [
      'nombre' => $nombre,
      'apellido1' => $apellido1,
      'apellido2' => $apellido2,
      'email' => $nuevoEmail,
      'password' => $password
    ]);

    if ($ok === true) {
      $_SESSION['email'] = $nuevoEmail;
      $exito = "Datos modificados correctamente";
    } else {
      $error = $ok;
    }

    $user = Usuario::findByEmail($_SESSION['email']);
    
    require __DIR__ . '/../views/auth/cambiar_datos.php';
  }
}
