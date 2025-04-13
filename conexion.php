
<?php

    //definimos credenciales de ls BBDD
    define('DB_HOST','db');
    define('DB_USER','user');
    define('DB_PASS', 'user_password');
    define('DB_NAME', 'viajes');

    /*$host='db';
    $dbname='viajes';
    $username='user';
    $password='user_password';*/

    //Establecer conexion
    try{
        $db=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        //$db=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);


        $stmt = $db->query('SELECT 1');
        
        if ($stmt) {
            echo "Conexión exitosa";
        } else {
            echo "Hubo un problema con la conexión";
        }


    }
    catch(PDOException $e){
        exit("Error: " .$e->getMessage());
    }




?>