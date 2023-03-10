<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogicInCode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar" style="width:700px;">
      <div class="navbar-brand">
        <a href="../index.php" class="navbar-logo">LogicInCode</a>
      </div>
      <div class="navbar-links">
        <a href="../views/post.php">Posts</a>
      </div>
    </nav>
    <form class="formulario" action="" method="post">
          <h1>Registro</h1><br>
          <input type="text" name="usuario" placeholder="Usuario" maxlength="12" required><br>
          <input type="email" name="email" placeholder="Correo" required><br>
          <input type="password" name="password" placeholder="Contraseña" minlength="6" required><br>
          <input type="password" name="password2" placeholder="Repita la Contraseña" minlength="6" required><br>
          <input type="submit" name="enviar">
          <div>Si ya tiene cuenta, <a href="./login.php">Inicie Sesión</a> </div>
    </form>
    <?php
    require_once('../config/db.php');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $buscar = "SELECT usuario FROM usuarios where usuario = '".$_POST['usuario']."'";
            $resultado = $pdo->query($buscar);
            if($resultado->rowCount()<1){
            if($_POST['password'] == $_POST['password2']){
                $email = strtolower($_POST['email']);
                $consultasss = "SELECT * FROM usuarios where email = '".$email."'";
                $resultadoss = $pdo->query($consultasss);
                if($resultadoss->rowCount() < 1) {
                  try{
                    $insertar="call insertar('".$_POST['usuario']."','".$email."','".$_POST['password']."')";
                    $registros = $pdo->exec($insertar);
                    echo "<div class='alert alert-success' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                    Usuario Registrado correctamente.
                    </div>";

                  }catch(Exception $e){
                    echo "<div class='alert alert-danger' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                    Uno de los campos tiene caracteres prohibidos.
                    </div>";
                  }
                    
                }else{
                    echo "<div class='alert alert-info' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                    Este usuario ya esta registrado.
                  </div>";
                } 
    
            }else{
                echo "<div class='alert alert-warning' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                Las contraseñas no coinciden!
              </div>";
            }
        }else{
          echo "<div class='alert alert-danger' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                        Este Usuario ya existe.
                    </div>";
        }
      }
    ?>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>