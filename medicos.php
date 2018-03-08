<?php
  include("includes/conexion.php");
        session_start();
  if(!empty($_SESSION['valueuser'])){


     }
     else{
  include("includes/error_nologin.php");

     }
      $linkmedico = "menu_medicos.php?V=".urlencode(base64_encode("variable"));

?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Médicos - LACE</title>
<link rel="shortcut icon" href="img/icon.png">
<?php      
if (!isset($_GET['V']) && !isset($_GET['m']) ){

   include("includes/error_nologin.php"); 
  }


  else{?>
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

  $con = mysqli_connect($host, $user, $pwd, $db);

  if (mysqli_connect_errno()) {
    echo "Falló la conexión: ".mysqli_connect_error();
    }

    foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
/*Verifica si el campo busca esta vacio*/
    if(empty($_GET['m'])){
            $pac = ' ';
               $_SESSION['valueF'] = 'MEDICOS';
          }

    else{
        $pac = $_GET['m'];
               $_SESSION['valueF'] = 'MEDICOSUP';
               $_SESSION['idup'] = $pac;
        }

        $sql = "SELECT *
                  FROM medicos
                  WHERE idmedicos = '$pac'" ;

         $query  = mysqli_query($con, $sql);
         $fila   = mysqli_fetch_array($query, MYSQLI_ASSOC);
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
          <a href="<?php echo $linkmedico; ?>">
	        <img src="img/logo2.png" id="logo" title="Menu anterior">
        </a>
        </p>

    </li>

    <li>
      <h1>M&eacute;dicos</h1>
    </li>
  </ul>
</nav>

  <form action="guarda.php" method="post" autocomplete="off">

  <div class="col-2">
    <label>
      Nombre
      <input  name="nombre_m" tabindex="1" required value="<?php echo utf8_encode($fila['nombre']); ?>">
    </label>
  </div>
 <div class="col-2">
    <label>
      Domicilio Médico
      <input  name="domicilio_m" tabindex="2" required value="<?php echo utf8_encode($fila['domicilio_medi']); ?>">
    </label>
  </div>
  <div class="col-3">
    <label>
      Ciudad
      <input  name="ciudad_m" tabindex="3" value="<?php echo utf8_encode($fila['ciudad_medi']); ?>">
    </label>
  </div>
  <div class="col-3">
    <label>
      Estado
      <input  name="estado_m" tabindex="4" value="<?php echo utf8_encode($fila['estado_medi']); ?>">
    </label>
  </div>
  <div class="col-3">
    <label>
      Teléfono
       <input  name="telefono_m" tabindex="5" required  placeholder="XXX XXX XX XX" value="<?php echo utf8_encode($fila['telefono_medi']); ?>" pattern="[0-9 | \s]*">
  </div>

  <div class="col-3">
    <label>
      Nombre del Hospital
      <input  name="nombre_h" tabindex="6" value="<?php echo utf8_encode($fila['hospital']); ?>">
    </label>
  </div>
  <div class="col-3">
    <label>
      Domicilio Hospital
      <input  name="domicilio_h" tabindex="7" value="<?php echo utf8_encode($fila['direccion_hospital']); ?>">
    </label>
  </div>
 <div class="col-3">

        <label>

          Email

          <input  name="email" tabindex="6" type="email" placeholder="nombre@dominio.com" value="<?php 

          if ($fila != null ){echo utf8_encode($fila['email']);} ?>">

        </label>

      </div>
  <div class="col-submit">
    <button class="submitbtn">Guardar</button>
  </div>

  </form>
  </div>
<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
</body>
</html>
