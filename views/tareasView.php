<?php

namespace App\views;

use App\controllers\TareasController;
use App\views\PrioridadesViews;
use App\views\EstadosViews;
use App\views\EmpleadosViews;



class TareasViews
{

    private $controller;
    function __construct()
    {
        $this->controller = new TareasController();
    }
     function getTable($filtro=null)
    {
        $rows = '';
        $tareas = $this->controller->getAllTareas($filtro);

        
        if (count($tareas ) > 0) {
            foreach ($tareas  as $tareas) {
                $id = $tareas ->get('id');
                $rows .= '<tr>';
                $rows .= '   <td>' . $tareas ->get('titulo') . '</td>';
                $rows .= '   <td>' . $tareas ->get('descripcion') . '</td>';
                $rows .= '   <td>' . $tareas ->get('fechaEstimadaFinalizacion') . '</td>';
                $rows .= '   <td>' . $tareas ->get('fechaFinalizacion') . '</td>';
                $rows .= '   <td>' . $tareas ->get('creadorTarea') . '</td>';
                $rows .= '   <td>' . $tareas ->get('observaciones') . '</td>';
                $rows .= '   <td>' . $tareas ->get('empleado')->get('nombre') . '</td>';


                $estadoNombre = $tareas->get('estado')->get('nombre');
                if ($estadoNombre == "En impedimento") {
                    $rows .= '   <td class="impedimento">';
                } else {
                    $rows .= '   <td>';
                }
                $rows .= '<form action="" method="get">';
                $rows .= '<input type="submit" value="Editar">';
                $rows .= '</form>';
                $rows .= '   </td>';


                $rows .= '   <td>' . $tareas ->get('prioridad')->get('nombre') . '</td>';
                $rows .= '   <td>' . $tareas ->get('created_at') . '</td>';
                $rows .= '   <td>' . $tareas ->get('updated_at') . '</td>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <a href="formulariosTareas.php?cod=' . $id . '">Modificar</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '     <a href="eliminarTarea.php?cod=' . $id . '">Eliminar</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '     <a href=".php?cod=' . $id . '">Reasignar responsable</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '     <a href=".php?cod=' . $id . '">Estado</a>';
                $rows .= '   </td>';
                $rows .= '</tr>';
            }
        } else {
            $rows .= '<tr>';
            $rows .= '   <td colspan="3">No hay datos registrados</td>';
            $rows .= '</tr>';
        }
        $table = '<table class= "tabla">';
        $table .= '  <thead>';
        $table .= '         <th>Título</th>';
        $table .= '         <th>Descripción</th>';
        $table .= '         <th>fechaEstimadaFinalizacion</th>';
        $table .= '         <th>fechaFinalizacion</th>';
        $table .= '         <th>creadorTarea</th>';
        $table .= '         <th>observaciones</th>';
        $table .= '         <th>idEmpleado</th>';
        $table .= '         <th>idEstado</th>';
        $table .= '         <th>idPrioridad</th>';
        $table .= '         <th>created_at </th>';
        $table .= '         <th>updated_at</th>';
        $rows .= '      <th><a href="formulariosTareas.php">Crear</a></th>';
        $table .= '     </tr>';
        $table .= '  </thead>';
        $table .= ' <tbody>';
        $table .=  $rows;
        $table .= ' </tbody>';
        $table .= '</table>';
        return $table;
    }
    function getMsgNewTarea($datosFormulario)
    {
        $datos = [
            "titulo" => $datosFormulario['titulo'],
            "descripcion" => $datosFormulario['descripcion'],
            "fechaEstimadaFinalizacion" => $datosFormulario['fechaEstimadaFinalizacion'],
            "fechaFinalizacion" => $datosFormulario['fechaFinalizacion'],
            "creadorTarea" => $datosFormulario['creadorTarea'],
            "observaciones" => $datosFormulario['observaciones'],
            "idEmpleado" => $datosFormulario['empleado'],
            "idEstado" => $datosFormulario['estado'],
            "idPrioridad" => $datosFormulario['prioridad'],
        ];
        $confirmarAccion = $this->controller->saveTarea($datos);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Datos de la tarea guardados.</p>';
        } else {
            $msg .= '<p>No se pudo guardar la información de la tarea</p>';
        }
        return $msg;
    }
    function getFormTarea($data)
    {
        $datos = null;
        $form = '<form action="confirmarRegistro.php" method="post">';
        if (!empty($data['cod'])) {
            $form .= '<input type="hidden" name="cod" value="' . $data['cod'] . '">';
            $datos = $this->controller->getTarea($data['cod']);
        }
        $titulo = empty($datos) ? '' : $datos->get('titulo');
        $descripcion = empty($datos) ? '' : $datos->get('descripcion');
        $fechaEstimadaFinalizacion = empty($datos) ? '' : $datos->get('fechaEstimadaFinalizacion');
        $fechaFinalizacion = empty($datos) ? '' : $datos->get('fechaFinalizacion');
        $creadorTarea = empty($datos) ? '' : $datos->get('creadorTarea');
        $observaciones = empty($datos) ? '' : $datos->get('observaciones');
        $idEmpleado = empty($datos) ? '' : $datos->get('idEmpleado');
        $idEstado = empty($datos) ? '' : $datos->get('idEstado');
        $idPrioridad = empty($datos) ? '' : $datos->get('idPrioridad');
        date_default_timezone_set('America/Bogota');
        $fecha_actual = date("Y-m-d H:i:s");

      
        $form .= '  <div>';
        $form .= '      <label class="textoEjem">título</label>';
        $form .= '      <input type="text" name="titulo" value="' . $titulo . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="textoEjem">descripción</label>';
        $form .= '      <input type="text" name="descripcion" value="' . $descripcion . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="textoEjem">fechaEstimadaFinalizacion</label>';
        $form .= '      <input type="date" name="fechaEstimadaFinalizacion" value="' . $fechaEstimadaFinalizacion . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="textoEjem">fechaFinalizacion</label>';
        $form .= '      <input type="date" name="fechaFinalizacion" value="' . $fechaFinalizacion . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="textoEjem">creadorTarea</label>';
        $form .= '      <input type="text" name="creadorTarea" value="' . $creadorTarea . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="textoEjem">observaciones</label>';
        $form .= '      <input type="text" name="observaciones" value="' . $observaciones . '" required>';
        $form .= '  </div>';
        $form .= '    <label class="textoEjem">Empleado</label>';
        $form.=(new EmpleadosViews())->getSelect();
        $form.='<br>';
        $form .= '    <label class="textoEjem">Estado</label>';
        $form.=(new EstadosViews())->getSelect();
        $form.='<br>';
        $form .= '    <label class="textoEjem">Prioridad</label>';
        $form.=(new PrioridadesViews())->getSelect();
        $form .= '  <div>';
        $form .= '      <button type="submit">Guardar</button>';
        $form .= '  </div>';
        $form .= '</form>';
        return $form;
    }
    function getMsgUpdateTarea($datosFormulario)
    {
        $datos = [
            'id' => $datosFormulario['cod'],
            "titulo" => $datosFormulario['titulo'],
            "descripcion" => $datosFormulario['descripcion'],
            "fechaEstimadaFinalizacion" => $datosFormulario['fechaEstimadaFinalizacion'],
            "fechaFinalizacion" => $datosFormulario['fechaFinalizacion'],
            "creadorTarea" => $datosFormulario['creadorTarea'],
            "observaciones" => $datosFormulario['observaciones'],
            "idEmpleado" => $datosFormulario['empleado'],
            "idEstado" => $datosFormulario['estado'],
            "idPrioridad" => $datosFormulario['prioridad'],
        ];
        if (isset($datosFormulario['created_at'])) {
            $datos['created_at'] = $datosFormulario['created_at'];
        }
        $confirmarAccion = $this->controller->updateTarea($datos);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Datos de la tarea modificados.</p>';
        } else {
            $msg .= '<p>No se pudo guardar la información de la tarea</p>';
        }
        return $msg;
    }
    function getMsgDeleteTarea($id){
        $confirmarAccion = $this->controller->deleteTarea($id);
        $msg = '<h2>Resultado de la operación</h2>';
        if ($confirmarAccion) {
            $msg .= '<p>Datos de la tarea eliminados.</p>';
        } else {
            $msg .= '<p>No se pudo eliminar la información de la tarea</p>';
        }
        return $msg;
    }
   
}