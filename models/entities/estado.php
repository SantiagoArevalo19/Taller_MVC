<?php
namespace App\models\entities;

use App\models\db\TareasDb;
use App\models\queries\EstadoQueries;

class Estado {
private $id;
private $nombre;

function set($prop, $value) {
    $this->{$prop} = $value;
}

function get($prop) {
    return $this->{$prop};
}

static function find() {
    $sql = EstadoQueries::estado();
    $db = new TareasDb();
    $result = $db->query($sql);
    $estados = [];
    while ($row = $result->fetch_assoc()) {
        $estado = new Estado();
        $estado->set('id', $row['id']);
        $estado->set('nombre', $row['nombre']);
        array_push($estados, $estado);

    }
    $db->close();
    return $estados;
}

}