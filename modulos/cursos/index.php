<?php

include("../../conexion.php");

$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
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
    fechaCrea LIKE '%$busqueda%'

");
$stm->execute();
$cursos = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../template/header.php"); ?>
<br>
<h4>Cursos Disponibles</h4>
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
                <th scope="col">activo</th>
                <th scope="col">origen</th>
                <th scope="col">idioma</th>
                <th scope="col">descripcionCat</th>
                <th scope="col">Area_Con</th>
                <th scope="col">proposito</th>
                <th scope="col">tipoCon</th>
                <th scope="col">tipoCur</th>
                <th scope="col">IDcurso</th>
                <th scope="col">tituloCurso</th>
                <th scope="col">fechaCrea</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cursos as $cursos) {  ?>
            <tr class="">
                <td><?php echo $cursos['activo']; ?></td>
                <td><?php echo $cursos['origen'];?></td>
                <td><?php echo $cursos['idioma'];?></td>
                <td><?php echo $cursos['descripcionCat'];?></td>
                <td><?php echo $cursos['Area_Con'];?></td>
                <td><?php echo $cursos['proposito'];?></td>
                <td><?php echo $cursos['tipoCon'];?></td>
                <td><?php echo $cursos['tipoCur'];?></td>
                <td><?php echo $cursos['IDcurso'];?></td>
                <td><?php echo $cursos['tituloCurso'];?></td>
                <td><?php echo $cursos['fechaCrea'];?></td>

                <td>editar/eliminar</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<?php include("../../template/footer.php"); ?>