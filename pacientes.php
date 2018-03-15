<?php
  include("includes/conexion.php");


  session_start();
  if(!empty($_SESSION['valueuser'])){


     }
     else{
  include("includes/error_nologin.php");

     }

  $linkpaciente = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));
?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Pacientes - LACE</title>


  <link rel="shortcut icon" href="img/icon.png">
      <?php       if(!isset($_GET['V']) && !isset($_GET['p'])  ){ 
      include("includes/error_nologin.php");
  }
  else { ?>

  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <?php } ?>
  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
  <script type="text/javascript" src="js/switchery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
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
    if(empty($_GET['p'])){
            $pac = ' ';
               $_SESSION['valueF'] = 'PACIENTES';
          }

    else{
        $pac = $_GET['p'];
               $_SESSION['valueF'] = 'PACIENTESUP';
               $_SESSION['idup'] = $pac;

        }

        $sql = "SELECT *
                  FROM pacientes
                  WHERE idpacientes = '$pac'" ;

         $query  = mysqli_query($con, $sql);
         $fila   = mysqli_fetch_array($query, MYSQLI_ASSOC);
         if($fila['rfc'] != null){
          $rfc = $fila['rfc'];
         }
         else{
           $rfc = 'x';
         }
         $nacimiento = utf8_encode($fila['fecha_nac']);
         if ($nacimiento != null) {
            list($año, $mes, $dia) = explode('-', $nacimiento);
        }
        else{
          $año = '';
          $mes = '';
          $dia = '';
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
          <a href="<?php echo $linkpaciente; ?>">
	        <img src="img/logo2.png" id="logo">
        </a>
        </p>

    </li>

    <li>
      <h1>Pacientes</h1>
    </li>
  </ul>
</nav>


   <form action="guarda.php" method="post" autocomplete="off">

    <div class="col-2">
      <label>
        Nombre
        <input value="<?php echo utf8_encode($fila['nombre']); ?>" style="text-transform:capitalize;"  name="nombre" tabindex="1" required >
      </label>
    </div>
    <div class="col-2">
      <label>
        Dirección
        <input  name="direccion" tabindex="2" required value="<?php echo utf8_encode($fila['direccion']); ?>" style="text-transform:capitalize;">
      </label>
    </div>

    <div class="col-4">
      <label>
        Ciudad
        <input  name="ciudad" tabindex="3" required value="<?php echo $fila['ciudad']; ?>" style="text-transform:capitalize;">
      </label>
    </div>
    <div class="col-4">
      <label>
        Estado
        <input name="estado" tabindex="4" required value="<?php echo utf8_encode($fila['estado']); ?>" style="text-transform:capitalize;">
      </label>
    </div>
    <div class="col-4">
      <label>
        Código Postal
        <input  name="cp" tabindex="5" maxlength="5" value="<?php echo utf8_encode($fila['codigo_postal']); ?>">
      </div>

            <div class="col-4">
        <label style="height: 86px;">
          Fecha de Nacimiento
          <div id="date1" class="datefield"><br><br>
            <input id="day" name="dia" maxlength="2" placeholder="DD"  value="<?php echo $dia; ?>" required/>  /
            <input id="month" name="mes" maxlength="2" placeholder="MM" value="<?php echo $mes; ?>"  required/> /
            <input id="year" name="anio" maxlength="4" placeholder="AAAA" value="<?php echo $año; ?>"  required/>
          </div>
        </label>
      </div>

      <div class="col-4">
       <label>Sexo
       <label style="height: 86px;">
         <center  style="margin-bottom:10px">
          <?php
                  if ($fila['sexo'] == 'M'){
                    $s = 'checked';
                  }
                  else{
                    $s = '';
                  }
          ?>
            <div class="onoffswitch">
              <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch"
              <?php echo $s; ?>>
              <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner"></span>

                <span class="onoffswitch-switch"></span>
              </label>
            </div>
          </center>
          </label>
      </div>

      <div class="col-4">
        <label>
          Teléfono (Fijo)
          <input  name="fijo" tabindex="6" placeholder="XXX XXX XX XX"
            value="<?php echo utf8_encode($fila['telefono']); ?>" pattern="[0-9 | \s]*">
        </label>
      </div>



      <div class="col-4">
        <label>
          Teléfono (Móvil)
          <input  name="movil" tabindex="6" placeholder="XXX XXX XX XX"
            value="<?php echo utf8_encode($fila['telefono_movil']); ?>" pattern="[0-9 | \s]*">

        </label>
      </div>

      <div class="col-4">
        <label>
          Teléfono (Oficina)
          <input  name="oficina" tabindex="6" placeholder="XXX XXX XX XX"
            value="<?php echo utf8_encode($fila['tel_oficina']); ?>" pattern="[0-9 | \s]*">

        </label>
      </div>

     <div class="col-4">
      <label>
        Tipo de sangre
        <input  name="sangre" tabindex="9" value="<?php echo $fila['tipo_sangre']; ?>">
      </label>
    </div>

      <div class="col-3">
        <label>
          Email
          <input  name="email" tabindex="8" value="<?php echo $fila['email']; ?>" type="email">
        </label>
      </div>

    <div class="col-3">
      <center id="dynamic">
        <button type="button" name="add" id="add" class="rfc">Agregar RFC</button>
      </center>
    </div>

      <center id="dynamic_field" style="margin-left: 20px;">
      </center>


    <div style="padding-left: 10px;" id="dynamic_field">
    </div>

    <div class="col-submit">
      <button type="submit" class="submitbtn">Guardar</button>
    </div>

  </form>

</body>
</html>

<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>

 <script type="text/javascript">

 $(document).ready(function(){
   var ver = <?php echo '"'.$rfc.'"' ?>;
   console.log(ver);
   if(ver != 'x'){
     $('#dynamic_field').append(
             '<div class="col-1"> <label><input placeholder="Razón Social" id="razon" name="razon" required value="<?php echo utf8_encode($fila['razonsocial']); ?>"/></div>'+
             '<div class="col-1"> <label><input placeholder="RFC" id="rfc" name="rfc" maxlength="13" required value="<?php echo utf8_encode($fila['rfc']); ?>"/></div>'+
             '<div class="col-1"> <label><input placeholder="Dirección Fiscal" id="dir_fiscal" name="fiscal" required value="<?php echo utf8_encode($fila['direccionfiscal']); ?>"/></div>');
             $('#add').remove();
             $('#dynamic').append(
             '<button type="button" name="del" id="del" class="rfc2">Quitar RFC</button>');
   }
     $(document).on('click', '.rfc', function(){
            $('#dynamic_field').append(
             '<div class="col-1"> <label><input placeholder="Razón Social" id="razon" name="razon" required value="<?php echo utf8_encode($fila['razonsocial']); ?>"/></div>'+
             '<div class="col-1"> <label><input placeholder="RFC" id="rfc" name="rfc" required value="<?php echo utf8_encode($fila['rfc']); ?>"/></div>'+
             '<div class="col-1"> <label><input placeholder="Dirección Fiscal" id="dir_fiscal" name="fiscal" required value="<?php echo utf8_encode($fila['direccionfiscal']); ?>"/></div>');
              $('#add').remove();
           $('#dynamic').append(
             '<button type="button" name="del" id="del" class="rfc2">Quitar RFC</button>');
      });

 $(document).on('click', '.rfc2', function(){
            $('#del').remove();
            $('#razon').remove();
            $('#rfc').remove();
            $('#dir_fiscal').remove();
            $('#dynamic').append(
             '<button type="button" name="add" id="add" class="rfc">Agregar RFC</button>');

      });
  });


 </script>

<script type="text/javascript">
  $('#date1 input').autotab_magic().autotab_filter('numeric');
  $('#date1 input').datepicker()
</script>
