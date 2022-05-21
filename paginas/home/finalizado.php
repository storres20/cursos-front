<?php

/* print_r($_POST); */

session_start();
  if ($_SESSION['rol'] !== "alumno" || $_SESSION['rol'] === "admin") {
    header("location:../../index.php");
  }
  
  //variables
  $usuario = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id'];
  
  
  include_once '../../config/conexion.php';
  
  /* Obtener Notas */
  $query = "SELECT * FROM respuestas WHERE id_usuario=$id_usuario";
  $result = mysqli_query($conn, $query);
  
  /* res# = respuesta de alumno */
  /* ans# = solucionario */
  $solucionario = 0; //total de preguntas correctas segun el solucionario
  $respondidas = 0; //total de preguntas respondidas por el alumno
  
  /* Validacion de respuestas con solucionario */
  while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    if ($row['ans4'] == 1) {
      $solucionario++;
      
      if ($row['ans4'] == $row['res4']) {
        $respondidas++;
      }
    }
    
    if ($row['ans3'] == 1) {
      $solucionario++;
      
      if ($row['ans3'] == $row['res3']) {
        $respondidas++;
      }
    }
    
    if ($row['ans2'] == 1) {
      $solucionario++;
      
      if ($row['ans2'] == $row['res2']) {
        $respondidas++;
      }
    }
    
    if ($row['ans1'] == 1) {
      $solucionario++;
      
      if ($row['ans1'] == $row['res1']) {
        $respondidas++;
      }
    }
    
    /* Nota */
    $nota = $respondidas / $solucionario;
    
    /* id de pregunta actual */
    $id = $row['id'];
    
    /* UPDATE nota en Base de Datos */
    $query = "UPDATE respuestas SET nota=$nota WHERE id= $id";
    if ($conn->query($query) === TRUE){}
    
    /* Reseteo de variables */
    $solucionario = 0;
    $respondidas = 0;
  }
  
  
  /* Finalizar Examen */
  $finalizado = '1';
  
  /* $query = "UPDATE respuestas SET res1='$res1', res2='$res2', res3='$res3', res4='$res4', click=$click WHERE id='$id_pregunta'"; */
  $query = "UPDATE respuestas SET finalizado=$finalizado WHERE id_usuario='$id_usuario'";
  
  if ($conn->query($query) === TRUE) {
    //echo "New record created successfully";
    header("location:home.php");
  }
  else {
    echo "Error: " . $query . "<br>" . $conn->error;
  }


?>