<?php
// Ruta: models/entities/Task.php

namespace App\models\entities;

class Task
{
    private $id;
    private $title;
    private $description;
    private $creationDate;
    private $modificationDate;
    private $status;
    private $estimatedEndDate;
    private $endDate;
    private $creator;
    private $responsible;
    private $priority;
    private $observations;

    public function __construct($title, $description, $creator, $responsible, $priority, $status = 'pendiente')
    {
        $this->title = $title;
        $this->description = $description;
        $this->creator = $creator;
        $this->responsible = $responsible;
        $this->priority = $priority;
        $this->status = $status;
        $this->creationDate = date("Y-m-d H:i:s");
    }

    // Getters y setters para cada propiedad
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getTitle() { return $this->title; }
    public function setTitle($title) { $this->title = $title; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getCreationDate() { return $this->creationDate; }
    public function setCreationDate($creationDate) { $this->creationDate = $creationDate; }

    public function getModificationDate() { return $this->modificationDate; }
    public function setModificationDate($modificationDate) { $this->modificationDate = $modificationDate; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }

    public function getEstimatedEndDate() { return $this->estimatedEndDate; }
    public function setEstimatedEndDate($estimatedEndDate) { $this->estimatedEndDate = $estimatedEndDate; }

    public function getEndDate() { return $this->endDate; }
    public function setEndDate($endDate) { $this->endDate = $endDate; }

    public function getCreator() { return $this->creator; }
    public function setCreator($creator) { $this->creator = $creator; }

    public function getResponsible() { return $this->responsible; }
    public function setResponsible($responsible) { $this->responsible = $responsible; }

    public function getPriority() { return $this->priority; }
    public function setPriority($priority) { $this->priority = $priority; }

    public function getObservations() { return $this->observations; }
    public function setObservations($observations) { $this->observations = $observations; }
}
