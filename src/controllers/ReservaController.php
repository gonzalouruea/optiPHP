<?php
namespace Controllers;

use Core\Helpers;
use Models\Reserva;
use Models\Vehiculo;
use Models\Hotel;
use Models\Usuario;

class ReservaController
{
  public function index()
  {
    Helpers::verificarSesionOExit();

    // Si es admin, ve todas; si no, solo sus reservas
    if (!empty($_SESSION['admin'])) {
      $reservas = Reserva::findAll();
    } else {
      $reservas = Reserva::findByEmail($_SESSION['email']);
    }

    require __DIR__ . '/../views/reservas/index.php';
  }

  public function create()
  {
    Helpers::verificarSesionOExit();

    $vehiculos = Vehiculo::findAll();
    $hoteles = Hotel::findAll();
    // Si es admin, podemos elegir el usuario
    $usuarios = (!empty($_SESSION['admin'])) ? Usuario::findAll() : [];

    require __DIR__ . '/../views/reservas/create.php';
  }

  public function store()
  {
    Helpers::verificarSesionOExit();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header("Location: index.php?controller=Reserva&action=create&error=MetodoNoPermitido");
      exit;
    }

    $rolUsuario = (!empty($_SESSION['admin'])) ? 'admin' : 'usuario';

    $data = [
      'tipo_trayecto' => $_POST['tipo_trayecto'] ?? '',
      'num_viajeros' => $_POST['num_viajeros'] ?? '',
      'id_vehiculo' => $_POST['id_vehiculo'] ?? '',
      'id_hotel' => $_POST['id_hotel'] ?? '',
      'fecha_entrada' => $_POST['fecha_entrada'] ?? null,
      'hora_entrada' => $_POST['hora_entrada'] ?? null,
      'numero_vuelo_entrada' => $_POST['numero_vuelo_entrada'] ?? null,
      'fecha_vuelo_salida' => $_POST['fecha_vuelo_salida'] ?? null,
      'hora_vuelo_salida' => $_POST['hora_vuelo_salida'] ?? null,
      'hora_recogida' => $_POST['hora_recogida'] ?? null,
    ];

    // Si admin y eligió usuario en form
    if ($rolUsuario === 'admin' && !empty($_POST['id_viajero'])) {
      $email_cliente = Usuario::findEmailById($_POST['id_viajero']);
      $data['email_cliente'] = $email_cliente ?: $_SESSION['email'];
    } else {
      $data['email_cliente'] = $_SESSION['email'];
    }

    $result = Reserva::crearReserva($data, $rolUsuario);

    if ($result === true) {
      header("Location: index.php?controller=Reserva&action=index&success=ReservaCreada");
      exit;
    } else {
      $error = $result;
      $vehiculos = Vehiculo::findAll();
      $hoteles = Hotel::findAll();
      $usuarios = ($rolUsuario === 'admin') ? Usuario::findAll() : [];
      require __DIR__ . '/../views/reservas/create.php';
    }
  }

  public function edit()
  {
    Helpers::verificarSesionOExit();

    $id = $_GET['id'] ?? null;
    if (!$id) {
      header("Location: index.php?controller=Reserva&action=index&error=NoID");
      exit;
    }

    $reserva = Reserva::findById($id);
    if (!$reserva) {
      header("Location: index.php?controller=Reserva&action=index&error=NoEncontrada");
      exit;
    }

    // Verificar permiso (admin o dueño de la reserva)
    if ($reserva['email_cliente'] !== $_SESSION['email'] && empty($_SESSION['admin'])) {
      header("Location: index.php?controller=Reserva&action=index&error=SinPermiso");
      exit;
    }

    // 48h check si no es admin
    if (empty($_SESSION['admin'])) {
      // Tomamos la fecha/hora que aplique (fecha_entrada o fecha_vuelo_salida)
      $fReserva = null;
      if (!empty($reserva['fecha_entrada'])) {
        $fReserva = strtotime($reserva['fecha_entrada'] . ' ' . $reserva['hora_entrada']);
      } elseif (!empty($reserva['fecha_vuelo_salida'])) {
        $fReserva = strtotime($reserva['fecha_vuelo_salida'] . ' ' . $reserva['hora_vuelo_salida']);
      }
      if ($fReserva && ($fReserva - time() < 48 * 3600)) {
        header("Location: index.php?controller=Reserva&action=index&error=NoSePuedeModificarMenos48h");
        exit;
      }
    }

    $vehiculos = Vehiculo::findAll();
    $hoteles = Hotel::findAll();

    require __DIR__ . '/../views/reservas/edit.php';
  }

  public function update()
  {
    Helpers::verificarSesionOExit();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header("Location: index.php?controller=Reserva&action=index&error=MetodoNoPermitido");
      exit;
    }

    $id = $_GET['id'] ?? null;
    $reserva = Reserva::findById($id);
    if (!$reserva) {
      header("Location: index.php?controller=Reserva&action=index&error=NoEncontrada");
      exit;
    }

    // Permisos
    if ($reserva['email_cliente'] !== $_SESSION['email'] && empty($_SESSION['admin'])) {
      header("Location: index.php?controller=Reserva&action=index&error=SinPermiso");
      exit;
    }

    $rolUsuario = (!empty($_SESSION['admin'])) ? 'admin' : 'usuario';

    $data = [
      'id_reserva' => $id,
      'id_hotel' => $_POST['id_hotel'] ?? $reserva['id_hotel'],
      'id_vehiculo' => $_POST['id_vehiculo'] ?? $reserva['id_vehiculo'],
      'num_viajeros' => $_POST['num_viajeros'] ?? $reserva['num_viajeros'],
      'fecha_entrada' => $_POST['fecha_entrada'] ?? $reserva['fecha_entrada'],
      'hora_entrada' => $_POST['hora_entrada'] ?? $reserva['hora_entrada'],
      'numero_vuelo_entrada' => $_POST['numero_vuelo_entrada'] ?? $reserva['numero_vuelo_entrada'],
      'origen_vuelo_entrada' => $_POST['origen_vuelo_entrada'] ?? $reserva['origen_vuelo_entrada'],
      'fecha_vuelo_salida' => $_POST['fecha_vuelo_salida'] ?? $reserva['fecha_vuelo_salida'],
      'hora_vuelo_salida' => $_POST['hora_vuelo_salida'] ?? $reserva['hora_vuelo_salida'],
      'hora_recogida' => $_POST['hora_recogida'] ?? $reserva['hora_recogida'],
    ];

    $result = Reserva::updateReserva($data, $reserva, $rolUsuario);
    if ($result === true) {
      header("Location: index.php?controller=Reserva&action=index&success=ReservaActualizada");
      exit;
    } else {
      $error = $result;
      $vehiculos = Vehiculo::findAll();
      $hoteles = Hotel::findAll();
      require __DIR__ . '/../views/reservas/edit.php';
    }
  }

  public function delete()
  {
    Helpers::verificarSesionOExit();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header("Location: index.php?controller=Reserva&action=index");
      exit;
    }

    $id = $_GET['id'] ?? null;
    $reserva = Reserva::findById($id);
    if (!$reserva) {
      header("Location: index.php?controller=Reserva&action=index&error=NoEncontrada");
      exit;
    }

    // Permisos
    if ($reserva['email_cliente'] !== $_SESSION['email'] && empty($_SESSION['admin'])) {
      header("Location: index.php?controller=Reserva&action=index&error=SinPermiso");
      exit;
    }

    $ok = Reserva::deleteById($id);
    if ($ok === true) {
      header("Location: index.php?controller=Reserva&action=index&success=ReservaEliminada");
    } else {
      header("Location: index.php?controller=Reserva&action=index&error=$ok");
    }
  }

  public function detalle()
  {
    Helpers::verificarSesionOExit();

    $id = $_GET['id'] ?? null;
    if (!$id) {
      header("Location: index.php?controller=Reserva&action=index");
      exit;
    }

    $reserva = Reserva::findForDetail($id, $_SESSION['email'], !empty($_SESSION['admin']));
    if (!$reserva) {
      header("Location: index.php?controller=Reserva&action=index&error=NoEncontrada");
      exit;
    }

    require __DIR__ . '/../views/reservas/detalle.php';
  }

  public function calendario()
  {
    Helpers::verificarSesionOExit();

    // Podrías recibir ?vista=dia|semana|mes
    $vista = $_GET['vista'] ?? 'mes';
    $fecha = $_GET['fecha'] ?? date('Y-m-d');

    // El modelo maneja la lógica de filtrar
    $reservas = Reserva::findInRange($vista, $fecha);

    require __DIR__ . '/../views/reservas/calendario.php';
  }
}
