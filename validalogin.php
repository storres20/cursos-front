<?php
  include("config/conexion.php");
  
  if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    
    $query = "SELECT * FROM usuarios WHERE (nombre = '$usuario')";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
      echo json_encode(array('success' => 1));
    }else{
      echo json_encode(array('success' => 0));
    }
  }

?>