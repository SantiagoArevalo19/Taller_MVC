
<?php
require '../controllers/tareascontroller.php';
require '../controllers/empleadocontroller.php';
require '../controllers/prioridadcontroller.php';

require '../models/db/tareasDb.php';
require '../models/entities/tarea.php';
require '../models/entities/prioridad.php';
require '../models/entities/estado.php';
require '../models/entities/empleado.php';

require '../models/queries/tareasQueries.php';
require '../models/queries/empleadoQueries.php';

require '../views/tareasView.php';
require '../views/estadosView.php';
require '../views/empleadosView.php';
require '../views/prioridadesView.php';

require '../models/queries/prioridadQueries.php';

use App\views\TareasViews;
use App\views\PrioridadesViews;
use App\views\EmpleadosViews;


$tareasView = new TareasViews();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas de Empleados</title>
    <link rel="stylesheet" href="css/inicio.css">
</head>

<body>
    <header>
        <h1>Tareas De Los Empleados</h1>
    </header>
    <section>
    <form action="#" method="get">
        <br>
       
    </form>
    <br>
    <?php echo $tareasView->getTable($_GET); ?>
    <br>
</section>
</body>

</html>