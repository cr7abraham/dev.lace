<?php

  include("includes/conexion.php");

  session_start();

  $_SESSION['valueF'] = 'USUARIO';

if(empty($_SESSION['valueuser'])){





// include("includes/error_nologin.php");



     }

  $linkusuario = "menu_usuarios.php?V=".urlencode(base64_encode("variable"));

 



?>

<!doctype html>

<html lang="en-US">

<head>

  <meta charset="utf-8">

  <meta http-equiv="Content-Type" content="text/html">

  <title>Usuarios| LACE</title>

  <link rel="shortcut icon" href="img/icon.png">

  <?php 

      if(!isset($_GET['V']) && !isset($_GET['u']) ){



  // include("includes/error_nologin.php"); 

 }

 else{ ?>

 <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">

 <?php } ?>



  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">

  <script type="text/javascript" src="js/switchery.min.js"></script>

  <!-- Pantalla de carga-->

  <script type="text/javascript">

    window.onload = detectarCarga;

      function detectarCarga(){

        document.getElementById("cargando").style.visibility="hidden";

      }

  </script>

  <!-- Pantalla de carga-->



</head>

<?php

foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

if (!empty($_GET['u'])) {

    $u = $_GET['u'];  

    $_SESSION['pass']   =  $_GET['u'];

    $u = $_GET['u'];  

    $_SESSION['valueF'] = 'USUARIOUP';

    $_SESSION['idup'] = $u;



    include('includes/alert_usuarios.php');



    $con = mysqli_connect($host, $user, $pwd, $db);  

  if (mysqli_connect_errno()) {

    echo "Falló la conexión: ".mysqli_connect_error();

    }



        $sql = "SELECT

                   u.nombre,

                   u.direccion,

                   u.telefono,

                   r.respuscol,

                   u.n_user,

                   u.email

                  FROM usuarios u

                  join respus r on u.idusuarios = r.id

                  where u.idusuarios = '$u'" ;



         $query  = mysqli_query($con, $sql);

         $fila   = mysqli_fetch_array($query, MYSQLI_ASSOC);



  }

  else{

    $fila = "";

    $u = ' ';

    $_SESSION['valueF'] = 'USUARIO';

  }



?>

<body>

<!-- Pantalla de carga-->

      <div id="cargando">

        <div class="cssload-thecube">

          <div class="cssload-cube cssload-c1"></div>

          <div class="cssload-cube cssload-c2"></div>

          <div class="cssload-cube cssload-c4"></div>

          <div class="cssload-cube cssload-c3"></div>

        </div>

      </div>

<!-- Pantalla de carga-->

<nav id="hola">

  <ul>

    <li><p>

          <a href="<?php echo  $linkusuario; ?>">

	        <img src="img/logo2.png" id="logo">

        </a>

        </p>



    </li>



    <li>

      <h1>Usuarios</h1>

    </li>

  </ul>

</nav>





   <form action="guarda.php" method="post" name="fus" autocomplete="off">



    <div class="col-3">

      <label>

        Nombre

        <input  name="nombre" tabindex="1" required value="<?php if ($fila != null ){echo utf8_encode($fila['nombre']);} ?>">

      </label>

    </div>

    <div class="col-3">

      <label>

        Dirección

        <input  name="direccion" tabindex="2" required value="<?php if ($fila != null ){echo utf8_encode($fila['direccion']);} ?>">

      </label>

    </div>



    <div class="col-3">

      <label>

        Telefono

        <input  name="telefono" tabindex="3" placeholder="(XXX) XXX XX XX" pattern="[0-9 | \s]*" value="<?php 

        if ($fila != null ){echo utf8_encode($fila['telefono']);} ?>">

      </label>

    </div>

    <div class="col-3">

      <label>

        Nombre de Usuario

        <input name="user" tabindex="4" required value="<?php if ($fila != null ){echo utf8_encode($fila['n_user']); }?>">

      </label>

    </div>

    <div class="col-3">

      <label>

        Contraseña

        <input  type="password" name="contraseña" id="contraseña" tabindex="5" required maxlength="20" minlength="6" value="<?php if ($fila != null ){echo utf8_encode($fila['respuscol']);} ?>">

      </div>

      <div class="col-3">

      <label>

        Repetir Contraseña

        <input  type="password" name="pass2" id="pass2" tabindex="5" required maxlength="20" minlength="6" value="<?php if ($fila != null ){echo utf8_encode($fila['respuscol']);} ?>">

      </div>



      <div class="col-3">

        <label>

          Email

          <input  name="email" tabindex="6" type="email" placeholder="nombre@dominio.com" value="<?php 

          if ($fila != null ){echo utf8_encode($fila['email']);} ?>">

        </label>

      </div>



    <div class="col-submit">

      <button type="submit" class="submitbtn" >Guardar</button>

    </div>



  </form>



<script type="text/javascript">

var password, password2;



password = document.getElementById('contraseña');

password2 = document.getElementById('pass2');



password.onchange = password2.onkeyup = passwordMatch;



function passwordMatch() {

    if(password.value !== password2.value)

        password2.setCustomValidity('Las contraseñas no coinciden.');

    else

        password2.setCustomValidity('');

}

</script>



<script type="text/javascript">



 $(document).ready(function(){ 

 $(document).on('click', '.submitbtn', function(){  

    document.getElementById("cargando").style.visibility="show";

      });

  }); 

     



 </script>  

</body>



</html>

