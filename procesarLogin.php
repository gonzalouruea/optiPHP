<?php 

/*require_once 'conexion.php';

    //comprueba que el formulario se ha enviado

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre= $_POST['nombre'];
        $email= $_POST['email'];
        
    }

    if(empty($nombre)|| empty($email)){
        die ("Debes rellenar todos los campos");
    }

        //verificamos si existe el usuario en la base de datos
        
        $sql= "SELECT * FROM transfer_viajeros WHERE email=$email ";
        $stmt= $db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result=$stmt->get_result();

        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();
        }

        //Se comprueba la contraseña
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['email'] = $usuario['email'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    
    
    
    $stmt->close();
    $conn->close();
        
        */

        
        ob_start(); // Inicia el buffer de salida
        session_start();
        require 'conexion.php'; // aquí se define $db como instancia de PDO
        
        // Recibir datos del formulario
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Validación básica
        if (empty($email) || empty($password)) {
            die("Email y contraseña son obligatorios.");
        }
        
        // Buscar el usuario en la base de datos con PDO
        $sql = "SELECT email, password FROM transfer_viajeros WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]); // Pasamos el parámetro directamente como array
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario) {
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['email'] = $usuario['email'];
                header("Location: index.php");
                exit;
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
        ?>
        



