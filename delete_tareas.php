<?php
require_once 'connexion.php';


$delete ="DELETE FROM tareas WHERE id_tarea = ?;";
// el interrogante es propio de PDO, preparas como consulta preparada y permite establecer valoredes que puedes refrendar mediante execute para impedir inyección de código.
// ? es como una variable que adoptará el valor que se le ponga en el execute

$delete_prepare = $conn -> prepare($delete);
$delete_prepare -> execute([$_GET['id']]); 

$delete_prepare = null;
$conn = null;

header('location: index_gestor.php');