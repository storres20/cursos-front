<?php
  session_start();
  if ($_SESSION['rol'] === "alumno" || $_SESSION['rol'] !== "admin") {
    header("location:../../index.php");
  }
  
  include_once '../../config/conexion.php';
  /* $query_select = "SELECT * FROM preguntas";
  $result = $conn->query($query_select); */
  
  $query_usuarios = "SELECT * FROM usuarios WHERE rol='alumno'";
  $result_usuarios = $conn->query($query_usuarios);
  
  if ($result_usuarios->num_rows > 0) {
    // output data of each row
    while($row_usuarios = $result_usuarios->fetch_assoc()) {
      $id_usuario = $row_usuarios['id'];
      
      $query_select = "SELECT * FROM preguntas";
      $result = $conn->query($query_select);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $id_pregunta = $row['id'];
          $pregunta = $row['pregunta'];
          $alt1 = $row['alt1'];
          $alt2 = $row['alt2'];
          $alt3 = $row['alt3'];
          $alt4 = $row['alt4'];
          
          $query_insert = "INSERT INTO respuestas (id_pregunta, id_usuario, pregunta, alt1, alt2, alt3, alt4) VALUES ('$id_pregunta', '$id_usuario', '$pregunta', '$alt1', '$alt2', '$alt3', '$alt4')";
          
          if ($conn->query($query_insert) === TRUE) {
            //echo "New record created successfully";
            //header("location:homeAdmin.php");
          }
          else {
            echo "Error: " . $query_insert . "<br>" . $conn->error;
          }
          
        }
      } else {
        echo "0 results";
      }
  }
    header("location:homeAdmin.php");
  }
  else {
    echo "0 results";
  }
  

?>