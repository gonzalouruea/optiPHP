<?php
namespace Controllers;

class HomeController
{
  public function index()
  {
    // Mostramos la vista de home
    require __DIR__ . '/../views/home/index.php';
  }
}
