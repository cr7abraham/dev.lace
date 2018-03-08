<?php 
session_start();
session_destroy(); ?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>LACE LABORATORIOS</title>
  <link rel="shortcut icon" href="img/icon.png">     
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/estilo.css">



  </head>

  <body>


   <div class="login">

    <form action="comprobar.php" method="post" autocomplete="off">
      <input type="text" placeholder="Usuario" name="Usuario" class="login-input"/>
      <input type="password" placeholder="Contraseña" name="pass" class="login-input"/>
      <button type="submit" class="login-btn"></button>
    </form>
    <header class="login-header">
      <span class="text"><img src="img/logo.png" width="100%"></span>
      <span class="loader"></span>
    </header>

  </div>

  <script src="js/prefixfree.min.js"></script>
  <script src="js/index.js"></script>




</body>
</html>
