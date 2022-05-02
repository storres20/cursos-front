<?php
  session_start();
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php");
  }
  
  $usuario = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id'];
  
  include_once '../../config/conexion.php';
  //$query = "SELECT * FROM preguntas WHERE click = 0";
  $query = "SELECT * FROM respuestas WHERE id_usuario=$id_usuario";
  $result = mysqli_query($conn, $query);
?>

<?php include '../../template/header.php' ?>

  <h1>Bienvenido <?php echo $usuario?></h1>
  
  <form action="../../validalogin.php?op=out" method="POST">
    <button type="submit" class="btn btn-primary">Cerrar Session</button>
  </form>
  
  <h1>Cuestionario de preguntas</h1>
  
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Pregunta</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
  
  <?php
    $std_num = 1;
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
  ?>
  
    <tr>
      <th scope="row"><?php echo $std_num; ?></th>
      <td><?php echo $row['pregunta']; ?></td>
      <td><a id="<?php echo $row['id'];?>" class="btn btn-primary" href="responder.php?id=<?php echo $row['id'];?>">Entrar</a></td>
    </tr>
  
  <?php $std_num++;} ?>
  
    </tbody>
</table>
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>