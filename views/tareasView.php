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
                $rows .= '   <td>';
                $rows .= '     <a class="boton" href="modificarEmpleado.php?cod=' . $id . '">Reasignar responsable</a>';
                $rows .= '   </td>';
                $estadoNombre = $tareas->get('estado')->get('nombre');
                if ($estadoNombre == "En impedimento") {
                    $rows .= '   <td class="impedimento">'.$estadoNombre.'</td>';
                } else {
                    $rows .= '   <td>'.$estadoNombre.'</td>';
                }
                $rows .= '   <td>';
                $rows .= '     <a class="boton" href="modificarEstado.php?cod=' . $id . '">Estado</a>';
                $rows .= '   </td>';
                $rows .= '<form action="" method="get">';
                $rows .= '</form>';
                $rows .= '   </td>';
                $rows .= '   <td>' . $tareas ->get('prioridad')->get('nombre') . '</td>';
                 $rows .= '   <td>' . $tareas ->get('created_at') . '</td>';
                // $rows .= '   <td>' . $tareas ->get('updated_at') . '</td>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '      <a id=modificar href="formulariosTareas.php?cod=' . $id . '">Modificar</a>';
                $rows .= '   </td>';
                $rows .= '   <td>';
                $rows .= '     <a id=eliminar href="eliminarTarea.php?cod=' . $id . '">Eliminar</a>';
                $rows .= '   </td>';  
                $rows .= '</tr>';
            }
        } else {
            $rows .= '<tr>';
            $rows .= '   <td colspan="3">No hay datos registrados</td>';
            $rows .= '</tr>';
        } 
        $rows .= '        <h1><a id=crear href="formulariosTareas.php">Crear</a></h1>';
        $table = '<table class="tabla">';
        $table .= '  <thead>';
        $table .= '    <tr>'; 
        $table .= '         <th>Título</th>';
        $table .= '         <th>Descripción</th>';
        $table .= '         <th>fecha estimada finalizacion</th>';
        $table .= '         <th>Fecha de finalizacion</th>';
        $table .= '         <th>Creador de la tarea</th>';
        $table .= '         <th>Observaciones</th>';
        $table .= '         <th>Empleado</th>';
        $table .= '         <th>Reasignar Empleado</th>';
        $table .= '         <th>Estado</th>';
        $table .= '         <th>Cambiar Estado</th>';
        $table .= '         <th>Prioridad</th>';
         $table .= '         <th>Fcha de Creación</th>';
        // $table .= '         <th>Actualizado</th>';
       
        $table .= '     </tr>'; 
        $table .= '  </thead>';
        $table .= ' <tbody>';
        $table .=  $rows;  
        $table .= ' </tbody>';
        $table .= '</table>';
        return $table;

    } function getMsgNewTarea($datosFormulario)
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
        $form .= '      <label class="texto">título</label>';
        $form .= '      <input type="text" name="titulo" value="' . $titulo . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="texto">descripción</label>';
        $form .= '      <input type="text" name="descripcion" value="' . $descripcion . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="texto">fechaEstimadaFinalizacion</label>';
        $form .= '      <input type="date" name="fechaEstimadaFinalizacion" value="' . $fechaEstimadaFinalizacion . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="texto">fechaFinalizacion</label>';
        $form .= '      <input type="date" name="fechaFinalizacion" value="' . $fechaFinalizacion . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="texto">creadorTarea</label>';
        $form .= '      <input type="text" name="creadorTarea" value="' . $creadorTarea . '" required>';
        $form .= '  </div>';
        $form .= '  <div>';
        $form .= '      <label class="texto">observaciones</label>';
        $form .= '      <input type="text" name="observaciones" value="' . $observaciones . '" required>';
        $form .= '  </div>';
        $form .= '    <label class="texto">Empleado</label>';
        $form.=(new EmpleadosViews())->getSelect();
        $form.='<br>';
        $form .= '    <label class="textoEjem">Estado</label>';
        $form.=(new EstadosViews())->getSelect();
        $form.='<br>';
        $form .= '    <label class="texto">Prioridad</label>';
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
    function estado($data)
    {
        $form = '<h2>Modificar Estado</h2>';
        $form .= '<form action="confirmarEstado.php" method="post" id="formEstado">';
        if (!empty($data['cod'])) {
            $form .= '<input type="hidden" name="cod" value="' . $data['cod'] . '">';
        }
        $form .= '<br>';
        $form .= '    <div class="campoFormulario">';
        $form .= '        <label class="textoEjem" for="idEstado">Estado</label>';
        $form .= '        <div id="selectEstado" class="campoFormulario">';
        $form .= (new EstadosViews())->getSelect();
        $form .= '        </div>';
        $form .= '    </div>';
        $form .= '<br>';
        $form .= '  <div class="campoFormulario botonFormulario">';
        $form .= '      <button type="submit" class="btnFormulario">Guardar</button>';
        $form .= '  </div>';
        $form .= '</form>';
        return $form;
    }
    function getMsgNewEstado($datosestado)
{
    $datos = [
        "id" => $datosestado['cod'],
        "idEstado" => $datosestado['estado']
    ];
    $confirmarAccion = $this->controller->updateEstado($datos);
    $msg = '<h2>Resultado de la operación</h2>';
    if (isset($datosestado['created_at'])) {
        $datos['created_at'] = $datosestado['created_at'];
    }
    if ($confirmarAccion) {
        $msg .= '<p class="msgExito">Estado modificado correctamente.</p>';
    } else {
        $msg .= '<p class="msgError">No se pudo guardar la información del estado</p>';
    }
    return $msg;
}

function empleado($data)
{
    $form = '<h1>Modificar Empleado</h1>';
    $form .= '<form action="confirmarEmpleado.php" method="post" id="formEmpleado">';
    if (!empty($data['cod'])) {
        $form .= '<input type="hidden" name="cod" value="' . $data['cod'] . '">';
    }
    $form .= '<br>';
    $form .= '    <div class="campoFormulario">';
    $form .= '        <label class="textoEjem" for="idEmpleado">Empleado</label>';
    $form .= '        <div id="selectEmpleado" class="campoFormulario">';
    $form .= (new EmpleadosViews())->getSelect();
    $form .= '        </div>';
    $form .= '    </div>';
    $form .= '<br>';
    $form .= '  <div class="campoFormulario botonFormulario">';
    $form .= '      <button type="submit" class="btnFormulario">Guardar</button>';
    $form .= '  </div>';
    $form .= '</form>';
    return $form;
}

function getMsgNewEmpleado($datosempleado)
{
    $datos = [
        "id" => $datosempleado['cod'],
        "idEmpleado" => $datosempleado['empleado']
    ];
    $confirmarAccion = $this->controller->updateEmpleado($datos);
    $msg = '<h2>Resultado de la operación</h2>';
    if (isset($datosempleado['created_at'])) {
        $datos['created_at'] = $datosempleado['created_at'];
    }
    if ($confirmarAccion) {
        $msg .= '<p class="msgExito">Empleado modificado correctamente.</p>';
    } else {
        $msg .= '<p class="msgError">No se pudo guardar la información del empleado</p>';
    }
    return $msg;
}

}