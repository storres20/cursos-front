<?php
  session_start();
  $usuario = $_POST['usuario'] ? $_POST['usuario'] : "";
  $password = $_POST['password'] ? $_POST['password'] : "";
  $op = $_GET['op'];
  
  include("config/conexion.php");
  
  if($op=="in"){
    
    $query = "SELECT * FROM usuarios WHERE (usuario = '$usuario' && password = '$password')";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
      
      $qry = mysqli_fetch_array($result);
      $_SESSION['usuario'] = $qry['usuario'];
      $_SESSION['password'] = $qry['password'];
      $_SESSION['rol'] = $qry['rol'];
      
      if($qry['rol']=="admin"){
          header("location:homeAdmin.php");
      }else if($qry['rol']=="alumno"){
          header("location:home.php");
      }
      
    }else{
      
      ?>
        <script language="JavaScript">
            alert('El nombre de usuario o la contraseña no coinciden. ¡Por favor repita de nuevo!');
            document.location='index.php';
        </script>
      <?php
      
    }
  }else if($op=="out"){
    unset($_SESSION['usuario']);
    unset($_SESSION['password']);
    unset($_SESSION['rol']);
    header("location:index.php");
}

?>