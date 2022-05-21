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
      
      //$query_select = "SELECT * FROM preguntas";
      $query_select = "SELECT * FROM preguntas ORDER BY RAND() LIMIT 3"; //Asignacion Random de preguntas
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
          
          $ans1 = $row['ans1'];
          $ans2 = $row['ans2'];
          $ans3 = $row['ans3'];
          $ans4 = $row['ans4'];
          
          $cant = $ans1 + $ans2 + $ans3 + $ans4;
          
          $query_insert = "INSERT INTO respuestas (id_pregunta, id_usuario, pregunta, alt1, alt2, alt3, alt4, ans1, ans2, ans3, ans4, cant) VALUES ('$id_pregunta', '$id_usuario', '$pregunta', '$alt1', '$alt2', '$alt3', '$alt4', '$ans1', '$ans2', '$ans3', '$ans4', '$cant')";
          
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
    header("location:homeAdmin.php?mensaje=ok");
  }
  else {
    echo "0 results";
  }
  

?>