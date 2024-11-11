<?php
require '../controllers/tareascontroller.php';
require '../models/db/tareasDb.php';
require '../models/entities/tarea.php';
require '../models/queries/tareasQueries.php';
require '../views/tareasView.php';

use App\views\TareasViews;

$estadoViews = new TareasViews();
$datosFormulario = [
    'cod' => $_POST['cod'] ?? null,
    'estado' => $_POST['estado'] ?? null
];
$msg = $estadoViews->getMsgNewEstado($datosFormulario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar acción</title>
    <link rel="stylesheet" href="css/inicio.css">

</head>
<body>
    <header>
        <h1 class="estado">Estado de acción</h1>
    </header>
    <section>
        <?php echo $msg; ?>
        <br>
        <a class="botonInicio" href="inicio.php">Volver al inicio</a>
    </section>
</body>
</html>
