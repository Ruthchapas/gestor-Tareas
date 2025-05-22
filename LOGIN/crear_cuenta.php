<?php
session_start();
require_once 'pdo_bind_connexion.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once '../etiquetas_meta.php'; ?>
    <link rel="stylesheet" href="CSS2/login.css">
    <title>Crea tu usuario</title>
</head>
<body>
    <header class="enlace">
          <a href="../inicio.php"><h1 >minimaList</h1></a>
    </header>
    <main class="index-main">
        <form action="insert_user.php" method="post">
            <fieldset>
                    <h1>Crear cuenta</h1>
                <div>
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" id="nombre">
                </div>
                 <div>
                    <label for="apellidos">Apellidos: </label>
                    <input type="text" name="apellidos" id="apellidos">
                </div>
                 <div>
                    <label for="usuario">Nombre de usuario/a: </label>
                    <input type="text" name="usuario" id="usuario">
                </div>
                <div>
                    <label for="password">Contraseña: </label>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <label for="password2">Repite la contraseña: </label>
                    <input type="password" name="password2" id="password2">
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email">
                </div>
                <div>
                    <label for="telefono">Teléfono: </label>
                    <input type="text" name="telefono" id="telefono">
                </div>
                <div class="error_cuenta">
                    <?php if ($_SESSION['error_cuenta']): ?>
                        <p>Error en los datos</p>
                        <?php endif; ?>
                </div>
                <div class="user_repe">
                    <?php if ($_SESSION['user_repe']): ?>
                        <p>Usuario o contraseña incorrectos</p>
                        <?php endif; ?>
                </div>
                <div class="botones">
                    <button type="submit">Enviar datos</button>
                    <button type="reset">Borrar</button>
                </div>
                <a href="index_user.php">Volver</a>

            </fieldset>
            
        </form>
    </main>
</body>
</html>

<?php
//definir eror
$_SESSION['error_cuenta'] = false;
$_SESSION['user_repe'] = false;