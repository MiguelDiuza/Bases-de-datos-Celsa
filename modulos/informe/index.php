<?php
// Función para formatear la fecha
function formatDate($date) {
    return date("d/m/Y", strtotime($date));
}

// Función para formatear el salario
function formatSalary($salary) {
    return "$" . number_format($salary, 0, ",", ".");
}

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
    compañia LIKE '%$busqueda%' OR 
    paisRegion LIKE '%$busqueda%' OR 
    estadoProv LIKE '%$busqueda%' OR 
    ciudad LIKE '%$busqueda%' OR 
    ubicacionPrim LIKE '%$busqueda%'
");
$stm->execute();
$empleados = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../template/header.php"); ?>
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

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID empleado</th>
                <th>Nombre completo</th>
                <th>Fecha de nacimiento</th>
                <th>Salario</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($empleados as $empleado): ?>
                <tr>
                    <td><?php echo $empleado['IDempleado']; ?></td>
                    <td><?php echo $empleado['PrimerNombre'] . ' ' . $empleado['SegundoNombre'] . ' ' . $empleado['PrimerApellido'] . ' ' . $empleado['SegundoApellido']; ?></td>
                    <td><?php echo formatDate($empleado['FechaNacimiento']); ?></td>
                    <td><?php echo formatSalary($empleado['Salario']); ?></td>
                    <td><?php echo $empleado['Departamento']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("../../template/footer.php"); ?>
