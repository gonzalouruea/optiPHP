<?php
session_start();

// 1) Cargar Database, Helpers
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Helpers.php';

// 2) Cargar Modelos
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Reserva.php';
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/Vehiculo.php';
require_once __DIR__ . '/../models/Zona.php';
require_once __DIR__ . '/../models/TipoReserva.php';

// 3) Cargar Controladores
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/ReservaController.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';

// 4) Procesar la ruta...
$controllerName = $_GET['controller'] ?? 'Home';
$actionName = $_GET['action'] ?? 'index';

// 4) Construir la ruta de archivo
$controllerFile = __DIR__ . "/../controllers/{$controllerName}Controller.php";
$controllerClass = "\\Controllers\\{$controllerName}Controller";

// 5) Verificar que existe el fichero y la clase
if (!file_exists($controllerFile)) {
  http_response_code(404);
  echo "Controlador '{$controllerName}' no encontrado.";
  exit;
}
require_once $controllerFile;

if (!class_exists($controllerClass)) {
  http_response_code(404);
  echo "Clase del controlador '{$controllerClass}' no existe.";
  exit;
}

// 6) Instanciar la clase y llamar acción
$controllerObject = new $controllerClass();

if (!method_exists($controllerObject, $actionName)) {
  http_response_code(404);
  echo "Método o acción '{$actionName}' no encontrada en '$controllerName'.";
  exit;
}

$controllerObject->$actionName();
