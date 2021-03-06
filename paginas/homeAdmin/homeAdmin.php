<?php
  session_start();
  if ($_SESSION['rol'] === "alumno" || $_SESSION['rol'] !== "admin") {
    header("location:../../index.php?mensaje=usuario");
  }
  
  $usuario = $_SESSION['usuario']; // usuario Administrador
  
  $_SESSION['usuario_nombre'] = 0; // nombre de alumno
  
  
  include_once '../../config/conexion.php';
  $query = "SELECT * FROM respuestas";
  $result = mysqli_query($conn, $query);
  $rows = mysqli_num_rows($result);
  
  $result2 = mysqli_query($conn, $query);
?>

<?php include '../../template/header.php' ?>

<?php include '../../template/navAdmin.php' ?>

  
  <div class="card" style="margin: 20px;">
    <div class="card-body">
      <h1 class="card-title">Bienvenido Admin <?php echo $usuario?></h1>
      
      <br><br>
  
      <h3 class="text-muted"><?php echo ($rows > 0) ? "El Examen Random ya ha sido iniciado" : "Iniciar el Examen Random"; ?></h3>
      <form action="random.php" method="POST">
        <button type="submit" class="btn btn-primary" <?php echo ($rows > 0) ? "disabled" : ""; ?> >Random - Curso X</button>
      </form>
      
      <?php
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'ok') {
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Examen Random asignado con Exito!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php } ?>
      
    </div>
  </div>
  
  
  <!-- Listado de Alumnos -->
  <div class="card <?php echo ($rows > 0) ? "" : "d-none"; ?>" style="margin: 20px;">
    <div class="card-body">
      <h5 class="card-title">Listado de Alumnos</h5>
      
      <table id="example" class="table table-striped" style="width:100%">
        <thead>
          <tr>
              <th>N°</th>
              <th>Alumno</th>
              <th>Estado Exámen</th>
              <th>Resultado</th>
              <th>Acción</th>
          </tr>
        </thead>
        <tbody>
        
          <?php
            $std_num = 1;
            
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
              if ($_SESSION['usuario_nombre'] === $row['usuario_nombre']) {
                continue;
              }
              
              $_SESSION['usuario_nombre'] = $row['usuario_nombre'];
              
              
          ?>
        
          <tr>
            <td><?php echo $std_num; ?></td>
            <td><?php echo $row['usuario_nombre']; ?></td>
            <td class="<?php echo ($row['finalizado']) ? 'text-danger' : 'text-primary'; ?>" >
              <?php echo ($row['finalizado']) ? 'Finalizado' : 'En tramite'; ?>
            </td>
            
            <td>
              <?php
                $cont = 0;
                while ($row3 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                  if ($row['id_usuario'] == $row3['id_usuario']) {
                    $cont = $cont + $row3['nota'];
                  }
                }
              ?>
              <?php echo ($row['finalizado']) ? $cont : '';
              
                include_once '../../config/conexion.php';
                $query = "SELECT * FROM respuestas";
                $result2 = mysqli_query($conn, $query);
                /* $row3 = mysqli_fetch_array($result2,MYSQLI_ASSOC); */
              ?>
            </td>
            
            <td class="d-flex">
              <form action="restaurar.php?id=<?php echo $row['id_usuario']; ?>" method="post">
                <button class="btn btn-danger" title="Restaurar Exámen" onclick="return confirm('¿ Está seguro de Finalizar el Exámen ?')" <?php echo ($row['finalizado']) ? '' : 'disabled'; ?> type="submit">
                  <i class="bi bi-arrow-clockwise"></i>
                </button>
              </form>
              <button class="btn btn-primary" title="Detalles"><i class="bi bi-eye" type="button"></i></button>
            </td>
          </tr>
          
          <?php $std_num++;} ?>
          
        </tbody>
        <tfoot>
          <tr>
            <th>N°</th>
            <th>Alumno</th>
            <th>Estado Exámen</th>
            <th>Resultado</th>
            <th>Acción</th>
          </tr>
        </tfoot>
      </table>
      
    </div>
  </div>
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  <!-- DataTable -->
  <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
  
  <script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
  </script>
  
</body>
</html>