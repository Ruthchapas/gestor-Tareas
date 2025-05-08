<?php
require_once "connexion.php";

if ($_POST) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado']; 
    $fecha_inicio =  $_POST['fecha_inicio'];
    $fecha_finalizacion = $_POST['fecha_finalizacion'];    

    $insert = "INSERT INTO tareas(titulo, descripcion, estado, fecha_inicio, fecha_finalizacion) VALUES (?, ?, ?, ?, ?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$titulo, $descripcion, $estado, $fecha_inicio, $fecha_finalizacion]);

    $insert_prepare = null;
    $conn = null;

    header('location: index_gestor.php');
}
