
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
    <link rel="stylesheet" href="css/inicio.css">
    <title>Lista de Tareas de Empleados</title>
    
</head>

<body>
  
    <header>
        <h1>Tareas De Los Empleados</h1>
    </header>
</section>
    <section>
    <form action="#" method="get">  
    </form>
    <br>
    <?php echo $tareasView->getTable($_GET); ?>
    <br>
</section>

<section>
    <form action="#" method="get" id="formTareas">
        <h2>Filtrar tareas</h2>
        <div>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo">
        </div>

        <div>
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion">
        </div>
        <div>
            <label for="personaResponsable">Persona responsable</label>
            <?php echo (new EmpleadosViews())->getSelect(true); ?>
        </div>

        <div>
            <label for="estado">Estado</label>
        </div>

        <div>
            <label for="prioridad">Prioridad</label>
            <?php echo (new PrioridadesViews())->getSelect(true); ?>
        </div>
            <div>
                <label for="fechainicio">Fecha de inicio</label>
                <input type="date" name="fechainicio" id="fechainicio">
            </div>
            <div>
                <label for="fechaFinalizacion">Fecha de fin</label>
                <input type="date" name="fechaFinalizacion" id="fechaFinalizacion">
            </div>
        <div>
            <button type="submit" id="btnFiltrar">Filtrar</button>
        </div>
    </form>
</body>

</html>