<?php
require_once "connexion.php";

// SELECT
$select = "SELECT * FROM tareas ORDER BY fecha_inicio ASC";
$preparacion = $conn->prepare($select);
$preparacion->execute();
$array_filas = $preparacion->fetchAll();

$select_recuento = "SELECT estado, COUNT(id_tarea) AS total FROM tareas GROUP BY estado";
$preparacion_recuento = $conn->prepare($select_recuento);
$preparacion_recuento->execute();
$recuento = $preparacion_recuento->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Gestor de Tareas</h1>
    </header>
    <div class="marcador-recuento">
    <h4>Recuento</h4>
    <ul>
        <?php foreach ($recuento as $estado): ?>
            <li><strong><?= ucfirst($estado['estado']) ?>:</strong> <?= $estado['total'] ?></li>
        <?php endforeach; ?>
    </ul>
</div>

    <main>
        <section>
            <?php if ($_GET): ?>
                <h2>Edita tu tarea</h2>
                <form action="update_tareas.php" method="post">
                    <fieldset>
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                        <div>
                            <label for="titulo">Título tarea:</label>
                            <input type="text" name="titulo" id="titulo" value="<?= $_GET['titulo'] ?>">
                        </div>
                        <div>
                            <label for="descripcion">Descripción:</label>
                            <input type="text" name="descripcion" id="descripcion" value="<?= $_GET['descripcion'] ?>">
                        </div>
                        <div>
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado"> 
                                <?php 
                                foreach (['urgente', 'pendiente', 'en proceso', 'finalizado'] as $opcion): ?>
                                    <option value="<?= $opcion ?>" <?= ($_GET['estado'] === $opcion) ? 'selected' : '' ?>>
                                        <?= ucfirst($opcion) ?>
                                        <!-- Ucfirst per convertir el primer caràcter de la columna en majúscula -->
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <p>Fecha de inicio</p>
                            <input type="date" name="fecha_inicio" value="<?= $_GET['fecha_inicio'] ?>">
                        </div>
                        <div>
                            <p>Fecha de finalización</p>
                            <input type="date" name="fecha_finalizacion" value="<?= $_GET['fecha_finalizacion'] ?>">
                        </div>

                        <div>
                            <button type="submit">Actualizar</button>
                        </div>
                    </fieldset>
                </form>
            <?php else: ?>
                <h2>Introduce tu tarea</h2>
                <form action="insert_tareas.php" method="post">
                    <fieldset>
                        <div>
                            <label for="titulo">Título tarea:</label>
                            <input type="text" name="titulo" id="titulo">
                        </div>
                        <div>
                            <label for="descripcion">Descripción:</label>
                            <input type="text" name="descripcion" id="descripcion">
                        </div>
                        <div>
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado">
                                <option value="urgente">Urgente</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="finalizado">Finalizado</option>
                            </select>
                        </div>
                        <div>
                            <p>Fecha de inicio</p>
                            <input type="date" name="fecha_inicio" >
                        </div>
                        <div>
                            <p>Fecha de finalización</p>
                            <input type="date" name="fecha_finalizacion" >
                        </div>
                        <div>
                            <button type="submit">Introducir</button>
                            <button type="reset">Limpiar</button>
                        </div>
                    </fieldset>
                </form>
            <?php endif; ?>
        </section>

        <section>
            <h2>Tablero de tareas</h2>
            <div class="tablero">
                <?php 
                $estados = ['urgente', 'pendiente', 'en proceso', 'finalizado'];
                foreach ($estados as $estado): ?>
                    <div class="columna">
                    <h3><?= $estado ?> </h3>
                        <?php foreach ($array_filas as $fila): ?>
                            <?php if ($fila['estado'] === $estado): ?>
                                <details class="tarea <?= str_replace(' ', '_', $fila['estado']) . '_borde ' . str_replace(' ', '_', $fila['estado']) . '_fondo'?>">
                                <!-- str_replace per reemplaçar les aparicions del string buscat amb el string de reemplaçament. Això ho faig per aplicar les classes a cadascún dels estats (urgente_borde, pendiente_borde...) -->
                                    <summary><h4><?= $fila['titulo'] ?></h4> </summary>
                                    <p><?= $fila['descripcion'] ?></p>
                                    <small><?= $fila['fecha'] ?></small>
                                    <p class="fechas">Fecha de inicio: </p>
                                    <small class="fechas"><?= date("d/m/Y", strtotime($fila['fecha_inicio'])) ?></small>

                                    <!-- ho poso en small per fer el tamany més petit i qie estèticament quedi millor. Realment ho podria haver fet per css 
                                     el strtotime per convertir text en data-->
                                    <p class="fechas">Fecha de finalización: </p>
                                    <small class="fechas"><?= date("d/m/Y", strtotime($fila['fecha_finalizacion'])) ?></small>
                                    <div class="items">
                                    <a href="index_gestor.php?id=<?= $fila['id_tarea'] ?>&titulo=<?= ($fila['titulo']) ?>&descripcion=<?= ($fila['descripcion']) ?>&estado=<?= ($fila['estado']) ?>&fecha_inicio=<?= $fila['fecha_inicio'] ?>&fecha_finalizacion=<?= $fila['fecha_finalizacion'] ?>">

                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="delete_tareas.php?id=<?= $fila['id_tarea'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div> 
                                    
                                    <form action="update_tareas.php" method="post">
                                        <input type="hidden" name="id" value="<?= $fila['id_tarea'] ?>">
                                        <div class="actualizacion_estado">
                                            <label for="estado"><small>Cambiar estado:</small></label>
                                            <select class="actualizacion_estado" name="estado" id="estado">
                                                <option value="urgente" <?= ($fila['estado'] === 'urgente') ? 'selected' : '' ?>>Urgente</option>
                                                <option value="pendiente" <?= ($fila['estado'] === 'pendiente') ? 'selected' : '' ?>>Pendiente</option>
                                                <option value="en proceso" <?= ($fila['estado'] === 'en proceso') ? 'selected' : '' ?>>En Proceso</option>
                                                <option value="finalizado" <?= ($fila['estado'] === 'finalizado') ? 'selected' : '' ?>>Finalizado</option>
                                            </select>
                                        </div>
                                        <div >
                                            <button type="submit">Actualizar Estado</button>
                                        </div>
                                        
                                    </form>
                             
                             </details>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
