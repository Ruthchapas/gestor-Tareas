<?php
// Fichero de conexión : pdo_bind_connection.php
$server_name = "127.0.0.1";
$host = 'localhost';
    // BBDD a la que nos vamos a conectar
$dbname ="gestor_tiempo";
    // usuario - en nuestro caso es root pq estamos trabajando con MariaDB, pero normalemnte no se debe usar
$user ="root";
    // puerto de conexión
$port = 3307;
    //PASSWORD- Por defecto en MariaDB no tiene
$password = "CIEF1234";
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
    // echo "Conexión exitosa";
}
catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
    echo "error de conexión:". $e -> getMessage();
    exit();
}