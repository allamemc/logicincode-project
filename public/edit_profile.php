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
          <h1>Editar Perfil</h1><br>
          <input type="text" name="usuario" value="<?php echo $_GET['usuario'] ?>" maxlength="50" required><br>
          <input type="text" name="descricion" style="height: 100px;" value="<?php echo $_GET['desc'] ?>"  cols="30" rows="10" maxlength="50"  required></input><br>
          <input type="file" name="imagen" value="../img/150-1503945_transparent-user-png-default-user-image-png-png.png" required><br>
          <input type="submit" name="enviar" value="Actualizar Perfil">
    </form>
    <?php
    require_once('../config/db.php');
    session_start();
    try{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['enviar'])){
                $buscar = "SELECT * FROM usuarios where usuario = '".$_POST['usuario']."'";
                $resultado = $pdo->query($buscar);
                $row = $resultado->fetch();
                if($resultado->rowCount()==1 and $row[0] != $_SESSION['token']){
                  echo "<div class='alert alert-danger' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                        Este Usuario ya existe.
                    </div>";
                  }     
              else{
                if (isset($_FILES['imagen'])) {
                    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
                    $allowed_extensions = array('jpg', 'jpeg', 'png');
                    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    if (!in_array($extension, $allowed_extensions)) {
                        echo "<div class='alert alert-warning' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                        La extensión no esta permitida
                    </div>";
                    } else {
                      try{
                        $stmt = $pdo->prepare("call actualizar_perfil(?,?,?,?)");
                        $stmtu = $pdo->prepare("call actualizar_perfil2('".$_POST['usuario']."',".$_SESSION['token'].")");
                        
                        $stmt->bindParam(1, $_POST['usuario']);
                        $stmt->bindParam(2, $_POST['descricion']);
                        $stmt->bindParam(3, $imagen, PDO::PARAM_LOB);
                        $stmt->bindParam(4, $_SESSION['token']);
                        $stmtu->execute();
                        $stmt->execute();
                        
                        echo "<div class='alert alert-success' role='alert' style='width:400px; margin:0 auto; margin-top:20px;'>
                        Se ha actualizado su perfil correctamente.
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