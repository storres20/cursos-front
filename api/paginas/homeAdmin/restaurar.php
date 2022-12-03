<?php

session_start();
  if ($_SESSION['rol'] === "alumno" || $_SESSION['rol'] !== "admin") {
    header("location:../../index.php");
  }
  
  /* Captura el ID que viene en la URL */
  $id_usuario = $_GET['id'];
  
  /* Conexion a Mysql */
  include_once '../../config/conexion.php';
  
  /* Se restaura la opcion de volver a rendir el examen si el campo FINALIZADO está en CERO */
  $finalizado = '0';
  
  /* Comando SQL para actualizar el campo FINALIZADO a CERO */
  $query = "UPDATE respuestas SET finalizado='$finalizado' WHERE id_usuario='$id_usuario'";
  
  /* Una vez ejecutado el SQL se verifica y redirige al menu inicial */
  if ($conn->query($query) === TRUE) {
    //echo "New record created successfully";
    header("location:homeAdmin.php");
  }
  else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }


?>