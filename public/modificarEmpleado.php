<?php
require '../controllers/tareascontroller.php';
require '../controllers/empleadocontroller.php';
require '../controllers/prioridadcontroller.php';
require '../controllers/estadocontroller.php';
require '../models/db/tareasDb.php';
require '../models/entities/tarea.php';
require '../models/entities/prioridad.php';
require '../models/entities/estado.php';
require '../models/entities/empleado.php';

require '../models/queries/tareasQueries.php';
require '../models/queries/empleadoQueries.php';
require '../models/queries/estadoQueries.php';


require '../views/tareasView.php';
require '../views/estadosView.php';
require '../views/empleadosView.php';
require '../views/prioridadesView.php';
require '../models/queries/prioridadQueries.php';



use App\views\TareasViews;


$empleadoView = new TareasViews();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <link rel="stylesheet" href="css/inicio.css">

</head>
<body>
    <section>
    <br>
        <?php

        echo $empleadoView->empleado($_GET);
        ?>
        <br>
    </section>
</body>
</html>