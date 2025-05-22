<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Organización fácil</title>
    <link rel="stylesheet" href="css/inicio.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="titulo">minimaList</h1>
    </header>

    <main>
        <section class="intro">
            <h2>Gestiona tus tareas con claridad y sencillez</h2>
            <p> <strong>minimaList</strong> es una herramienta práctica para que cada usuario pueda planificar y organizar su día sin distracciones.</p>
        </section>

        <section class="caracteristicas">
            <h3>Características principales</h3>
            <ul>
                <li>✔️ Crea y edita tareas según tu prioridad</li>
                <li>✔️ Clasificación por estado: urgente, pendiente, en proceso, finalizado</li>
                <li>✔️ Visualiza tu avance con recuentos automáticos</li>
                <li>✔️ Acceso individualizado con cuenta personal</li>
            </ul>
        </section>

        <section class="cta">
            <p>Empieza ahora y toma el control de tus tareas</p>
            <a href="LOGIN/index_user.php" class="boton grande">Entra a minimaList</a>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> MinimaList - Proyecto de gestión personal.</p>
    </footer>
</body>
</html>
