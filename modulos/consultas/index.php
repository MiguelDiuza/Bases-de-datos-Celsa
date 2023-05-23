<?php
include("../../conexion.php");

function mostrarEmpleados() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT * FROM empleados LIMIT 10");
    $stm->execute();
    $empleados = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $empleados;
}

function mostrarCursos() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT * FROM cursosvistos LIMIT 10");
    $stm->execute();
    $cursosvistos = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosvistos;
}
function mostrarCursosPanama() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT posicion.IDcursoC,  empleados.paisRegion, COUNT(DISTINCT posicion.IDempleado) AS totalEmpleados
    FROM posicion
    INNER JOIN empleados ON posicion.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Panama'
    GROUP BY posicion.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 5");
    $stm->execute();
    $cursosPanama = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosPanama;
}

function mostrarCursosCosta() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT posicion.IDcursoC, empleados.paisRegion, COUNT(DISTINCT posicion.IDempleado) AS totalEmpleados
    FROM posicion
    INNER JOIN empleados ON posicion.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Costa Rica'
    GROUP BY posicion.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 5");
    $stm->execute();
    $cursosCosta = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosCosta;
}

function mostrarCursosColombiaV() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT cursosvistos.IDcursoC, cursosvistos.tituloC, TipoCursoC, COUNT(DISTINCT cursosvistos.IDempleado) AS totalEmpleados
    FROM cursosvistos
    INNER JOIN empleados ON cursosvistos.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Colombia' AND TipoCursoC = 'VIRTUAL'
    GROUP BY cursosvistos.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 10");
    $stm->execute();
    $cursosColombiaV = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosColombiaV;
}

function mostrarCursosColombiaP() {
    include("../../conexion.php");
    global $conexion;
    $stm = $conexion->prepare("SELECT cursosvistos.IDcursoC, cursosvistos.tituloC, TipoCursoC, COUNT(DISTINCT cursosvistos.IDempleado) AS totalEmpleados
    FROM cursosvistos
    INNER JOIN empleados ON cursosvistos.IDempleado = empleados.IDempleado
    WHERE empleados.paisRegion = 'Colombia' AND TipoCursoC = 'PRES'
    GROUP BY cursosvistos.IDcursoC
    ORDER BY totalEmpleados DESC
    LIMIT 10");
    $stm->execute();
    $cursosColombiaP = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $cursosColombiaP;
}

function mostrarMejoresNotas() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT empleados.PrimerNombre, empleados.PrimerApellido, cursosvistos.calificacion, cursosvistos.IDcursoC, cursosvistos.tituloC
    FROM empleados empleados
    INNER JOIN cursosvistos cursosvistos ON empleados.IDempleado = cursosvistos.IDempleado
    WHERE cursosvistos.calificacion IN (50, 100)
    GROUP BY empleados.PrimerNombre, empleados.PrimerApellido
    ORDER BY empleados.PrimerNombre, empleados.PrimerApellido
    LIMIT 10");
    $stm->execute();
    $empleados = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $empleados;
}




if (isset($_POST['mostrarEmpleados'])) {
    $empleados = mostrarEmpleados();
}
elseif(isset($_POST['mostrarCursos'])) {
    $cursosvistos = mostrarCursos();
}
elseif(isset($_POST['mostrarCursosPanama'])) {
    $cursosPanama = mostrarCursosPanama();
}
elseif(isset($_POST['mostrarCursosCosta'])) {
    $cursosCosta = mostrarCursosCosta();
}
elseif (isset($_POST['mostrarCursosColombiaV'])) {
    $cursosColombiaV = mostrarCursosColombiaV();
}

elseif (isset($_POST['mostrarCursosColombiaP'])) {
    $cursosColombiaP = mostrarCursosColombiaP();
}
elseif (isset($_POST['mostrarMejoresNotas'])) {
    $empleadosNota = mostrarMejoresNotas();
}
?>

<?php include("../../template/header.php"); ?>

<div>
    <h3>Consultas JOIN </h3>
    <br>

    <div class="button-container">
        <form method="post">
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarEmpleados">datos de 10 empleados</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarCursos">10 cursos dictados</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarCursosPanama">5 cursos con mas empleados panama</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarCursosCosta">5 cursos con mas empleados Costa Rica</button>
            <br><br>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarCursosColombiaV">10 cursos en Colombia Virtual</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarCursosColombiaP">10 cursos en Colombia presencial</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="mostrarMejoresNotas">Mejores Notas</button>


        </form>
    </div>

    <?php if (isset($empleados)) { ?>
    <br>
    <h4> 10 empleados de la compañía:</h4>    
        <div class="table-responsive" style="overflow-x: auto;">
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado) { ?>
                        <tr class="">
                            <td><?php echo $empleado['activo']; ?></td>
                            <td><?php echo $empleado['IDempleado']; ?></td>
                            <td><?php echo $empleado['IDusuario']; ?></td>
                            <td><?php echo $empleado['genero']; ?></td>
                            <td><?php echo $empleado['PrimerNombre']; ?></td>
                            <td><?php echo $empleado['PrimerApellido']; ?></td>
                            <td><?php echo $empleado['GrupoPersonal']; ?></td>
                            <td><?php echo $empleado['equipoArea']; ?></td>
                            <td><?php echo $empleado['equipoVice']; ?></td>
                            <td><?php echo $empleado['estadoProv']; ?></td>
                            <td><?php echo $empleado['compañia']; ?></td>
                            <td><?php echo $empleado['paisRegion']; ?></td>
                            <td><?php echo $empleado['ciudad']; ?></td>
                            <td><?php echo $empleado['ubicacionPrim']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php }elseif (isset($cursosvistos)) { ?>
    <br>
    <h4> 10 cursos que han sido dictados:</h4>
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table">
                <thead class="table table-dark">
                    <tr>
                        <th scope="col">TipoCursoC</th>
                        <th scope="col">IDcursoC</th>
                        <th scope="col">tituloC</th>
                        <th scope="col">estadoProgreso</th>
                        <th scope="col">fechaFin</th>
                        <th scope="col">HorasTotales</th>
                        <th scope="col">HorasCredito</th>
                        <th scope="col">HorasCreditoEdu</th>
                        <th scope="col">HorasContac</th>
                        <th scope="col">usuarioActualizacion</th>
                        <th scope="col">horaActualizacion</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cursosvistos as $cursosvistos) { ?>
                        <tr class="">
                            <td><?php echo $cursosvistos['TipoCursoC']; ?></td>
                            <td><?php echo $cursosvistos['IDcursoC'];?></td>
                            <td><?php echo $cursosvistos['tituloC'];?></td>
                            <td><?php echo $cursosvistos['estadoProgreso'];?></td>
                            <td><?php echo $cursosvistos['fechaFin'];?></td>
                            <td><?php echo $cursosvistos['HorasTotales'];?></td>
                            <td><?php echo $cursosvistos['HorasCredito'];?></td>
                            <td><?php echo $cursosvistos['HorasCreditoEdu'];?></td>
                            <td><?php echo $cursosvistos['HorasContac'];?></td>
                            <td><?php echo $cursosvistos['usuarioActualizacion'];?></td>
                            <td><?php echo $cursosvistos['horaActualizacion'];?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } elseif (isset($cursosPanama)) { ?>
    <br>
    <h4>10 cursos en modalidad virtual que han sido realizados por la mayor cantidad de empleados de las sedes de la compañía en panamá:</h4>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">Cantidad de Empleados</th>
                    <th scope="col">ID del Curso</th>
                    <th scope="col">pais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosPanama as $curso) { ?>
                    <tr class="">
                        <td><?php echo $curso['totalEmpleados']; ?></td>
                        <td><?php echo $curso['IDcursoC']; ?></td>
                        <td><?php echo $curso['paisRegion']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } elseif (isset($cursosColombiaV)) { ?>
    <br>
    <h4>10 cursos en modalidad virtual que han sido realizados por la mayor cantidad de empleados de las sedes de la compañía en Colombia:</h4>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">Cantidad de Empleados</th>
                    <th scope="col">ID del Curso</th>
                    <th scope="col">Título del Curso</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosColombiaV as $curso) { ?>
                    <tr class="">
                        <td><?php echo $curso['totalEmpleados']; ?></td>
                        <td><?php echo $curso['IDcursoC']; ?></td>
                        <td><?php echo $curso['tituloC']; ?></td>
                        <td><?php echo $curso['TipoCursoC']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }elseif (isset($cursosColombiaP)) { ?>
    <br>
    <h4>10 cursos en modalidad presencial que han sido realizados por la mayor cantidad de empleados de las sedes de la compañía en Colombia:</h4>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">Cantidad de Empleados</th>
                    <th scope="col">ID del Curso</th>
                    <th scope="col">Título del Curso</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosColombiaP as $curso) { ?>
                    <tr class="">
                        <td><?php echo $curso['totalEmpleados']; ?></td>
                        <td><?php echo $curso['IDcursoC']; ?></td>
                        <td><?php echo $curso['tituloC']; ?></td>
                        <td><?php echo $curso['TipoCursoC']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }elseif (isset($cursosCosta)) { ?>
    <br>
    <h4>5 cursos que han sido realizados por la mayor cantidad de empleados de las sedes de la compañía en Costa Rica:</h4>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">Cantidad de Empleados</th>
                    <th scope="col">ID del Curso</th>
                    <th scope="col">pais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursosCosta as $curso) { ?>
                    <tr class="">
                        <td><?php echo $curso['totalEmpleados']; ?></td>
                        <td><?php echo $curso['IDcursoC']; ?></td>
                        <td><?php echo $curso['paisRegion']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php }elseif (isset($empleadosNota)) { ?>
    <br>
    <h4>Empleados con mejores notas:</h4>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table">
            <thead class="table table-dark">
                <tr>
                    <th scope="col">Nombre empleado</th>
                    <th scope="col">ID del Curso</th>
                    <th scope="col">Título del Curso</th>
                    <th scope="col">nota de Empleados</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleadosNota as $empleado) { ?>
                    <tr class="">
                        <td><?php echo $empleado['PrimerNombre']; ?></td>
                        <td><?php echo $empleado['IDcursoC']; ?></td>
                        <td><?php echo $empleado['tituloC']; ?></td>
                        <td><?php echo $empleado['calificacion']; ?></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>


<?php include("../../template/footer.php"); ?>