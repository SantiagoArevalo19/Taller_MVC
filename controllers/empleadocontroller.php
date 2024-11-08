<?php
namespace App\controllers;
use App\models\entities\Empleado;

class EmpleadoController {
    
    function Empleado() {
        return Empleado::find(); 
    }
}