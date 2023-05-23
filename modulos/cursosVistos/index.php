<?php

include("../../conexion.php");

$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
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
    empleados.PrimerApellido LIKE '%$busqueda%'


");


$stm->execute();
$cursosvistos = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../template/header.php"); ?>


<br>
<h4>Cursos vistos</h4>
<br>
<form method="post">
    <div class="form-group d-flex">
        <label for="busqueda" class="mr-2" >Buscar por cualquier campo:</label>
        <br>
        <input type="text" class="form-control mr-2" id="busqueda" name="busqueda" value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit" class="btn btn-primary justify-content-end">Buscar</button>
    </div>
    <br><br>
</form>

<div class="table-responsive" style="overflow-x: auto;">
<div class="table-responsive">
    <table class="table">
        <thead class="table table-dark">
            <tr>
            <th scope="col">nombre/apellido</th>
                <th scope="col">TipoCursoC</th>
                <th scope="col">IDcursoC</th>
                <th scope="col">tituloC</th>
                <th scope="col">calificacion</th>
                <th scope="col">estadoProgreso</th>
                <th scope="col">fechaFin</th>
                <th scope="col">HorasTotales</th>
                <th scope="col">HorasCredito</th>
                <th scope="col">HorasCreditoEdu</th>
                <th scope="col">HorasContac</th>
                <th scope="col">usuarioActualizacion</th>
                <th scope="col">horaActualizacion</th>
                <th scope="col">IDempleado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($cursosvistos as $cursosvistos) {  ?>
            <tr class="">
                <td><?php echo $cursosvistos['PrimerNombre'] . ' ' . $cursosvistos['PrimerApellido']; ?></td>
                <td><?php echo $cursosvistos['TipoCursoC']; ?></td>
                <td><?php echo $cursosvistos['IDcursoC'];?></td>
                <td><?php echo $cursosvistos['tituloC'];?></td>
                <td><?php echo $cursosvistos['calificacion'];?></td>
                <td><?php echo $cursosvistos['estadoProgreso'];?></td>
                <td><?php echo $cursosvistos['fechaFin'];?></td>
                <td><?php echo $cursosvistos['HorasTotales'];?></td>
                <td><?php echo $cursosvistos['HorasCredito'];?></td>
                <td><?php echo $cursosvistos['HorasCreditoEdu'];?></td>
                <td><?php echo $cursosvistos['HorasContac'];?></td>
                <td><?php echo $cursosvistos['usuarioActualizacion'];?></td>
                <td><?php echo $cursosvistos['horaActualizacion'];?></td>
                <td><?php echo $cursosvistos['IDempleado'];?></td>
                <td>editar/eliminar</td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>




<?php include("../../template/footer.php"); ?>