<?php
class Tarea {
    public $id;
    public $titulo;
    public $descripcion;
    public $fechaCreacion;
    public $fechaModificacion;
    public $estado;
    public $fechaEstimadaFinalizacion;
    public $fechaFinalizacion;
    public $creador;
    public $responsable;
    public $prioridad;
    public $observaciones;

    // Constructor
    public function __construct($titulo, $descripcion, $responsable, $prioridad) {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->responsable = $responsable;
        $this->prioridad = $prioridad;
        $this->fechaCreacion = date("Y-m-d H:i:s");
        $this->estado = "pendiente"; // Estado inicial por defecto
    }
}
?>
