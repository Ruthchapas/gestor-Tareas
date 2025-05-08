<?php
require_once "connexion.php";

if ($_POST) {
    $id = $_POST['id'];

    // EDITAR
    if (isset($_POST['titulo']) && isset($_POST['descripcion'])) {
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $estado = $_POST['estado'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_finalizacion = $_POST['fecha_finalizacion'];

        $update = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ?, fecha_inicio = ?, fecha_finalizacion = ? WHERE id_tarea = ?";
        $prepare = $conn->prepare($update);
        $prepare->execute([$titulo, $descripcion, $estado, $fecha_inicio, $fecha_finalizacion, $id]);

    } else {
        // ACTUALITZAR L'ESTAT NOMÉS (el desplegable)
        $estado = $_POST['estado'];

        $update = "UPDATE tareas SET estado = ? WHERE id_tarea = ?";
        $prepare = $conn->prepare($update);
        $prepare->execute([$estado, $id]);
    }


    $prepare = null;
    $conn = null;

    header('location: index_gestor.php');
}
