<?php
  session_start();
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php");
  }
  
  $usuario = $_SESSION['usuario'];
?>

<?php include '../../template/header.php' ?>

  <h1>Bienvenido <?php echo $usuario?></h1>
  
  <form action="../../validalogin.php?op=out" method="POST">
    <button type="submit" class="btn btn-primary">Cerrar Session</button>
  </form>
  
  <h1>Cuestionario de preguntas</h1>
  
  <div class="card-preg">
    <h2>Pregunta #00</h2>
    <input type="text" name="" id="">
    <br><br>
    <textarea name="" id="" cols="30" rows="10"></textarea>
  </div>
  
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>