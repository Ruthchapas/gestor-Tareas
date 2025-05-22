<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'pdo_bind_connexion.php';

// Valores por defecto para evitar errores si no están definidos
$_SESSION['error_cuenta'] = $_SESSION['error_cuenta'] ?? false;
$_SESSION['user_inexistente'] = $_SESSION['user_inexistente'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once '../etiquetas_meta.php'; ?>
    <title>MinimaList - Login</title>
    <link rel="stylesheet" href="css2/login.css">
</head>
<body>
    <header class="enlace">
       <a href="../inicio.php"><h1 >minimaList</h1></a>
    </header>

    <main class="index-main">
            <form action="login.php" method="post">
                <fieldset>
                    <h1>Iniciar sesión</h1>
                    <div>
                        <label for="usuario">Nombre de usuario:</label>
                        <input type="text" name="usuario" id="usuario" required>
                    </div>
                    <div>
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div>
                        <a href="crear_cuenta.php">¿No tienes cuenta? Regístrate</a>
                    </div>

                    <?php if ($_SESSION['error_cuenta']): ?>
                        <p class="error_cuenta">Todos los campos son obligatorios.</p>
                    <?php endif; ?>

                    <?php if ($_SESSION['user_inexistente']): ?>
                        <p class="user_repe">Usuario o contraseña incorrectos.</p>
                    <?php endif; ?>

                    <div class="botones">
                        <button type="submit">Enviar datos</button>
                        <button type="reset">Borrar</button>
                    </div>

                </fieldset>
            </form>
    </main>
</body>
</html>

<?php
// Limpiar errores después de mostrarlos
$_SESSION['error_cuenta'] = false;
$_SESSION['user_inexistente'] = false;
?>
