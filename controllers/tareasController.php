<?php
require_once 'models/entities/Tarea.php';

class TareasController {
    private $tareas = []; // Simulación de base de datos

    // Crear una nueva tarea
    public function crearTarea($titulo, $descripcion, $responsable, $prioridad) {
        $tarea = new Tarea($titulo, $descripcion, $responsable, $prioridad);
        $this->tareas[] = $tarea;
        return $tarea;
    }

    // Listar todas las tareas
    public function listarTareas() {
        return $this->tareas;
    }
   
}
?>
