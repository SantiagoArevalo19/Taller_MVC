<?php
// Ruta: controllers/TaskController.php

namespace App\controllers;

use App\models\queries\TaskQueries;
use App\models\entities\Task;

class TaskController
{
    private $taskQueries;

    public function __construct()
    {
        $this->taskQueries = new TaskQueries();
    }

    // Método para crear una nueva tarea
    public function createTask($data)
    {
        $task = new Task(
            $data['title'],
            $data['description'],
            $data['creator'],
            $data['responsible'],
            $data['priority']
        );
        $task->setStatus('pendiente');  // Estado inicial
        $task->setCreationDate(date('Y-m-d'));  // Fecha de creación
        $task->setEstimatedEndDate($data['estimated_end_date']);
        $task->setObservations($data['observations'] ?? '');

        return $this->taskQueries->createTask($task);
    }

    // Método para obtener todas las tareas
    public function getAllTasks()
    {
        return $this->taskQueries->getAllTasks();
    }

    // Método para obtener una tarea específica por ID
    public function getTaskById($id)
    {
        return $this->taskQueries->getTaskById($id);
    }

    // Método para actualizar una tarea existente
    public function updateTask($id, $data)
    {
        $task = $this->taskQueries->getTaskById($id);
        
        if (!$task) {
            return false; // Tarea no encontrada
        }

        // Actualizamos los campos con los datos proporcionados
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task->setStatus($data['status']);
        $task->setEstimatedEndDate($data['estimated_end_date']);
        $task->setEndDate($data['end_date'] ?? null);
        $task->setResponsible($data['responsible']);
        $task->setPriority($data['priority']);
        $task->setObservations($data['observations'] ?? '');

        return $this->taskQueries->updateTask($task);
    }

    // Método para eliminar una tarea
    public function deleteTask($id)
    {
        return $this->taskQueries->deleteTask($id);
    }

    // Método para buscar tareas con filtros
    public function searchTasks($filters)
    {
        return $this->taskQueries->searchTasks($filters);
    }

    // Método para reasignar una tarea a un nuevo responsable
    public function reassignTask($id, $newResponsible)
    {
        $task = $this->taskQueries->getTaskById($id);
        
        if (!$task) {
            return false; // Tarea no encontrada
        }

        $task->setResponsible($newResponsible);
        return $this->taskQueries->updateTask($task);
    }

    // Método para cambiar el estado de una tarea
    public function changeTaskStatus($id, $newStatus)
    {
        $task = $this->taskQueries->getTaskById($id);
        
        if (!$task) {
            return false; // Tarea no encontrada
        }

        $task->setStatus($newStatus);
        return $this->taskQueries->updateTask($task);
    }
}
