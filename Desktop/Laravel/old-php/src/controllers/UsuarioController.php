<?php
namespace Controllers;

use Core\Helpers;
use Models\Usuario;

class UsuarioController
{
  public function index()
  {
    Helpers::verificarRolAdminOExit();
    // Ejemplo: Listar todos
    $usuarios = Usuario::findAll();
    echo "<h2>Listado de usuarios</h2>";
    foreach ($usuarios as $u) {
      echo $u['email'] . '<br>';
    }
    // Podrías crear una vista separada
  }
}
