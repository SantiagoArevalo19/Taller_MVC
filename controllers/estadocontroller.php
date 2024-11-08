<?php
namespace App\controllers;
use App\models\entities\Estado;

class EstadoController {
    
    function Estado() {
        return Estado::find(); 
    }
}