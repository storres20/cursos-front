<?php
  session_start();
  if ($_SESSION['rol'] === "alumno" || $_SESSION['rol'] !== "admin") {
    header("location:../../index.php?mensaje=usuario");
  }
  
  $usuario = $_SESSION['usuario']; // usuario Administrador
  
  $_SESSION['usuario_nombre'] = 0; // nombre de alumno
  
  
  include_once '../../config/conexion.php';
  $query = "SELECT * FROM preguntas";
  $result = mysqli_query($conn, $query);
  $rows = mysqli_num_rows($result);
?>

<?php include '../../template/header.php' ?>

<?php include '../../template/navAdmin.php' ?>

  
  <div class="card" style="margin: 20px;">
    <div class="card-body">
      <h1 class="card-title">Bienvenido Admin <?php echo $usuario?></h1>
      <br>
      <h3 class="text-muted">Curso X</h3>
    </div>
  </div>
  
  
  <!-- Listado de Alumnos -->
  <div class="card <?php echo ($rows > 0) ? "" : "d-none"; ?>" style="margin: 20px;">
    <div class="card-body">
      <button class="btn btn-primary mb-2" title="Agregar pregunta"><i class="bi bi-clipboard-plus"></i> Nuevo</button>
      <h5 class="card-title">Listado de Preguntas</h5>
      
      <table id="example" class="table table-striped" style="width:100%">
        <thead>
          <tr>
              <th>N°</th>
              <th>Pregunta</th>
              <th>Acción</th>
          </tr>
        </thead>
        <tbody>
        
          <?php
            $std_num = 1;
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
              /* if ($_SESSION['usuario_nombre'] === $row['usuario_nombre']) {
                continue;
              }
              
              $_SESSION['usuario_nombre'] = $row['usuario_nombre']; */
              
          ?>
        
          <tr>
            <td><?php echo $std_num; ?></td>
            <td><?php echo $row['pregunta']; ?></td>
            <td>
              <button class="btn btn-warning" title="Editar"><i class="bi bi-pencil-square"></i></button>
              <button class="btn btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
          
          <?php $std_num++;} ?>
          
        </tbody>
        <tfoot>
          <tr>
            <th>N°</th>
            <th>Pregunta</th>
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