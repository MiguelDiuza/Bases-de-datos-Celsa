
<?php
// Inicializa la variable $datos como un array vacío
$datos = array();

// ... Código para llenar el array $datos ...

// Verifica si $datos es un array antes de usarlo en el foreach
if (is_array($datos)) {
  foreach ($datos as $dato) {
    // ... Código para procesar cada $dato ...
  }
} else {
  echo "La variable \$datos no es un array.";
}
?>

<?php include("../../template/header.php"); ?>

<form method="post">
  <div class="form-group">
    <label for="tabla">Selecciona la tabla:</label>
    <select class="form-control" id="tabla" name="tabla" onchange="updateCampo()">
      <option value="empleados">Empleados</option>
      <option value="cursos">Cursos</option>
      <option value="cursosvistos">Cursos vistos</option>
    </select>
  </div>


  <div class="form-group">
    <label for="campo">Selecciona el campo:</label>
    <select class="form-control" id="campo" name="campo">
    <?php    
    if ($_POST['tabla'] == 'empleados') {
        echo '<option value="IDempleado">ID empleado</option>';
        echo '<option value="PrimerNombre">Primer nombre</option>';
        echo '<option value="PrimerApellido">Primer apellido</option>';
        echo '<option value="TipoCurso">Tipo de curso</option>';
        echo '<option value="IDcurso">ID curso</option>';
        echo '<option value="titulo">Título</option>';
        echo '<option value="calificacion">Calificación</option>';
    }elseif ($_POST['tabla'] == 'cursos') {
        echo '<option value="estadoProgreso">Estado de progreso</option>';
        echo '<option value="fechaFin">Fecha de fin</option>';
        echo '<option value="HorasTotales">Horas totales</option>';
        echo '<option value="HorasCredito">Horas de crédito</option>';
        echo '<option value="HorasCreditoEdu">Horas de crédito educativo</option>';
        echo '<option value="HorasContac">Horas de contacto</option>';
    }elseif ($_POST['tabla'] == 'cursosvistos') {
        echo '<option value="IDempleado">ID empleado</option>';
        echo '<option value="IDcurso">ID curso</option>';
        echo '<option value="calificacion">Calificación</option>';
        echo '<option value="fechaInicio">Fecha de inicio</option>';
        echo '<option value="fechaFin">Fecha de fin</option>';
    }

    ?>
    </select>
  </div>
  <div class="form-group">
    <label for="busqueda">Buscar:</label>
    <input type="text" class="form-control" id="busqueda" name="busqueda">
  </div>
  <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<script>
function updateCampo() {
  var tabla = document.getElementById("tabla").value;
  var campo = document.getElementById("campo");
  
  // Limpiar opciones anteriores
  campo.innerHTML = "";

    // Actualizar opciones según tabla seleccionada
    if (tabla == 'empleados') {
    campo.innerHTML += '<option value="IDempleado">ID empleado</option>';
    campo.innerHTML += '<option value="PrimerNombre">Primer nombre</option>';
    campo.innerHTML += '<option value="PrimerApellido">Primer apellido</option>';
    campo.innerHTML += '<option value="TipoCurso">Tipo de curso</option>';
    campo.innerHTML += '<option value="IDcurso">ID curso</option>';
    campo.innerHTML += '<option value="titulo">Título</option>';
    campo.innerHTML += '<option value="calificacion">Calificación</option>';
  } else if (tabla == 'cursos') {
    campo.innerHTML += '<option value="estadoProgreso">Estado de progreso</option>';
    campo.innerHTML += '<option value="fechaFin">Fecha de fin</option>';
    campo.innerHTML += '<option value="HorasTotales">Horas totales</option>';
    campo.innerHTML += '<option value="HorasCredito">Horas de crédito</option>';
    campo.innerHTML += '<option value="HorasCreditoEdu">Horas de crédito educativo</option>';
    campo.innerHTML += '<option value="HorasContac">Horas de contacto</option>';
  } else if (tabla == 'cursosvistos') {
    campo.innerHTML += '<option value="IDempleado">ID empleado</option>';
    campo.innerHTML += '<option value="IDcurso">ID curso</option>';
    campo.innerHTML += '<option value="calificacion">Calificación</option>';
    campo.innerHTML += '<option value="fechaInicio">Fecha de inicio</option>';
    campo.innerHTML += '<option value="fechaFin">Fecha de fin</option>';
  }
}

</script>

<?php

include("../../conexion.php");

$tabla = isset($_POST['tabla']) ? $_POST['tabla'] : '';
$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
$caracter = isset($_POST['caracter']) ? $_POST['caracter'] : '';

if ($tabla == 'empleados') {
    $stm = $conexion->prepare("SELECT * FROM empleados WHERE 
    activo LIKE '%$busqueda%' OR
    IDempleado LIKE '%$busqueda%' OR 
    IDusuario LIKE '%$busqueda%' OR 
    genero LIKE '%$busqueda%' OR 
    PrimerNombre LIKE '%$busqueda%' OR 
    PrimerApellido LIKE '%$busqueda%' OR 
    GrupoPersonal LIKE '%$busqueda%' OR 
    equipoArea LIKE '%$busqueda%' OR 
    equipoVice LIKE '%$busqueda%' OR 
    compañia LIKE '%$busqueda%' OR 
    paisRegion LIKE '%$busqueda%' OR 
    estadoProv LIKE '%$busqueda%' OR 
    ciudad LIKE '%$busqueda%' OR 
    ubicacionPrim LIKE '%$busqueda%'");

    $stm->execute();
    $datos = $stm->fetchAll(PDO::FETCH_ASSOC);
} elseif ($tabla == 'cursos') {
    $stm = $conexion->prepare("SELECT * FROM cursos WHERE 
    activo LIKE '%$busqueda%' OR 
    origen LIKE '%$busqueda%' OR 
    idioma LIKE '%$busqueda%' OR 
    descripcionCat LIKE '%$busqueda%' OR 
    Area_Con LIKE '%$busqueda%' OR 
    proposito LIKE '%$busqueda%' OR 
    tipoCon LIKE '%$busqueda%' OR 
    tipoCur LIKE '%$busqueda%' OR 
    IDcurso LIKE '%$busqueda%' OR 
    tituloCurso LIKE '%$busqueda%' OR 
    fechaCrea LIKE '%$busqueda%'");

    $stm->execute();
    $datos = $stm->fetchAll(PDO::FETCH_ASSOC);

} elseif ($tabla == 'cursosvistos') {
    $stm = $conexion->prepare("SELECT cursosvistos.*, empleados.PrimerNombre, empleados.PrimerApellido
    FROM cursosvistos
    INNER JOIN empleados ON cursosvistos.IDempleado = empleados.IDempleado
    WHERE cursosvistos.TipoCursoC LIKE '%$busqueda%' OR 
    cursosvistos.IDcursoC LIKE '%$busqueda%' OR 
    cursosvistos.tituloC LIKE '%$busqueda%' OR 
    cursosvistos.calificacion LIKE '%$busqueda%' OR 
    cursosvistos.estadoProgreso LIKE '%$busqueda%' OR 
    cursosvistos.fechaFin LIKE '%$busqueda%' OR 
    cursosvistos.HorasTotales LIKE '%$busqueda%' OR 
    cursosvistos.HorasCredito LIKE '%$busqueda%' OR 
    cursosvistos.HorasCreditoEdu LIKE '%$busqueda%' OR 
    cursosvistos.HorasContac LIKE '%$busqueda%' OR
    cursosvistos.usuarioActualizacion LIKE '%$busqueda%' OR
    cursosvistos.horaActualizacion LIKE '%$busqueda%' OR
    cursosvistos.IDempleado LIKE '%$busqueda%' OR
    empleados.PrimerNombre LIKE '%$busqueda%' OR
    empleados.PrimerApellido LIKE '%$busqueda%'");

    $stm->execute();
    $datos = $stm->fetchAll(PDO::FETCH_ASSOC);

}
?>

<div class="table-responsive" style="overflow-x: auto;">
    <div class="table-responsive">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <?php if ($tabla == 'empleados') { ?>
                        <th scope="col">Activo</th>
                        <th scope="col">ID empleado</th>
                        <th scope="col">ID usuario</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Primer Nombre</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Grupo Pers.</th>
                        <th scope="col">Equipo/Area</th>
                        <th scope="col">Equipo/Vice</th>
                        <th scope="col">Estado/Prov</th>
                        <th scope="col">compañia</th>
                        <th scope="col">pais/Region</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Ubic. Principal</th>
                    <?php } elseif ($tabla == 'cursos') { ?>
                        <th scope="col">estado de Progreso</th>
                        <th scope="col">fecha Fin</th>
                        <th scope="col">Horas Totales</th>
                        <th scope="col">Horas de crédito</th>
                        <th scope="col">Horas de crédito educativo</th>
                        <th scope="col">Horas de contacto</th>
                    <?php } elseif ($tabla == 'cursosvistos') { ?>
                        <th scope="col">ID empleado</th>
                        <th scope="col">ID curso</th>
                        <th scope="col">Calificación</th>
                        <th scope="col">Fecha de inicio</th>
                        <th scope="col">Fecha de fin</th>
                    <?php } ?>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <tr class="">
                
               <?php if ($tabla == 'empleados') { ?>
                <td><?php echo $empleado['activo']; ?></td>
                <td><?php echo $empleado['IDempleado'];?></td>
                <td><?php echo $empleado['IDusuario'];?></td>
                <td><?php echo $empleado['genero'];?></td>
                <td><?php echo $empleado['PrimerNombre'];?></td>
                <td><?php echo $empleado['PrimerApellido'];?></td>
                <td><?php echo $empleado['GrupoPersonal'];?></td>
                <td><?php echo $empleado['equipoArea'];?></td>
                <td><?php echo $empleado['equipoVice'];?></td>
                <td><?php echo $empleado['compañia'];?></td>
                <td><?php echo $empleado['paisRegion'];?></td>
                <td><?php echo $empleado['estadoProv'];?></td>
                <td><?php echo $empleado['ciudad'];?></td>
                <td><?php echo $empleado['ubicacionPrim'];?></td>
                <td>editar/eliminar</td>
                
                <?php } elseif ($tabla == 'cursos') { ?>
                <td><?php echo $empleado['estado de Progreso']; ?></td>
                <td><?php echo $empleado['fecha Fin'];?></td>
                <td><?php echo $empleado['Horas Totales'];?></td>
                <td><?php echo $empleado['Horas de crédito'];?></td>
                <td><?php echo $empleado['Horas de crédito educativo'];?></td>
                <td><?php echo $empleado['Horas de contacto'];?></td>
                
                <?php } elseif ($tabla == 'cursosvistos') { ?>
                <td><?php echo $empleado['IDempleado']; ?></td>
                <td><?php echo $empleado['ID curso'];?></td>
                <td><?php echo $empleado['Calificación'];?></td>
                <td><?php echo $empleado['Fecha de inicio'];?></td>
                <td><?php echo $empleado['>Fecha de fin'];?></td>
               <?php } ?>
                
                
            </tr>
           
        
        </tbody>
        </table>
     </div>
</div>
