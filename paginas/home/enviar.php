<?php

print_r($_POST);

session_start();
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php");
  }
  
  //variables
  $usuario = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id'];
  
  /* Captura el ID que viene en la URL */
  $id_pregunta = $_GET['id'];
  
  include_once '../../config/conexion.php';
  
  isset($_POST['alt1']) ? $res1=$_POST['alt1'] : $res1="0";
  isset($_POST['alt2']) ? $res2=$_POST['alt2'] : $res2="0";
  isset($_POST['alt3']) ? $res3=$_POST['alt3'] : $res3="0";
  isset($_POST['alt4']) ? $res4=$_POST['alt4'] : $res4="0";
  
  $click = '1';
  
  $query = "UPDATE respuestas SET res1='$res1', res2='$res2', res3='$res3', res4='$res4', click=$click WHERE id='$id_pregunta'";
  
  if ($conn->query($query) === TRUE) {
    //echo "New record created successfully";
    header("location:home.php");
  }
  else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }


?>