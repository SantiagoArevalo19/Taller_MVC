<?php

namespace App\models\queries;

class EstadoQueries
{
    static function estado(){
        return "select * from estados";
    }
    static function whereIdEstado($Id)
    {
        return "select * from tareas where IdEstado=$Id";
    }
    
   
}

