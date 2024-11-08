<?php
namespace App\controllers;
use App\models\entities\Prioridad;

class PrioridadController {
    
    function Prioridad() {
        return Prioridad::find(); 
    }
    
}