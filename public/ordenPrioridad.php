<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
date_default_timezone_set('America/Colombia_City');
$fecha_actual=date("Y-m-d  H:i:s");
?>

    <form action="" method="get" accept-charset="utf-8">
        <label >Fecha:<input type="datetime" name="fecha" value="fecha_actual"> </input></label>
    </form>
</body>
</html>