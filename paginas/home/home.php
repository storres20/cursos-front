<?php
  session_start();
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php");
  }
  
  $usuario = $_SESSION['usuario'];
  
  include_once '../../config/conexion.php';
  $query = "SELECT * FROM preguntas";
  $result = mysqli_query($conn, $query);
?>

<?php include '../../template/header.php' ?>

  <h1>Bienvenido <?php echo $usuario?></h1>
  
  <form action="../../validalogin.php?op=out" method="POST">
    <button type="submit" class="btn btn-primary">Cerrar Session</button>
  </form>
  
  <h1>Cuestionario de preguntas</h1>
  
  <?php
    $std_num = 1;
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
  ?>
  
  <div class="card-preg">
    <h2>Pregunta #<?php echo $std_num; ?></h2>
    
    <input type="text" name="" id="" value="<?php echo $row['pregunta']; ?>" disabled style="width:100%">
    <br><br>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt1']; ?>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt2']; ?>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt3']; ?>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt4']; ?>
      </label>
    </div>
    
  </div>
    <?php $std_num++;} ?>
  
  
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>