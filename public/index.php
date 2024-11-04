<?php
// Ruta: public/index.php

require '../models/db/tareasDb.php'; // Asegúrate de que esta ruta sea correcta
require '../controllers/TareasController.php'; // Asegúrate de que esta ruta sea correcta

use App\models\db\Connection;
use App\controllers\TareasController;

$connection = new Connection();
$tareasController = new TareasController($connection->getConnection());

$action = isset($_GET['action']) ? $_GET['action'] : 'list'; // Acción por defecto

switch ($action) {
    case 'list':
        $tareasController->listTasks();
        break;
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tareasController->createTask($_POST);
        } else {
            $tareasController->showCreateTaskForm();
        }
        break;
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tareasController->editTask($_POST);
        } else {
            $tareasController->showEditTaskForm($_GET['id']);
        }
        break;
    case 'delete':
        $tareasController->deleteTask($_GET['id']);
        break;
    default:
        $tareasController->listTasks();
        break;
}

$connection->close();
?>
