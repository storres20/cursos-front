<?php
  session_start();
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php");
  }
  
  //variables
  $usuario = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id'];
  $id_pregunta = $_GET['id'];
  
  include_once '../../config/conexion.php';
  $query = "SELECT * FROM respuestas WHERE id=$id_pregunta";
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
      
      //para prevencion en caso un alumno ingrese URL forzado de pregunta ya respondida
      /* if ($row['click']==='1') {
        header("location:home.php");
      } */
  ?>
  
  <div class="card-preg">
    <h2>Pregunta #</h2>
    
    <!-- <input type="text" name="" id="" value="<?php echo $row['pregunta']; ?>" disabled style="width:100%"> -->
    <h3><?php echo $row['pregunta']; ?></h3>
    
    <form action="enviar.php?id=<?php echo $id_pregunta; ?>" method="post">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="alt1" <?php echo ($row['res1']==="0") ? "" : "checked"; ?> <?php echo ($row['click']==="1") ? "disabled" : ""; ?> >
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt1']; ?>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="alt2" <?php echo ($row['res2']==="0") ? "" : "checked"; ?> <?php echo ($row['click']==="1") ? "disabled" : ""; ?> >
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt2']; ?>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="alt3" <?php echo ($row['res3']==="0") ? "" : "checked"; ?> <?php echo ($row['click']==="1") ? "disabled" : ""; ?> >
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt3']; ?>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="alt4" <?php echo ($row['res4']==="0") ? "" : "checked"; ?> <?php echo ($row['click']==="1") ? "disabled" : ""; ?> >
      <label class="form-check-label" for="flexCheckDefault">
        <?php echo $row['alt4']; ?>
      </label>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" <?php echo ($row['click']==="1") ? "disabled" : ""; ?> >Enviar</button>
    <a class="btn btn-danger" href="home.php"><?php echo ($row['click']==="1") ? "Regresar" : "Cancelar"; ?></a>
    
    </form>
    
  </div>
    <?php } ?>
  
  
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>