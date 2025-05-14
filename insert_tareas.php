<?php
require_once "connexion.php";
session_start();
$id_usuario = $_SESSION['id_usuario'];

if (
    !isset($_POST['session-token']) ||
    $_POST['session-token'] !== $_SESSION['session-token'] ||
    !empty($_POST['web']) 
) {
    die("Petición rechazada por seguridad.");
}


if ($_POST) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado']; 
    $fecha_inicio =  $_POST['fecha_inicio'];
    $fecha_finalizacion = $_POST['fecha_finalizacion'];    

    $insert = "INSERT INTO tareas (titulo, descripcion, estado, fecha_inicio, fecha_finalizacion, id_usuario) 
           VALUES (?, ?, ?, ?, ?, ?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$titulo, $descripcion, $estado, $fecha_inicio, $fecha_finalizacion, $id_usuario]);


    $insert_prepare = null;
    $conn = null;

    header('location: index_gestor.php');
}
