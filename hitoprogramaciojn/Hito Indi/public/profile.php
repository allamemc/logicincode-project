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
      <div class="navbar-links">
        <a href="./add_post.php">Crea tu Post</a>
      </div>
    </nav>
    <div class="tupagina">
        <div class="perfil">
        <?php
        session_start();
        require_once('../config/db.php');
        if(isset($_GET['id_post'])){
                $pdo->query("call eliminar_post(".$_GET['id_post'].")");
                header('Location:./profile.php');
                exit;
        }
        if(isset($_GET['id']) and $_GET['id'] != $_SESSION['token']){
            $consultau = "SELECT * FROM usuarios WHERE id = ".$_GET['id']."";
            $resultadou = $pdo->query($consultau);
            $row = $resultadou->fetch();
            $consulta2 = "SELECT fotoperfil FROM usuarios WHERE id = ".$_GET['id']."";
            $resultado2 = $pdo->query($consulta2);
            $foto = $resultado2->fetch();
            if($foto['fotoperfil'] == null){
                echo "<div class='dot' style='background-image: url(\"../img/150-1503945_transparent-user-png-default-user-image-png-png.png\"');'>
                </div>";
            }else{
                $imagen = $foto['fotoperfil'];
                $imagen_string = stream_get_contents($imagen);
                $imagen_codificada = base64_encode($imagen_string);
                $url_imagen = 'data:image/jpeg;base64,' . $imagen_codificada;
                echo "<div class='dot' style='background-image: url(\"{$url_imagen}\"');'>
                </div>";
            }
            echo"
            <div class='nombre'>
            ".$row['usuario']."
            </div>
            <div class='descripcionn'>
            ".$row['descripcion']."
            </div>";
        }else{
            $consultau = "SELECT * FROM usuarios WHERE id = ".$_SESSION['token']."";
            $resultadou = $pdo->query($consultau);
            $row = $resultadou->fetch();
            $consulta2 = "SELECT fotoperfil FROM usuarios WHERE id = ".$_SESSION['token']."";
            $resultado2 = $pdo->query($consulta2);
            $foto = $resultado2->fetch();
            if($foto['fotoperfil'] == null ){
                echo "<div class='dot' style='background-image: url(\"../img/150-1503945_transparent-user-png-default-user-image-png-png.png\"');'>
                </div>";
            }else{
                $imagen = $foto['fotoperfil'];
                $imagen_string = stream_get_contents($imagen);
                $imagen_codificada = base64_encode($imagen_string);
                $url_imagen = 'data:image/jpeg;base64,' . $imagen_codificada;
                echo "<div class='dot' style='background-image: url(\"{$url_imagen}\"');'>
                </div>";
            }
            
            echo"
            <div class='nombre'>
            ".$row['usuario']."
            </div>
            <div class='descripcionn'>
            ".$row['descripcion']."
            </div>
            <a href='./edit_profile.php?usuario=".$row['usuario']."&desc=".$row['descripcion']."' style='text-decoration:none; text-align:center;'>
                <ion-icon name='create' class='ieditar' alt='Editar'></ion-icon>
            </a>";  
        }
        ?>
        </div>
        <div class="post">
            <?php
            if(isset($_GET['id']) and $_GET['id'] != $_SESSION['token']){
                $consulta = "SELECT * FROM posts WHERE id = ".$_GET['id']."";
                $resultado = $pdo->query($consulta);
                if($resultado->rowCount() == 0){
                    echo "<div class='mensaje a'>Parece que aquí no hay nada</div>";
                }else{
                    echo "<div class='mensaje a'>Posts</div>";
                }
                while($raw = $resultado->fetch()){
                echo"
                <div class='caja'>
                    <div class='textos'>
                        <h1>".$raw['usuario']."</h1>
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
                    </div>";
                    if($_SESSION['token'] == $raw['id']){
                        echo"
                        <div class='botones'>
                        <a href='edit_post.php?id_post=".$raw['id_post']."&tema=".ucfirst($raw['tema'])."&desc=".$raw['descripcion']."' class='editame' >Editar</a>
                        <a href='profile.php?id_post=".$raw['id_post']."' class='editame e'>Eliminar</a>
                        </div>";
                    }
                    echo"</div>";
                } 


            }else{
                $consulta = "SELECT * FROM posts WHERE id = ".$_SESSION['token']."";
                $resultado = $pdo->query($consulta);
                if($resultado->rowCount() == 0){
                    echo "<div class='mensaje a'><a href='./add_post.php'>Crea Posts</a> y habla con la comunidad</div>";
                }else{
                    echo "<div class='mensaje a'>Tus Posts</div>";
                }
                while($raw = $resultado->fetch()){
                echo"
                <div class='caja'>
                    <div class='textos'>
                        <h1>".$raw['usuario']."</h1>
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
                    </div>";
                    if($_SESSION['token'] == $raw['id']){
                        echo"
                        <div class='botones'>
                        <a href='edit_post.php?id_post=".$raw['id_post']."&tema=".ucfirst($raw['tema'])."&desc=".$raw['descripcion']."' class='editame' >Editar</a>
                        <a href='profile.php?id_post=".$raw['id_post']."' class='editame e'>Eliminar</a>
                        </div>";
                    }
                    echo"</div>";
                } 
            }
               
            ?>
        </div>
    </div> 
    
    <footer>
      <p>&copy; 2023 LogicInCode. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>