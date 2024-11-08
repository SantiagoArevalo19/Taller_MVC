<?php
require '../controllers/tareascontroller.php';
require '../controllers/prioridadcontroller.php';
require '../controllers/estadocontroller.php';
require '../controllers/empleadocontroller.php';

require '../models/db/tareasDb.php';
require '../models/entities/tarea.php';
require '../models/entities/prioridad.php';
require '../models/entities/estado.php';
require '../models/entities/empleado.php';
require '../models/queries/tareasQueries.php';
require '../models/queries/prioridadQueries.php';
require '../models/queries/estadoQueries.php';
require '../models/queries/empleadoQueries.php';

require '../views/tareasView.php';
require '../views/prioridadesView.php';
require '../views/estadosView.php';
require '../views/empleadosView.php';




use App\views\TareasViews;

$tareasViews = new TareasViews();
$title = empty($_GET['cod'])?'Registrar Tarea':'Modificar Tarea';
$form = $tareasViews->getFormTarea($_GET);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario tareas</title>
    <link rel="stylesheet" href="css/inicio.css">
</head>

<body>
    <header>
        <h1><?php echo $title;?></h1>
    </header>
    <section>
        <?php echo $form;?>
    </section>
</body>

</html>