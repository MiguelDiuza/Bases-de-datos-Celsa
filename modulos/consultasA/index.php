<?php

include("../../conexion.php");

function cursosIngles() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT cursos.activo, cursos.idioma, IDcurso, tituloCurso,  tipoCur,  COUNT(*) AS cantidad_cursos
    FROM cursos
    WHERE idioma = 'Ingles'");
    $stm->execute();
    $curso = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $curso;
}

function cursosEspañol() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursos
    WHERE idioma = 'Espanol'");
    $stm->execute();
    $curso = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $curso;
}

function cursosHolndes() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursos
    WHERE idioma = 'Holandes'");
    $stm->execute();
    $curso = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $curso;
}

function cursosFrances() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursos
    WHERE idioma = 'Frances'");
    $stm->execute();
    $curso = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $curso;
}

function cursosApro() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursosvistos
    WHERE estadoProgreso = 'Aprobado (Virtual)' OR estadoProgreso = 'Aprobado (Pres)'");
    $stm->execute();
    $curso = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $curso;
}

function cursosNoApro() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT COUNT(*) AS cantidad_cursos
    FROM cursosvistos
    WHERE estadoProgreso = 'No Aprobado (Virtual)' OR estadoProgreso = 'No Aprobado (Pres)'" );
    $stm->execute();
    $curso = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $curso;
}

function promNotasColombia() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursosvistos.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursosvistos  ON empleados.IDempleado = cursosvistos.IDempleado
    WHERE empleados.paisRegion = 'Colombia'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}


function promNotasCosta() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursosvistos.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursosvistos  ON empleados.IDempleado = cursosvistos.IDempleado
    WHERE empleados.paisRegion = 'Costa Rica'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}

function promNotasHon() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursosvistos.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursosvistos  ON empleados.IDempleado = cursosvistos.IDempleado
    WHERE empleados.paisRegion = 'Honduras'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}

function promNotasPan() {
    include("../../conexion.php");
    $stm = $conexion->prepare("SELECT AVG(cursosvistos.calificacion) AS promedio_notas
    FROM empleados 
    INNER JOIN cursosvistos  ON empleados.IDempleado = cursosvistos.IDempleado
    WHERE empleados.paisRegion = 'Panama'" );
    $stm->execute();
    $prom = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $prom;
}

if (isset($_POST['cursosIngles'])) {
    $curso = cursosIngles();

}
elseif(isset($_POST['cursosEspañol'])) {
    $curso = cursosEspañol();

}
elseif(isset($_POST['cursosHolndes'])) {
    $curso = cursosHolndes();
}
elseif(isset($_POST['cursosFrances'])) {
    $curso = cursosFrances();
}
elseif(isset($_POST['cursosApro'])) {
    $curso = cursosApro();
}
elseif(isset($_POST['cursosNoApro'])) {
    $curso = cursosNoApro();
}
elseif(isset($_POST['promNotasColombia'])) {
    $prom = promNotasColombia();
}
elseif(isset($_POST['promNotasCosta'])) {
    $prom = promNotasCosta();
}
elseif(isset($_POST['promNotasPan'])) {
    $prom = promNotasPan();
}
elseif(isset($_POST['promNotasHon'])) {
    $prom = promNotasHon();
}


?>

<?php include("../../template/header.php"); ?>

<div>
    <h3>Consultas de agregación</h3>
    <br>

    <div class="button-container">
        <form method="post">
        <h5>por idioma:</h5>

            <button class="btn btn-primary btn-lg custom-button" type="submit" name="cursosIngles">Cursos en idiomas inglés</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="cursosEspañol">Cursos en idiomas español</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="cursosHolndes">Cursos en idiomas holandés</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="cursosFrances">Cursos en idiomas francés</button>
            <br><br>
            <h5>por aprobación:</h5>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="cursosApro">Cursos aprobados por los empleados</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="cursosNoApro">Cursos no aprobados por los empleados</button>
            <br><br>
            <h5>por promedio:</h5>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="promNotasColombia">Promedio de notas en Colombia</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="promNotasCosta">Promedio de notas en Costa Rica</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="promNotasHon">Promedio de notas en Honduras</button>
            <button class="btn btn-primary btn-lg custom-button" type="submit" name="promNotasPan">Promedio de notas en Panamá</button>


        </form>
    </div>

    <?php if (isset($curso)) { ?>
    <br>
    <h4> cantidad:</h4>    
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table">
                <thead class="table table-dark">
                    <tr>
                        <th scope="col">cantidad</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($curso as $curso) { ?>
                        <tr class="">
                            <td><?php echo $curso['cantidad_cursos']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } elseif (isset($prom)) { ?>
    <br>
    <h4> promedio:</h4>    
        <div class="table-responsive" style="overflow-x: auto;">
            <table class="table">
                <thead class="table table-dark">
                    <tr>
                        <th scope="col">cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prom as $prom) { ?>
                        <tr class="">
                            <td><?php echo $prom['promedio_notas']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>


<?php include("../../template/footer.php"); ?>
