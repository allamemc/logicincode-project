<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogicInCode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar">
      <div class="navbar-brand">
        <a href="../index.php" class="navbar-logo">LogicInCode</a>
      </div>
      <div class="navbar-links">
        <a href="../views/post.php">Posts</a>
      </div>
    </nav>
    <div class="panel">
        <?php
        require_once('../config/db.php');
        if(isset($_GET['id'])){
          $ids = $_GET['id'];
          echo "<div class='popup'>
          <form method='post' action='' style='position:fixed;'>
            <p>¿Desea eliminar este post?</p>
            <div class='text-right'>
              <button type='submit' class='btn btn-primary' name='alerta1'>Eliminar</button>
              <button type='submit' class='btn btn-secondary' name='alerta2'>Cancelar</button>
            </div>
          </form>
          </div>";
          if(isset($_POST['alerta1'])){
            $sql = "call eliminar_post(".$ids.")";
            $registros = $pdo->exec($sql);
            header("Location: ../private/panel.php");
          }
          if(isset($_POST['alerta2'])){
            header("Location: ../private/panel.php");
          }
        }
        session_start();
        if(isset($_SESSION['token'] )){
          if($_SESSION['token'] == 'admin'){
            $consulta = "SELECT * FROM posts";
            $resultado = $pdo->query($consulta);
            echo "<div class='mensaje a'>Panel de Control</div>";
                echo("<table class='table table' style='color:black; width:100%; margin:0 auto; '>
                <thead>
                <tr>
                    <th scope='col'>ID USUARIO</th>
                    <th scope='col'>ID POST</th>
                    <th scope='col'>USUARIO</th>
                    <th scope='col'>TEMA</th>
                    <th scope='col'>FECHA</th>
                    <th scope='col'>ELIMINAR</th>
                </tr>
                </thead>
                <tbody>");
            while($row = $resultado->fetch()){
            echo("
                <tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["id_post"]."</td>
                    <td>".$row["usuario"]."</td>
                    <td>".$row["tema"]."</td>
                    <td>".$row["fecha"]."</td>
                    <td>
                    <a class='btn btn-danger' href='panel.php?id=".$row['id_post']."'><ion-icon name='trash-outline' style='font-size:17px;'</ion-icon></a>
                    </td>
                </tr>");
        
           
        }
        echo("
            </tbody>
            </table>"); 
            
          }
        }
        
         
          
  
  
  ?>
    
    </div>
    <footer style="background-color:#f7f7f7; color:black;">
      <p>&copy; 2023 LogicInCode</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>