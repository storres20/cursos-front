<?php
  /* Carga los datos de Inicio Sesion */
  session_start();
  
  /* Verifica que no haya ursurpacion de Roles */
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php?mensaje=usuario");
  }
  
  $usuario = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id'];
  $_SESSION['nota'] = 0;
  
  /* Conexion a Base de Datos */
  include_once '../../config/conexion.php';
  //$query = "SELECT * FROM preguntas WHERE click = 0";
  $query = "SELECT * FROM respuestas WHERE id_usuario=$id_usuario";
  $result = mysqli_query($conn, $query);
?>

<?php include '../../template/header.php' ?>

<?php include '../../template/navAlumno.php' ?>
  
  <div class="card" style="margin: 20px;">
    <div class="card-body">
      <h1 class="card-title">Bienvenido <?php echo $usuario?></h1>
      <!-- <form class="mb-2" action="../../validalogin.php?op=out" method="POST">
        <button type="submit" class="btn btn-primary">Cerrar Session</button>
      </form> -->
      <h2 class="card-subtitle mb-2 text-muted">Cuestionario de preguntas</h2>
      
      <!-- Mensaje de Alerta de prevencion de fraude -->
      <?php
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'fraude') {
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Tenga cuidado!</strong> Resuelva solo su examen.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php } ?>
      
      <!-- Table - Cuestionario de Preguntas -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center" scope="col">N°</th>
            <th scope="col">Pregunta</th>
            <th scope="col">Accion</th>
            <th scope="col">Resultado</th>
          </tr>
        </thead>
        <tbody>
        
          <?php
            $std_num = 1;
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
              $_SESSION['finalizado'] = $row['finalizado'];
              $nota = $row['nota'];
              $_SESSION['nota'] = $_SESSION['nota'] + $nota;
          ?>
        
          <tr>
            <th class="text-center" scope="row"><?php echo $std_num; ?></th>
            <td><?php echo $row['pregunta']; ?></td>
            <td>
              <a id="<?php echo $row['id'];?>" class="btn <?php echo ($row['click']==='0') ? 'btn-primary' : 'btn-secondary'; ?>" href="responder.php?id=<?php echo $row['id'];?>"><?php echo ($row['click']==="0") ? "Entrar" : "Enviado"; ?></a>
            </td>
            <td><?php echo ($_SESSION['finalizado']==="0") ? "" : "$nota / 1"; ?></td>
          </tr>
        
          <?php $std_num++;} ?>
      
        </tbody>
      </table>
      
      <!-- Button - Finalizar Examen -->
      <form action="finalizado.php">
        <button onclick="return confirm('¿ Está seguro de Finalizar el Exámen ?')" type="submit" class="btn btn-danger" <?php echo ($_SESSION['finalizado']==="0") ? "" : "disabled"; ?> >Finalizar Examen</button>
      </form>
    </div>
  </div>
  
  <!-- Resultado de Cuestionario -->
  <div class="card <?php echo ($_SESSION['finalizado']==='0') ? 'd-none' : ''; ?>" style="margin: 20px;">
    <div class="card-body">
      <h2 class="card-title text-muted">Resultado Total</h2>
      <h5 class="card-text">El puntaje obtenido es:&emsp; <b><?php echo $_SESSION['nota']; ?></b></h5>
    </div>
  </div>
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>