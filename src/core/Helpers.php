<?php
namespace Core;

class Helpers
{
  public static function verificarRolAdminOExit()
  {
    if (empty($_SESSION['admin']) || $_SESSION['admin'] != 1) {
      header("Location: index.php?error=AccesoDenegado");
      exit;
    }
  }

  public static function verificarSesionOExit()
  {
    if (empty($_SESSION['email'])) {
      header("Location: index.php?controller=Auth&action=showLogin");
      exit;
    }
  }
}
