<?php


    // servidor IP
$server_name = "127.0.0.1";
$server_name = "localhost";
    // BBDD a la que nos vamos a conectar
$database ="gestor_tiempo";
    // usuario - en nuestro caso es root pq estamos trabajando con MariaDB, pero normalemnte no se debe usar
$user ="root";
    // puerto de conexión
$port = 3307;
    //PASSWORD- Por defecto en MariaDB no tiene
$password = "CIEF1234";

    try{
        $conn = new PDO("mysql:host=$server_name;port=$port;dbname=$database",$user, $password); 
    } 
    catch (PDOException $err) {
        // Mostrar el error de conexión
        echo "Error $err";

    };

