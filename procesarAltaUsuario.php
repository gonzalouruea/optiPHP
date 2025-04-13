<?php 

require_once 'conexion.php';

    //comprueba que el formulario se ha enviado

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre= $_POST['nombre'];
        $apellido1= $_POST['apellido1'];
        $apellido2= $_POST['apellido2'];
        $email= $_POST['email'];
        $direccion= $_POST['direccion'];
        $codPostal= $_POST['codPostal'];
        $ciudad= $_POST['ciudad'];
        $pais= $_POST['pais'];
        $password= $_POST['password'];
        
        
    }

    //comprobamos si todos los campos estan llenos

    if(empty($nombre)|| empty($apellido1) || empty($apellido2) || empty($email) || empty($direccion) || empty($codPostal) || empty($ciudad) || empty($pais) || empty($password)){
        echo "Debes rellenar todos los campos";
    }else{

        //introducimos un nuevo usuario en la base de datos
        try{
            $sql="INSERT INTO transfer_viajeros(nombre, apellido1, apellido2, direccion, codigoPostal, ciudad, pais, email, password)
                    VALUES (:nombre, :apellido1, :apellido2, :direccion, :codigoPostal, :ciudad, :pais, :email, :password)";

             //se prepara la declaracion
             $stmt=$db->prepare($sql);

             $stmt->bindParam(':nombre', $nombre);
             $stmt->bindParam(':apellido1', $apellido1);
             $stmt->bindParam(':apellido2', $apellido2);
             $stmt->bindParam(':direccion', $direccion);
             $stmt->bindParam(':codigoPostal', $codPostal);
             $stmt->bindParam(':ciudad', $ciudad);
             $stmt->bindParam(':pais', $pais);
             $stmt->bindParam(':email', $email);

             //se encripta la contraseña antes de insertarla
             $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashedPassword);

            //se ejecuta la consulta
            $stmt->execute();

            $exito= "El usuario ha sido creado con exito";


        }
        catch(PDOException $e){

            $error= "error al crear el usuario: " .$e->getMessage();
        }
    }

?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">"Isla-Transfers"</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Clientes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Particulares</a></li>
            <li><a class="dropdown-item" href="#">Agencia de viajes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Administrador</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>

<!-- Archivos JavaScript de Bootstrap (incluye Popper.js) -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h2 id="exito" class="alert alert-success">
                <?php echo $exito ?? $error; ?>
            </h2>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>





