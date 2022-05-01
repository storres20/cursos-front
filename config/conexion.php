<?php

  // Clever-cloud - mysql
  $host = 'bjip4tf1cstzcyhhev7r-mysql.services.clever-cloud.com';
  $user = 'ugvlpqynnm7koc6u';
  $pass = 'x6IVPuAiGLzujR6ukV6A';
  $db = 'bjip4tf1cstzcyhhev7r';
  
  //$conn = mysqli_connect($host, $user, $pass, $db);
  
  // Create connection
  $conn = new mysqli($host, $user, $pass, $db);
  
  /* if ($conn) {
    echo "conectado";
  } */


?>