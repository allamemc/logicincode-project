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
        <a href="./profile.php">Volver</a>
      </div>
    </nav>
    <form class="formulario a" action="" method="post" enctype="multipart/form-data">
          <h1>Editar Post</h1><br>
          <input type="text" name="tema" value="<?php echo $_GET['tema'] ?>" maxlength="50" required><br>
          <textarea name="descricion" id="" cols="30" rows="10" maxlength="700" minlength="50" required><?php echo $_GET['desc'] ?></textarea><br>
          <input type="file" name="imagen" required><br>
          <input type="submit" name="enviar" value="Actualizar Post">
    </form>
    <?php
    require_once('../config/db.php');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['enviar'])){
                $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
                $allowed_extensions = array('jpg', 'jpeg', 'png');
                if (isset($_FILES['imagen'])) {
                    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, $allowed_extensions)) {
                        echo "<div class='alert alert-warning' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                        La extensión no esta permitida
                        </div>";
                    } else {
                        session_start();
                        try{
                          $consulta = "SELECT * FROM usuarios WHERE id = {$_SESSION['token']}";
                          $usuarioactual = $pdo->query($consulta);
                          $row = $usuarioactual->fetch();
                          $stmt = $pdo->prepare("call actualizar_post(".$_GET['id_post'].",'".$_POST['tema']."','".$_POST['descricion']."',?)");
                          $stmt->bindParam(1, $imagen, PDO::PARAM_LOB);
                          $stmt->execute();
                          echo "<div class='alert alert-success' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                          Se ha actualizado su post correctamente.
                          </div>";
      
                        }catch(Exception $e){
                          echo "<div class='alert alert-danger' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                          Uno de los campos tiene caracteres prohibidos.
                          </div>";
                        }
                        
                    }
                }
            }
        }
    ?>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>