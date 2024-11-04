<?php
// Ruta: models/queries/TaskQueries.php

namespace App\models\queries;

use App\models\db\Connection;
use App\models\entities\Task;
use mysqli;

class TaskQueries
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getConnection();
    }

    // Método para crear una tarea
    public function createTask(Task $task)
    {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, creation_date, status, estimated_end_date, creator, responsible, priority, observations) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssssss",
            $task->getTitle(),
            $task->getDescription(),
            $task->getCreationDate(),
            $task->getStatus(),
            $task->getEstimatedEndDate(),
            $task->getCreator(),
            $task->getResponsible(),
            $task->getPriority(),
            $task->getObservations()
        );
        return $stmt->execute();
    }

    // Método para obtener todas las tareas
    public function getAllTasks()
    {
        $query = "SELECT * FROM tasks ORDER BY priority DESC, estimated_end_date ASC";
        $result = $this->db->query($query);
        $tasks = [];

        while ($row = $result->fetch_assoc()) {
            $task = new Task($row['title'], $row['description'], $row['creator'], $row['responsible'], $row['priority']);
            $task->setId($row['id']);
            $task->setCreationDate($row['creation_date']);
            $task->setStatus($row['status']);
            $task->setEstimatedEndDate($row['estimated_end_date']);
            $task->setEndDate($row['end_date']);
            $task->setObservations($row['observations']);
            $tasks[] = $task;
        }

        return $tasks;
    }

    // Método para obtener una tarea por ID
    public function getTaskById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $task = new Task($row['title'], $row['description'], $row['creator'], $row['responsible'], $row['priority']);
            $task->setId($row['id']);
            $task->setCreationDate($row['creation_date']);
            $task->setStatus($row['status']);
            $task->setEstimatedEndDate($row['estimated_end_date']);
            $task->setEndDate($row['end_date']);
            $task->setObservations($row['observations']);
            return $task;
        }

        return null;
    }

    // Método para actualizar una tarea
    public function updateTask(Task $task)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, modification_date = NOW(), estimated_end_date = ?, end_date = ?, responsible = ?, priority = ?, observations = ? WHERE id = ?");
        $stmt->bind_param(
            "ssssssssi",
            $task->getTitle(),
            $task->getDescription(),
            $task->getStatus(),
            $task->getEstimatedEndDate(),
            $task->getEndDate(),
            $task->getResponsible(),
            $task->getPriority(),
            $task->getObservations(),
            $task->getId()
        );
        return $stmt->execute();
    }

    // Método para eliminar una tarea
    public function deleteTask($id)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Método para buscar tareas con filtros
    public function searchTasks($criteria = [])
    {
        $query = "SELECT * FROM tasks WHERE 1=1";
        $params = [];
        $types = "";

        if (!empty($criteria['priority'])) {
            $query .= " AND priority = ?";
            $types .= "s";
            $params[] = $criteria['priority'];
        }

        if (!empty($criteria['responsible'])) {
            $query .= " AND responsible = ?";
            $types .= "s";
            $params[] = $criteria['responsible'];
        }

        if (!empty($criteria['title'])) {
            $query .= " AND title LIKE ?";
            $types .= "s";
            $params[] = "%" . $criteria['title'] . "%";
        }

        if (!empty($criteria['description'])) {
            $query .= " AND description LIKE ?";
            $types .= "s";
            $params[] = "%" . $criteria['description'] . "%";
        }

        if (!empty($criteria['start_date']) && !empty($criteria['end_date'])) {
            $query .= " AND estimated_end_date BETWEEN ? AND ?";
            $types .= "ss";
            $params[] = $criteria['start_date'];
            $params[] = $criteria['end_date'];
        }

        $stmt = $this->db->prepare($query);
        if ($types) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];

        while ($row = $result->fetch_assoc()) {
            $task = new Task($row['title'], $row['description'], $row['creator'], $row['responsible'], $row['priority']);
            $task->setId($row['id']);
            $task->setCreationDate($row['creation_date']);
            $task->setStatus($row['status']);
            $task->setEstimatedEndDate($row['estimated_end_date']);
            $task->setEndDate($row['end_date']);
            $task->setObservations($row['observations']);
            $tasks[] = $task;
        }

        return $tasks;
    }
}
