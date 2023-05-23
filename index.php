<?php include("template/header.php"); ?>

<style>
  body {
    background-image: url('template/imagen2.jpg');
    background-repeat: no-repeat;
    background-size: cover;
  }


</style>


    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Celsia Cursos</h1>
          <p class="col-md-8 fs-4">La página web es un sistema de gestión de empleados y cursos de capacitación, diseñado para ayudar a los empleadores a realizar un
             seguimiento del progreso de los empleados en su capacitación. En la página principal, los usuarios podrían buscar empleados por nombre, ID, departamento 
             u otra información de identificación.</p>
          <button class="btn btn-primary btn-lg" type="button" onclick="window.location.href='modulos/consultas/'">consultas Join</button>
          <button class="btn btn-primary btn-lg" type="button" onclick="window.location.href='modulos/consultasA/'">consultas agregación</button>
        </div>
      </div>




      <?php include("template/footer.php"); ?>
