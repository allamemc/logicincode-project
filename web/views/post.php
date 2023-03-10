<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogicInCodee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar">
      <div class="navbar-brand">
        <a href="../index.php" class="navbar-logo">LogicInCode</a>
      </div>
      <?php
        session_start();
        if(isset($_SESSION['token'])){
          if($_SESSION['token']== 'admin'){
            echo "<div class='navbar-links l'>
            <a href='../users/logout.php'><ion-icon name='log-out-outline'></ion-icon></a>
            </div>";
          }else{
            echo "<div class='navbar-links'>
              <a href='../public/add_post.php'>Crea tu Post</a>
            </div>";
            echo "<div class='navbar-links l'>
            <a href='../users/logout.php'><ion-icon name='log-out-outline'></ion-icon></a>
            </div>";
          }
        }else{
            echo "<div class='navbar-links'>
            <a href='../users/login.php'>Login</a>
          </div>
          <div class='navbar-links a'>
            <a href='../users/register.php'>Registro</a>
          </div>";
        }
        ?>
    </nav>
    <div class="posts">
      
    <?php
    require_once('../config/db.php');
        if(isset($_SESSION['token'])){
            if($_SESSION['token']== 'admin'){
              echo "
            <div class='aside'>
              <div class='navbar-links mispost'>
                <a href='../private/panel.php'>Panel de Control</a>
              </div>
            </div>";
            }else{
              echo "
            <div class='aside'>
              <div class='navbar-links mispost'>
                <a href='../public/profile.php'>Mi Perfil</a>
              </div>
            </div>";
            }
            
            $consulta = "SELECT * FROM posts ORDER BY fecha DESC";
            $resultado = $pdo->query($consulta);
            echo "<div class='post'>";
            if($resultado->rowCount() == 0){
              if($_SESSION['token'] == 'admin'){
                echo "<div class='mensaje a'>Los usuarios no han publicado nada</div>";
              }else{
                echo "<div class='mensaje a'>Aún no hay Posts, <a href='../public/add_post.php'>empieza tú.</a></div>";
              }
              
            }else{
                echo "<div class='mensaje a'>Últimos Posts</div>";
            }
            while($raw = $resultado->fetch()){
              echo"
              <div class='caja'>
                  <div class='textos'>
                    <a href='../public/profile.php?id={$raw['id']}'  style='text-decoration:none; color:#70798C; '><h1 class='kikos'>".$raw['usuario']."</h1></a>
                    <h2>".ucfirst($raw['tema'])."</h2>
                    <div>".$raw['descripcion']."</div>
                  </div>";
                  $stmt = $pdo->prepare("SELECT imagen FROM posts WHERE id_post = ?");
                  $stmt->bindParam(1, $raw['id_post'], PDO::PARAM_INT);
                  $stmt->execute();
                  $row = $stmt->fetch();
                  $imagen = $row['imagen'];
                  $imagen_string = stream_get_contents($imagen);
                  $imagen_codificada = base64_encode($imagen_string);
                  $url_imagen = 'data:image/jpeg;base64,' . $imagen_codificada;
                  echo "
                  <div class='imagenes' style='background-image: url(\"{$url_imagen}\"');'>
                  </div>
                </div>
              ";
            } 
            echo "</div>";
            
        }else{
            echo "<div class='aside'>
            <div class='mensaje2'><a href='../users/login.php'>Inicie sesión</a> para poder ver estos campos</div>
            </div>";
            echo "
            <div class='post'>
            <div class='mensaje a'><a href='../users/login.php'>Inicie Sesión</a> para ver nuestros posts</div>
              <div class='caja a'>
                <div class='textos'>
                  <h1>Juan</h1>
                  <h2>Tema</h2>
                  <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, cumque qui similique odio est ipsam laudantium perspiciatis minima cum officia ea maxime architecto eligendi placeat voluptatibus odit! Repellendus vitae non earum excepturi accusantium illo velit sit officiis dolor? Quam, a.Lorem ipsum dolor sit amet consect</div>
                </div>
                <div class='imagenes' style='background-image: url(\"https://wallpaperaccess.com/full/99810.jpg\"');'>
                </div>
              </div>
              <div class='caja a'>
                <div class='textos'>
                  <h1>Pedro</h1>
                  <h2>Tema</h2>
                  <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, cumque qui similique odio est ipsam laudantium perspiciatis minima cum officia ea maxime architecto eligendi placeat voluptatibus odit! Repellendus vitae non earum excepturi accusantium illo velit sit officiis dolor? Quam, a.Lorem ipsum dolor sit amet consect</div>
                </div>
                <div class='imagenes' style='background-image: url(\"https://assets.hongkiat.com/uploads/minimalist-dekstop-wallpapers/4k/original/12.jpg?3\"');'>
                
                </div>
              </div>
              <div class='caja a'>
                <div class='textos'>
                  <h1>Luis</h1>
                  <h2>Tema</h2>
                  <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, cumque qui similique odio est ipsam laudantium perspiciatis minima cum officia ea maxime architecto eligendi placeat voluptatibus odit! Repellendus vitae non earum excepturi accusantium illo velit sit officiis dolor? Quam, a.Lorem ipsum dolor sit amet consect</div>
                </div>
                <div class='imagenes' style='background-image: url(\"https://wallpapercave.com/wp/wp5642204.jpg\"');>
                
                </div>
              </div>
              <div class='caja a'>
                <div class='textos'>
                  <h1>Jose</h1>
                  <h2>Tema</h2>
                  <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, cumque qui similique odio est ipsam laudantium perspiciatis minima cum officia ea maxime architecto eligendi placeat voluptatibus odit! Repellendus vitae non earum excepturi accusantium illo velit sit officiis dolor? Quam, a.Lorem ipsum dolor sit amet consect</div>
                </div>
                <div class='imagenes' style='background-image: url(\"https://wallpapers.com/images/featured/7xpryajznty61ra3.jpg\"');>
                </div>
              </div>
            </div>
            ";
        }

    ?>
      
    </div>
    <footer>
      <p>&copy; 2023 LogicInCode. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>