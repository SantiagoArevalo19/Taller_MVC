<?php
require_once 'controllers/TareasController.php';

$controller = new TareasController();


$action = $_GET['action'] ?? null;

if ($action == 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $responsable = $_POST['responsable'];
    $prioridad = $_POST['prioridad'];
    $controller->crearTarea($titulo, $descripcion, $responsable, $prioridad);
}

$tareas = $controller->listarTareas();
include 'views/tareasView.php';
?>
