<?php
namespace App\models\entities;

use App\models\db\TareasDb;
use App\models\queries\PrioridadQueries;

class Prioridad {
private $id;
private $nombre;

function set($prop, $value) {
    $this->{$prop} = $value;
}

function get($prop) {
    return $this->{$prop};
}

static function find() {
    $sql = PrioridadQueries::prioridad();
    $db = new TareasDb();
    $result = $db->query($sql);
    $prioridades = [];
    while ($row = $result->fetch_assoc()) {
        $prioridad = new Prioridad();
        $prioridad->set('id', $row['id']);
        $prioridad->set('nombre', $row['nombre']);
        array_push($prioridades, $prioridad);

    }
    $db->close();
    return $prioridades;
}

}