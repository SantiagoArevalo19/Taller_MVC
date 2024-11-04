<!-- Ruta: views/createTask.php -->
<h2>Crear Nueva Tarea</h2>
<form action="index.php?action=create" method="POST">
    <label for="title">Título:</label>
    <input type="text" name="title" id="title" required>
    
    <label for="description">Descripción:</label>
    <textarea name="description" id="description" required></textarea>
    
    <label for="responsible">Responsable:</label>
    <input type="text" name="responsible" id="responsible" required>
    
    <label for="priority">Prioridad:</label>
    <select name="priority" id="priority" required>
        <option value="alta">Alta</option>
        <option value="media">Media</option>
        <option value="baja">Baja</option>
    </select>
    
    <label for="estimated_end_date">Fecha Estimada de Finalización:</label>
    <input type="date" name="estimated_end_date" id="estimated_end_date" required>

    <label for="observations">Observaciones:</label>
    <textarea name="observations" id="observations"></textarea>

    <button type="submit">Crear Tarea</button>
</form>
