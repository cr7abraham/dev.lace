<?php
      header('Content-Type: text/html; charset=iso-8859-1');
      date_default_timezone_set('America/Mexico_City');
      echo htmlspecialchars("", ENT_QUOTES, 'utf-8');
      include("includes/conexion.php");


      $con = mysqli_connect($host, $user, $pwd, $db);

  if (mysqli_connect_errno()) {
    echo "Falló la conexión: ".mysqli_connect_error();
    }
  session_start();
  if(empty($_SESSION['valueuser'])){


  include("includes/error_nologin1.php");

     }
  $id = "";
  //if($_GET['p']==null){
  //$_GET['p']=$_SESSION['p'];
//}
  if(isset($_GET['p'])){
    $id = $_GET['p'];
  }
  else{
    include('includes/alert_getp.php');
  }

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Men&uacute; An&aacute;lisis | LACE </title>
  <link rel="shortcut icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/styles-menu.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap-switch.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap-switch.min.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/paginacion.css">
  <script type="text/javascript" src="js/switchery.min.js"></script>
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
<?php
 $linkpaciente = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));


//foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
if(!isset($_GET['p']) && !isset($_GET['busca']) ){
   include("includes/error_nologin.php");
  }

  else{
//echo $id = $_GET['p'];
echo $id;

        $sql = "SELECT nombre
                  FROM pacientes
                  WHERE idpacientes = '$id'" ;

         $query  = mysqli_query($con, $sql);
         $nombre   = mysqli_fetch_array($query, MYSQLI_ASSOC);
         mysqli_close($con);
}
  if(!empty($_SESSION['valueuser'])){


     }
     else{
  include("includes/error_nologin1.php");

     } ?>
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
          <a href="<?php  echo  $linkpaciente;
                    ?>">
            <img src="img/logo2.png"  id="logo" title="Menu anterior">
          </a>
        </p>

    </li>

    <li>
      <h3>An&aacute;lisis de <?php echo $nombre['nombre']; ?></h3>
    </li>
      <p>
        <form name="formulario" action="" onSubmit="enviarDatos(); return false" autocomplete="off">
          <li><input style= "visibility:hidden;" type="text" placeholder="Buscar..." name="busca" id="busca"></li>
        </form>
      </p>
    <li>
    <form action="membrete.php" method="GET" id="f1">
       <div id="yolo" name = "yolo">
          <input type="hidden" name="array" id="array">
          <a  href= "analisis.php?p=<?php echo urlencode(base64_encode($_GET['p']))?>&pro=<?php echo urlencode(base64_encode(0)) ?>" class="add">
          <img src="img/addanalisis.png" title="Agregar analisis"></a>
          <input id="print" name = "print" value="printV" title="Imprimir" type="image" src="img/printer.png" alt="Submit" formtarget="_blank">
          <input id="email" name="email" value="emailV" title="Enviar correo" type="image" src="img/email.png" alt="Submit" formtarget="_blank">
       </div>
       </form>
    </li>

  </ul>
</nav>
<form action="membrete.php" method="GET" id="f1">

      <table class="sortable" id="sorter">
        <tr>
          <th>No.</th>
          <th>Estudio</th>
          <th >Fecha</th>
          <th class="nosort">M&eacute;dico</th>
          <th class="nosort">An&aacute;lisis</th>
          <th>Imprimir | Enviar</th>
        </tr>

<?php

  $con = mysqli_connect($host, $user, $pwd, $db);
  $paginationCtrls = '';

  $idpacientes = "";
  if(isset($_GET['p'])){
    $idpacientes = $_GET['p'];
  }
  else{
    $idpacientes = "";
  }
  if (mysqli_connect_errno()) {
        echo "Falló la conexión: ".mysqli_connect_error();
        }
  /*if(empty($_GET['busca'])){

      $sql = "SELECT count(idanalisis)
              FROM contador ";
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

      $sql = "SELECT  estudio,
                      fecha,
                      medicos_idmedicos,
                      idpropio
              FROM contador
              GROUP BY idpropio
              ASC $limit";

      $query = mysqli_query($con, $sql);



       $sqlcuenta = "SELECT
                      count(idpropio)
                      FROM analisis
                      WHERE pacientes_idpacientes = '$idpacientes'";
      $resultado = mysqli_query($con, $sqlcuenta);
      $registros = mysqli_fetch_row($resultado);
      $registros = $row[0];

      if($last != 1){
          if($pagenum > 1){
            $previous = $pagenum - 1;

            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'&p='.$idpacientes.'">Anterior</a> &nbsp; &nbsp; ';

            for($i = $pagenum-4; $i < $pagenum; $i++){
                if($i > 0){
                    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&p='.$idpacientes.'">'.$i.'</a> &nbsp; ';
                }
	          }
          }

          $paginationCtrls .= ''.$pagenum.' &nbsp; ';

          for($i = $pagenum+1; $i <= $last; $i++){

		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'&p='.$idpacientes.'">'.$i.'</a> &nbsp; ';
		        if($i >= $pagenum+4){
			          break;
		        }
	        }

          if ($pagenum != $last) {
                $next = $pagenum + 1;

                $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'&p='.$idpacientes.'">Siguiente</a> ';
          }
      }

  }*/

 //    if($registros!= null){

  $vistaq = "contador".$idpacientes;
  $sql = "SELECT  estudio,
                  fecha,
                  medicos_idmedicos,
                  idpropio
            FROM $vistaq
            GROUP BY idpropio";

      $query = mysqli_query($con, $sql);

      $idpropio = 0;
      $id_number = 1;
      while ($fila = mysqli_fetch_array($query, MYSQLI_ASSOC)){
      
      $sql1 = "SELECT idmedicos, nombre
              FROM   medicos
              where  idmedicos = '$fila[medicos_idmedicos]'";
               $query1 = mysqli_query($con, $sql1);
               $fila1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
               $idm = $fila1['idmedicos'];
               $idprop = $fila['idpropio'];
               $idpac = $_GET['p'];
               $enviar = "recupera.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm));
               $editar = "analisis.php?p=".urlencode(base64_encode($idpac))."&pro=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm));
               //$ver = "reporte.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm));


               //$ver = "php/pdf/reporte.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm));
                //$ver = "php/pdf/reporte.php?idpac=".$idpac."&idpr=".$idprop."&idm=".$idm;
                $ver = "idpac=".$idpac."&idpr=".$idprop."&idm=".$idm;


 ?>
        <tr>
        <?php if($idpropio !=  $fila['idpropio'] ) { ?>
          <td><?php echo $id_number++; ?></td>
          <td><?php echo $fila['estudio']; ?></td>
          <td><?php echo $fila['fecha']; ?></td>
          <td><?php echo $fila1['nombre']; ?> </td>
          <td>
              <a class="text" href= "<?php  echo $editar;?> " >
                <strong>Editar</strong>
              </a>
          </td>
          <td><input onchange= "changcheck(this)" type="checkbox" name="c[]" value="<?php echo $idprop;?>"></td>
          <input type="hidden" name="idpaciente" value="<?php echo $idpac;?>">

        </tr>
         <?php $idpropio = $fila['idpropio'];  } ?>

<?php }
  mysqli_close($con);
//}
?>
      </table>

      </form>

    <!--div id="pagination_controls">
      <?php //echo $paginationCtrls; ?>
    </div-->


<script type="text/javascript">
    xarray= [];
    document.getElementById("print").style.display = 'none';
    document.getElementById("email").style.display = 'none';
      function changcheck(el){

        if(el.checked){
          xarray.push(el.value);
            if(xarray.length > 0){
           document.getElementById("print").style.display = 'block';
           document.getElementById("email").style.display = 'block';
          }
          document.getElementById("array").value = xarray;
          console.log(xarray);
        }else{
          //alert(el.value+" : un-checked");
          var pos = xarray.indexOf(el.value);
          xarray.splice(pos,1);
           if(xarray.length == 0){
           document.getElementById("print").style.display = 'none';
           document.getElementById("email").style.display = 'none';
          }
          document.getElementById("array").value = xarray;
          console.log(xarray);
        }
      }
</script>
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
