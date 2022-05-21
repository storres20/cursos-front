<?php

session_start();
  if ($_SESSION['rol'] === "alumno" || $_SESSION['rol'] !== "admin") {
    header("location:../../index.php");
  }
  
  /* Captura el ID que viene en la URL */
  $id_usuario = $_GET['id'];
  
  include_once '../../config/conexion.php';
  
  $finalizado = '0';
  
  $query = "UPDATE respuestas SET finalizado='$finalizado' WHERE id_usuario='$id_usuario'";
  
  if ($conn->query($query) === TRUE) {
    //echo "New record created successfully";
    header("location:homeAdmin.php");
  }
  else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }


?>