<?php
namespace App\models\entities;

use App\models\db\TareasDb;
use App\models\queries\EmpleadoQueries;

class Empleado {
private $id;
private $nombre;

function set($prop, $value) {
    $this->{$prop} = $value;
}

function get($prop) {
    return $this->{$prop};
}

static function find() {
    $sql = EmpleadoQueries::empleado();
    $db = new TareasDb();
    $result = $db->query($sql);
    $empleados = [];
    while ($row = $result->fetch_assoc()) {
        $empleado = new Empleado();
        $empleado->set('id', $row['id']);
        $empleado->set('nombre', $row['nombre']);
        array_push($empleados, $empleado);

    }
    $db->close();
    return $empleados;
}
}