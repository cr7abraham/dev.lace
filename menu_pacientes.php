<?php

      header('Content-Type: text/html; charset=iso-8859-1');
      date_default_timezone_set('America/Mexico_City');
      echo htmlspecialchars("", ENT_QUOTES, 'utf-8');

        session_start();

        $_SESSION['me'] ="";

  if(empty($_SESSION['valueuser'])){





  include("includes/error_nologin1.php");



     }



  $linkpaciente = "pacientes.php?V=".urlencode(base64_encode('variable'));
  //$linkestudio = "menu_estudios.php?V=".urlencode(base64_encode('variable'));
  $linkestudio = "view.php";

  $linkmenu  = "menu.php?V=".urlencode(base64_encode('variable')); 

      if(!isset($_GET['V']) && !isset($_GET['busca'])){ 

      include("includes/error_nologin1.php");

  }

?>

<!doctype html>

<html lang="es">

<head>

<meta charset="utf-8">

  <meta http-equiv="Content-Type" content="text/html">

  <title>Men&uacute; Pacientes | LACE </title>

  <link rel="shortcut icon" href="img/icon.png">

  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">

  <link rel="stylesheet" type="text/css" media="all" href="css/styles-menu.css">

  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">

  <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap-switch.css">

  <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap-switch.min.css">

  <link rel="stylesheet" type="text/css" media="all" href="css/paginacion.css">

  <script type="text/javascript" src="js/switchery.min.js"></script>

  <script src="js/jquery.min.js"></script>

  <script type="text/javascript" src="js/script.js"></script>

  <style>

  .text {font-size:10; font-family:Arial, Tahoma, sans-serif; color:#0072C6; text-decoration:none}

  .text:hover {font-size:10; font-family:Arial, Tahoma, sans-serif; color:#005B99; text-decoration:none}

  </style>

  <!-- Pantalla de carga-->

  <script type="text/javascript">

    window.onload = detectarCarga;

      function detectarCarga(){

        document.getElementById("cargando").style.visibility="hidden";

      }

  </script>

  <!-- Pantalla de carga-->

</head>



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

          <a href="<?php echo $linkmenu; ?>">

            <img src="img/logo2.png"  id="logo" title="Menu anterior">

          </a>

        </p>



    </li>



    <li>

      <h1>Pacientes</h1>

    </li>

      <p>

        <form name="formulario" action="" onSubmit="enviarDatos(); return false" autocomplete="off">

          <li><input type="text" placeholder="Buscar..." name="busca" id="busca"></li>

        </form>

      </p>

    <li>

      <a href="<?php echo $linkpaciente; ?>" class="add2"><img src="img/addpac.png" title="Agregar paciente"></a>
      <a href="<?php echo $linkestudio; ?>" class="add2" style="margin-left: 40px;"><img src="img/estudio.png" title="Menu estudios"></a>

    </li>

  </ul>

</nav>





      <table class="sortable" id="sorter" >

        <tr>

          <th>Folio</th>

          <th>Nombre</th>

          <th class="nosort">Perfil</th>

          <th class="nosort">An&aacute;lisis</th>

        </tr>



<?php

  include("includes/conexion.php");
  $con = "";

  $con = mysqli_connect($host, $user, $pwd, $db);

  $contar = "SHOW TABLES LIKE 'contador'";
  $contador_show = mysqli_query($con, $contar);
  $num = mysqli_num_rows($contador_show);
  
  
  if($num != 0){
    $drop_view = " DROP VIEW contador";
    mysqli_query($con, $drop_view);
  }

  
  $contarStudio = "SHOW TABLES LIKE 'view_studio'";
  $contador_studio = mysqli_query($con, $contarStudio);
  $numStudio = mysqli_num_rows($contador_studio);
  if($numStudio != 0){
   
    $drop_view_studio = " DROP VIEW view_studio";
    mysqli_query($con, $drop_view_studio);
  }

  $paginationCtrls = '';

  if (mysqli_connect_errno()) {

        echo "Falló la conexión: ".mysqli_connect_error();

        }

  if(empty($_GET['busca'])){



      $sql = "SELECT

              count(idpacientes)

              FROM pacientes";

      $result = mysqli_query($con, $sql);

      $row = mysqli_fetch_row($result);

      $rows = $row[0];

      $page_rows = 15;



      $last= ceil($rows/$page_rows);



      if($last < 1){

        $last = 1;

      }



      $pagenum = 1;



      if(isset($_GET['pn'])){

      	  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);

      }



      if ($pagenum < 1) {

        $pagenum = 1;

      } else if ($pagenum > $last) {

        $pagenum = $last;

      }



      $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;



      $sql = "SELECT  idpacientes,

                      nombre

              FROM    pacientes

              ORDER BY idpacientes

              ASC $limit";

      $query = mysqli_query($con, $sql);







      if($last != 1){

          if($pagenum > 1){

            $previous = $pagenum - 1;

            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'&V='.urlencode(base64_encode('variable')).'">Anterior</a> &nbsp; &nbsp; ';



            for($i = $pagenum-4; $i < $pagenum; $i++){

                if($i > 0){

                    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&V='.urlencode(base64_encode('variable')).'">'.$i.'</a> &nbsp; ';

                }

	          }

          }



          $paginationCtrls .= ''.$pagenum.' &nbsp; ';



          for($i = $pagenum+1; $i <= $last; $i++){

		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&V='.urlencode(base64_encode('variable')).'">'.$i.'</a> &nbsp; ';

		        if($i >= $pagenum+4){

			          break;

		        }

	        }



          if ($pagenum != $last) {

                $next = $pagenum + 1;

                $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'&V='.urlencode(base64_encode('variable')).'">Siguiente</a> ';

          }

      }



    }else{

          $pac = $_GET['busca'];

          $search = '%'.$pac.'%';

          $sql = "SELECT

                   idpacientes,

                   nombre

                  FROM pacientes

                  WHERE nombre LIKE '$search'" ;

          $query = $con -> query($sql);

    }













      while ($fila = mysqli_fetch_array($query, MYSQLI_ASSOC)){

        $nombre = $fila['nombre'];

        $idpac = $fila['idpacientes'];

        $ver = "pacientes.php?p=".urlencode(base64_encode($idpac));

        $agregar = "analisis.php?p=".urlencode(base64_encode($idpac))."&pro=".urlencode(base64_encode("0"));

        $vera = "view.php?p=".$idpac;
        /*
        $sqlC = " CREATE VIEW contador as SELECT	*
                              FROM analisis
                              WHERE pacientes_idpacientes = '$idpac' 
                              group by idpropio;";
        $result = mysqli_query($con, $sqlC);
*/
        

 ?>

        <tr>

          <td><?php echo $fila['idpacientes']; ?></td>

          <td><?php echo $nombre; ?></td>



          <?php $idpaciente = $fila['idpacientes'];  ?>

          <td><a class="text" href= "<?php echo $ver?>"><strong>Ver</strong></a> </td>

          <td>
            <!--a class="text" href= "<?php //echo $agregar?>"><strong>Agregar</strong></a><strong class="text"> | </strong-->

            <a class="text" href= "<?php  echo $vera;?>"><strong>Ver</strong></a> </td>



        </tr>



<?php }

  mysqli_close($con);

?>

      </table>



    <div id="pagination_controls">

      <?php echo $paginationCtrls; ?>

    </div>





<script type="text/javascript">

var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));



elems.forEach(function(html) {

  var switchery = new Switchery(html);

});

</script>



<script type="text/javascript">

  var sorter=new table.sorter("sorter");

  sorter.init("sorter",0);

</script>



</body>

</html>

