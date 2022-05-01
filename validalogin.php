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
      $_SESSION['id'] = $qry['id'];
      
      if($qry['rol']=="admin"){
          header("location:paginas/homeAdmin/homeAdmin.php");
      }else if($qry['rol']=="alumno"){
          header("location:paginas/home/home.php");
      }
      
    }else{
      header("location:index.php?mensaje=falta");
    }
  }else if($op=="out"){
    unset($_SESSION['usuario']);
    unset($_SESSION['password']);
    unset($_SESSION['rol']);
    header("location:index.php");
}

?>