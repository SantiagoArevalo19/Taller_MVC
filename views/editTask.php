<!-- Ruta: views/editTask.php -->
<h2>Editar Tarea</h2>
<form action="index.php?action=edit&id=<?php echo $task->getId(); ?>" method="POST">
    <label for="title">Título:</label>
    <input type="text" name="title" id="title" value="<?php echo $task->getTitle(); ?>" required>
    
    <label for="description">Descripción:</label>
    <textarea name="description" id="description" required><?php echo $task->getDescription(); ?></textarea>

    <label for="status">Estado:</label>
    <select name="status" id="status" required>
        <option value="pendiente" <?php echo $task->getStatus() == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
        <option value="en proceso" <?php echo $task->getStatus() == 'en proceso' ? 'selected' : ''; ?>>En Proceso</option>
        <option value="terminada" <?php echo $task->getStatus() == 'terminada' ? 'selected' : ''; ?>>Terminada</option>
        <option value="impedimento" <?php echo $task->getStatus() == 'impedimento' ? 'selected' : ''; ?>>Impedimento</option>
    </select>
    
    <label for="responsible">Responsable:</label>
    <input type="text" name="responsible" id="responsible" value="<?php echo $task->getResponsible(); ?>" required>

    <label for="priority">Prioridad:</label>
    <select name="priority" id="priority" required>
        <option value="alta" <?php echo $task->getPriority() == 'alta' ? 'selected' : ''; ?>>Alta</option>
        <option value="media" <?php echo $task->getPriority() == 'media' ? 'selected' : ''; ?>>Media</option>
        <option value="baja" <?php echo $task->getPriority() == 'baja' ? 'selected' : ''; ?>>Baja</option>
    </select>

    <label for="estimated_end_date">Fecha Estimada de Finalización:</label>
    <input type="date" name="estimated_end_date" id="estimated_end_date" value="<?php echo $task->getEstimatedEndDate(); ?>" required>

    <label for="end_date">Fecha de Finalización:</label>
    <input type="date" name="end_date" id="end_date" value="<?php echo $task->getEndDate(); ?>">

    <label for="observations">Observaciones:</label>
    <textarea name="observations" id="observations"><?php echo $task->getObservations(); ?></textarea>

    <button type="submit">Guardar Cambios</button>
</form>
