<?php
session_start();
require_once 'pdo_bind_connexion.php';

// print_r($_POST);

// VALIDACIONES
// Verificar lo que llega a insert_user.php (en caso que intente acceder sin hacer login)
    $verificarUsuario = isset($_POST ['usuario']) && $_POST ['usuario'];
    $verificarPassword = isset($_POST ['password']) && $_POST ['password'];
    $verificarPassword2 = isset($_POST ['password2']) && $_POST ['password2'];

    if (!$verificarUsuario || !$verificarPassword || !$verificarPassword2) {
        $_SESSION['error_cuenta'] = true;
        header ('Location: index_user.php');
        exit();
    }
    // Limpiar y escapar datos
$usuario = htmlentities(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
$password = trim($_POST['password']);

    //quitar espacios en blanco
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);


    // Verificar que no hay nada vacío

    if (empty($usuario) || empty($password) || empty($password2)) {
        $_SESSION['error_cuenta'] = true;
        header ('Location: crear_cuenta.php');
        exit();
    }

    echo "de momento, todo OK <br>";

    // para evitar que meta código

    $nombre = htmlentities($nombre, ENT_QUOTES, 'UTF-8');
    $apellidos = htmlentities($apellidos, ENT_QUOTES, 'UTF-8');
    $usuario = htmlentities($usuario, ENT_QUOTES, 'UTF-8');
    $password = htmlentities($password, ENT_QUOTES, 'UTF-8');
    $password2 = htmlentities($password2, ENT_QUOTES, 'UTF-8');
    $email = htmlentities($email, ENT_QUOTES, 'UTF-8');
    $telefono = htmlentities($telefono, ENT_QUOTES, 'UTF-8');


// verificar que las dos contraseñas sean iguales
if ($password !== $password2) {
    $_SESSION['error_cuenta'] = true;
        header ('Location: crear_cuenta.php');
        exit();
}
// Verificar si el usuario ya existe
$select = "SELECT * FROM usuarios WHERE usuario = :usuario";
$stmt = $pdo -> prepare($select);
$stmt -> bindParam(':usuario', $usuario, PDO:: PARAM_STR);
$stmt -> execute();
$usuarioExistente = $stmt -> fetch(PDO::FETCH_ASSOC);
    // si ya existe:
    if ($usuarioExistente) {
        $_SESSION['user_repe'] = true;
        header ('Location: crear_cuenta.php');
        exit();
    }else {
        echo "el usuario no existe";
    }

    // echo $usuario;

// Encriptar contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash."<br>";

$insert = "INSERT INTO usuarios (usuario, nombre, apellidos, password, email, telefono) 
           VALUES (:usuario, :nombre, :apellidos, :password, :email, :telefono)";
$stmt = $pdo->prepare($insert);
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
$stmt->bindParam(':password', $hash, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
$stmt->execute();


echo "Usuario insertado correctamente";

header('Location: index.php');