<?php
  session_start();
  if ($_SESSION['rol'] === "alumno" || $_SESSION['rol'] !== "admin") {
    header("location:../../index.php");
  }
  
  include_once '../../config/conexion.php';
  $query = "SELECT * FROM respuestas";
  $result = mysqli_query($conn, $query);
  $rows = mysqli_num_rows($result);
?>

<?php include '../../template/header.php' ?>

  <h1>Bienvenido Administrador</h1>
  
  <form action="../../validalogin.php?op=out" method="POST">
    <button type="submit" class="btn btn-primary">Cerrar Session</button>
  </form>
  
  <br><br>
  
  <h3><?php echo ($rows > 0) ? "El Examen Random ya ha sido iniciado" : "Iniciar el Examen Random"; ?></h3>
  <form action="random.php" method="POST">
    <button type="submit" class="btn btn-primary" <?php echo ($rows > 0) ? "disabled" : ""; ?> >Random - Curso X</button>
  </form>
  
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>