<?php

namespace App\views;

use App\controllers\EstadoController;




class EstadosViews
{
    public function getSelect() {
        $select = '<select name="estado">';
        $estadoController = new EstadoController();
        $estados = $estadoController->estado();
        
        foreach ($estados as $estado) {
            $id = $estado->get('id');
            $nombre = $estado->get('nombre');
            if ($nombre == "En impedimento") {
                $select .= "<option value=\"$id\" class=\"impedimento\">$nombre</option>";
            } else {
                $select .= "<option value=\"$id\">$nombre</option>";
            }
        }
        
        $select .= '</select>';
        return $select;
    }


}
