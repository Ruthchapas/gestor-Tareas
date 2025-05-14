<?php
session_start();
require_once 'pdo_bind_connexion.php';

// Verificar lo que llega a login.php
    $verificarUsuario = isset($_POST ['usuario']) && $_POST ['usuario'];
    $verificarPassword = isset($_POST ['password']) && $_POST ['password'];


    if (!$verificarUsuario || !$verificarPassword ) {
        $_SESSION['error_cuenta'] = true;
        // echo "Contraseñas no coinciden";
        header ('Location: crear_cuenta.php');
        exit();
    }
    //quitar espacios en blanco
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);



    // Verificar que no hay nada vacío

    if (empty($usuario) || empty($password)) {
        $_SESSION['error_cuenta'] = true;
        //  echo "Contraseñas no coinciden";
        header ('Location: crear_cuenta.php');
        exit();
    }

    echo "de momento, todo OK <br>";

    // para evitar que meta código

    $usuario = htmlentities($usuario, ENT_QUOTES, 'UTF-8');
    $password = htmlentities($password, ENT_QUOTES, 'UTF-8');

// Verificar si usuario existe
$select = "SELECT * FROM usuarios WHERE usuario = :usuario";
$stmt = $pdo -> prepare($select);
$stmt -> bindParam(':usuario', $usuario, PDO:: PARAM_STR);
$stmt -> execute();
$usuarioExistente = $stmt -> fetch(PDO::FETCH_ASSOC);
    // si ya existe:
    if (!$usuarioExistente) {
        $_SESSION['user_inexistente'] = true;
        //  echo "Usuario inexistente";
        header ('Location: index_user.php');
        exit();
    }
// verificar contraseña
if (!password_verify($password, $usuarioExistente['password'])) {
    $_SESSION['user_inexistente'] = true;
    //  echo "Contraseña incorrecta";
    header ('Location: index_user.php');
    exit();
}

echo "Todo OK";
$_SESSION['usuario'] = $usuarioExistente['usuario'];
$_SESSION['id_usuario'] = $usuarioExistente['id_usuario'];


header('Location: ../index_gestor.php');



