<!-- Ruta: views/listTasks.php -->
<h2>Lista de Tareas</h2>
<a href="index.php?action=create">Crear Nueva Tarea</a>
<table>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Responsable</th>
        <th>Prioridad</th>
        <th>Estado</th>
        <th>Fecha Estimada de Finalización</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($tasks as $task): ?>
    <tr>
        <td><?php echo $task->getId(); ?></td>
        <td><?php echo $task->getTitle(); ?></td>
        <td><?php echo $task->getDescription(); ?></td>
        <td><?php echo $task->getResponsible(); ?></td>
        <td><?php echo ucfirst($task->getPriority()); ?></td>
        <td><?php echo ucfirst($task->getStatus()); ?></td>
        <td><?php echo $task->getEstimatedEndDate(); ?></td>
        <td>
            <a href="index.php?action=edit&id=<?php echo $task->getId(); ?>">Editar</a> |
            <a href="index.php?action=delete&id=<?php echo $task->getId(); ?>" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
