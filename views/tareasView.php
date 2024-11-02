<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
</head>
<body>
    <h1>Gestión de Tareas</h1>
    <form method="POST" action="index.php?action=crear">
        <input type="text" name="titulo" placeholder="Título de la tarea" required>
        <input type="text" name="descripcion" placeholder="Descripción" required>
        <input type="text" name="responsable" placeholder="Responsable" required>
        <select name="prioridad">
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>
        <button type="submit">Crear Tarea</button>
    </form>

    <h2>Listado de Tareas</h2>
    <ul>
        <?php foreach ($tareas as $tarea): ?>
            <li><?php echo $tarea->titulo . " - " . $tarea->prioridad; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
