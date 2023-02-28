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
          <h1>Login</h1><br>
          <input type="email" name="email" placeholder="Correo" required><br>
          <input type="password" name="password" placeholder="Contraseña" minlength="6" required><br>
          <input type="submit" name="enviar">
          <div>¿No tienes una cuenta? <a href="./register.php">Regístrate!!</a> </div>
    </form>
    <?php
    require_once("../config/db.php");
    try{
    
    if(isset($_POST['enviar'])){
      $email = strtolower($_POST['email']);
        $ac = "SELECT * FROM comprobar()";
        $resultado_ac = $pdo->query($ac);
        $acr = $resultado_ac->fetch();
        if(md5($email) == $acr[0] and md5($_POST['password']) == $acr[1]){
          echo "<div class='alert alert-success' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                    Bienvenido de nuevo admin!
          </div>";
          session_start();
          $_SESSION['token'] = 'admin';
        }else{
          $consulta = "SELECT * FROM usuarios WHERE email = '".$email."' AND contraseña = MD5('".$_POST['password']."')";
          $resultado_login = $pdo->query($consulta);
          if($resultado_login->rowCount() == 1){
              $row = $resultado_login->fetch();
              echo "<div class='alert alert-success' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                      Bienvenido de vuelta ".ucfirst($row[1])."!
                    </div>";
              session_start();
              $_SESSION['token'] = $row[0];
          }else{
              echo "<div class='alert alert-danger' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                      Email o Contraseña Incorrectos!
                    </div>";
          }
        }
        
    }
  }catch(Exception $e){
    echo "<div class='alert alert-danger' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
    Uno de los campos tiene caracteres prohibidos.
    </div>";
  }
    ?>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>