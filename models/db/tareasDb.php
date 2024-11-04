<?php
// Ruta: models/db/tareasDb.php

namespace App\models\db;

use mysqli;
use Exception;

class Connection
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'tareas_db';
    private $conex;

    private static $instance = null;

    private function __construct()
    {
        $this->conex = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conex->connect_error) {
            throw new Exception("Error de conexión: " . $this->conex->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conex;
    }

    public function close()
    {
        $this->conex->close();
        self::$instance = null;
    }
}
