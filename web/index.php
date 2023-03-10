<!doctype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogicInCode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php 
      $date = date('d-m-y h:i:s');
      setcookie('ip',$_SERVER['REMOTE_ADDR']);
      setcookie('fecha',$date);
    ?>
    <nav class="navbar">
      <div class="navbar-brand">
        <a href="" class="navbar-logo">LogicInCode</a>
      </div>
      <div class="navbar-links">
        <a href="./views/post.php">Posts</a>
      </div>
    </nav>
    <div class="main-section">
      <div class="image-container">
        <div class="titulo">Bienvenido a LogicInCode</div>
        <div class="descripcion">Descubre los conceptos fundamentales de la programación y empieza a crear tus propias soluciones tecnológicas.</div>
      </div>
      <div class="theory-container">
        <h2>Lenguajes procedimentales</h2>
        <p>Los lenguajes procedimentales se centran en la ejecución secuencial de instrucciones, utilizando funciones y subrutinas para dividir el programa en partes más pequeñas y manejables. Estos lenguajes a menudo se utilaizan para resolver problemas matemáticos y científicos. Ejemplos de lenguajes procedimentales incluyen:</p>
        
        <ul>
          <li>C: C es un lenguaje de programación de bajo nivel que se utiliza comúnmente para desarrollar sistemas operativos, controladores de dispositivos y software de aplicaciones. C proporciona estructuras de control de flujo como bucles y condicionales, y es conocido por su eficiencia y velocidad.</li>
          <img src="./img/c.png" alt="C" width="70%" height="70%" style="margin: 0 auto; display: block;">
          <li>Pascal: Pascal es un lenguaje de programación que se utiliza comúnmente en la enseñanza de la programación. Pascal se centra en la simplicidad y la claridad, y proporciona una sintaxis fácil de entender para los principiantes.</li>
        </ul>
        

        
        <h2>Lenguajes orientados a objetos</h2>
        <p>Los lenguajes orientados a objetos se basan en la idea de que todo en el mundo es un objeto que puede tener propiedades y métodos que se pueden utilizar para interactuar con él. La programación orientada a objetos se centra en el diseño de clases, que son plantillas para objetos, y en la definición de relaciones entre ellas para resolver problemas. Ejemplos de lenguajes orientados a objetos incluyen:</p>
        <ul>
          <li>Java: Java es un lenguaje de programación que se utiliza comúnmente para desarrollar aplicaciones de escritorio y web. Java se centra en la seguridad y la portabilidad, y se ejecuta en una máquina virtual para asegurar la compatibilidad en diferentes plataformas.</li>
          <img src="./img/java.png" alt="C" width="70%" height="70%" style="margin: 0 auto; display: block;">
          <li>Python: Python es un lenguaje de programación popular para la ciencia de datos, la inteligencia artificial y el desarrollo web. Python se centra en la legibilidad del código y la simplicidad, y es conocido por su amplia biblioteca de módulos y paquetes.</li>
          <img src="./img/py.png" alt="C" width="70%" height="70%" style="margin: 0 auto; display: block;">
        </ul>
        


        <h2>Lenguajes basados en eventos</h2>
        <p>Los lenguajes basados en eventos se basan en la idea de que las acciones del usuario o del sistema son eventos que desencadenan respuestas específicas en el programa. Los programas basados en eventos utilizan funciones de manejo de eventos para responder a las acciones del usuario o del sistema, como hacer clic en un botón o mover el ratón. Ejemplos de lenguajes basados en eventos incluyen:</p>
        <ul>
          <li>JavaScript: JavaScript es un lenguaje de programación utilizado para la programación web. JavaScript se ejecuta en el navegador del usuario y se utiliza comúnmente para crear interacciones dinámicas en la página web, como formularios y efectos visuales.</li>
          <img src="./img/js.png" alt="C" width="70%" height="70%" style="margin: 0 auto; display: block;">
          <li>Visual Basic: Visual Basic es un lenguaje de programación utilizado para desarrollar aplicaciones de escritorio. Visual Basic se centra en la facilidad de uso y se utiliza comúnmente para crear aplicaciones de productividad y negocios que se integran con otras aplicaciones de Microsoft.</li>
          <img src="./img/vb.png" alt="C" width="70%" height="70%" style="margin: 0 auto; display: block;">
        </ul>

        
        <h2>Conclusión</h2>
        <p>En resumen, mientras que la programación procedimental se centra en la resolución de problemas a través de estructuras de control de flujo y manipulación de datos, la programación orientada a objetos se centra en la definición de objetos y la definición de relaciones entre ellos para resolver problemas. La programación basada en eventos, por su parte, se enfoca en la respuesta a acciones específicas del usuario o del sistema, como una respuesta a un clic o un movimiento del ratón.</p>
      </div>
    </div>
    <footer>
      <p>&copy; 2023 LogicInCode. Todos los derechos reservados.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>