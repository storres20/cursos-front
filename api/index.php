<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- CSS Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <link rel="stylesheet" href="./style.css">
  
  <title>Login</title>
</head>
<body>
  <div class="row mt-5">
    <div class="col-1 col-sm-1 col-md-3 col-lg-4"></div>
    <div class="col-10 col-sm-10 col-md-6 col-lg-4">
      <form id="formulario" method="post" action="validalogin.php?op=in">
        <h1><strong>Login</strong></h1>
        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="usuario" required="true" maxlength="10" minlength="3">
        <br>
        <input type="password" name="password" id="password" class="form-control" placeholder="password" required="true" maxlength="10" minlength="3">
        <br>
        <button type="submit" class="btn btn-primary">Ingresar</button>
        
        <br><br>
        <div id="alerta"></div>
        
      </form>
    </div>
    <div class="col-1 col-sm-1 col-md-3 col-lg-4"></div>
  </div>
  
  
  
  
  <!-- JS Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>