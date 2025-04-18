<?php
namespace Controllers;

use Core\Helpers;
use Models\Reserva;
use Models\Vehiculo;
use Models\Hotel;
use Models\Usuario;
use Models\Zona;
use Models\TipoReserva;

class AdminController
{
  public function panel()
  {
    Helpers::verificarRolAdminOExit();

    // Cargamos estadísticas simples
    $stats = [
      'reservas_totales' => Reserva::countAll(),
      'reservas_hoy' => Reserva::countToday(),
      'hoteles' => Hotel::countAll(),
      'vehiculos' => Vehiculo::countAll(),
      'usuarios' => Usuario::countStandardUsers(),
    ];

    require __DIR__ . '/../views/admin/panel.php';
  }

  public function menu()
  {
    Helpers::verificarRolAdminOExit();
    require __DIR__ . '/../views/admin/menu.php';
  }

  // Gestionar hoteles
  public function gestionarHoteles()
  {
    Helpers::verificarRolAdminOExit();

    // Operaciones create/update/delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Lógica similar a la original
      $action = $_POST['action'] ?? '';
      if ($action === 'create') {
        $ok = Hotel::create($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarHoteles&success=Hotel creado");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'update') {
        $ok = Hotel::update($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarHoteles&success=Hotel actualizado");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'delete') {
        $ok = Hotel::delete($_POST['id_hotel']);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarHoteles&success=Hotel eliminado");
          exit;
        } else {
          $error = $ok;
        }
      }
    }

    $hoteles = Hotel::findAll();
    $zonas = Zona::findAll();

    require __DIR__ . '/../views/admin/gestionar_hoteles.php';
  }

  public function gestionarVehiculos()
  {
    Helpers::verificarRolAdminOExit();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $action = $_POST['action'] ?? '';
      if ($action === 'create') {
        $ok = Vehiculo::create($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarVehiculos&success=Vehículo creado");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'update') {
        $ok = Vehiculo::update($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarVehiculos&success=Vehículo actualizado");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'delete') {
        $ok = Vehiculo::delete($_POST['id_vehiculo']);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarVehiculos&success=Vehículo eliminado");
          exit;
        } else {
          $error = $ok;
        }
      }
    }

    $vehiculos = Vehiculo::findAll();
    require __DIR__ . '/../views/admin/gestionar_vehiculos.php';
  }

  public function gestionarZonas()
  {
    Helpers::verificarRolAdminOExit();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $action = $_POST['action'] ?? '';
      if ($action === 'create') {
        $ok = Zona::create($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarZonas&success=Zona creada");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'update') {
        $ok = Zona::update($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarZonas&success=Zona actualizada");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'delete') {
        $ok = Zona::delete($_POST['id_zona']);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarZonas&success=Zona eliminada");
          exit;
        } else {
          $error = $ok;
        }
      }
    }

    $zonas = Zona::findAll();
    require __DIR__ . '/../views/admin/gestionar_zonas.php';
  }

  public function gestionarTipos()
  {
    Helpers::verificarRolAdminOExit();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $action = $_POST['action'] ?? '';
      if ($action === 'create') {
        $ok = TipoReserva::create($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarTipos&success=Tipo de reserva creado");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'update') {
        $ok = TipoReserva::update($_POST);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarTipos&success=Tipo de reserva actualizado");
          exit;
        } else {
          $error = $ok;
        }
      } elseif ($action === 'delete') {
        $ok = TipoReserva::delete($_POST['id_tipo_reserva']);
        if ($ok === true) {
          header("Location: index.php?controller=Admin&action=gestionarTipos&success=Tipo de reserva eliminado");
          exit;
        } else {
          $error = $ok;
        }
      }
    }

    $tipos = TipoReserva::findAllWithCount();
    require __DIR__ . '/../views/admin/gestionar_tipos.php';
  }
}
