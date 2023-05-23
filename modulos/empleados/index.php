<?php

include("../../conexion.php");

$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
$stm = $conexion->prepare("SELECT * FROM empleados WHERE 
    IDempleado LIKE '%$busqueda%' OR 
    IDusuario LIKE '%$busqueda%' OR 
    genero LIKE '%$busqueda%' OR 
    PrimerNombre LIKE '%$busqueda%' OR 
    PrimerApellido LIKE '%$busqueda%' OR 
    GrupoPersonal LIKE '%$busqueda%' OR 
    equipoArea LIKE '%$busqueda%' OR 
    equipoVice LIKE '%$busqueda%' OR 
    estadoProv LIKE '%$busqueda%' OR 
    compañia LIKE '%$busqueda%' OR 
    paisRegion LIKE '%$busqueda%' OR 
    ciudad LIKE '%$busqueda%' OR 
    ubicacionPrim LIKE '%$busqueda%'
");
$stm->execute();
$empleados = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../template/header.php"); ?>
<br>
<h4>Empleados</h4>
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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($empleados as $empleado) {  ?>
            <tr class="">
                <td><?php echo $empleado['activo']; ?></td>
                <td><?php echo $empleado['IDempleado'];?></td>
                <td><?php echo $empleado['IDusuario'];?></td>
                <td><?php echo $empleado['genero'];?></td>
                <td><?php echo $empleado['PrimerNombre'];?></td>
                <td><?php echo $empleado['PrimerApellido'];?></td>
                <td><?php echo $empleado['GrupoPersonal'];?></td>
                <td><?php echo $empleado['equipoArea'];?></td>
                <td><?php echo $empleado['equipoVice'];?></td>
                <td><?php echo $empleado['estadoProv'];?></td>
                <td><?php echo $empleado['compañia'];?></td>
                <td><?php echo $empleado['paisRegion'];?></td>
                <td><?php echo $empleado['ciudad'];?></td>
                <td><?php echo $empleado['ubicacionPrim'];?></td>
                <td>editar/eliminar</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<?php include("../../template/footer.php"); ?>