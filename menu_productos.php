<?php
      header('Content-Type: text/html; charset=iso-8859-1');
      echo htmlspecialchars("", ENT_QUOTES, 'utf-8');
         session_start();
        $_SESSION['me'] ="";
  if(empty($_SESSION['valueuser'])){


  include("includes/error_nologin1.php");

     }
      $linkvacio = "productos.php?prod=".urlencode(base64_encode(0));

        if(!isset($_GET['V']) && !isset($_GET['busca']) ){
   include("includes/error_nologin1.php");
  }
  $linkmenu  = "menu.php?V=".urlencode(base64_encode('variable'));
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Men&uacute; Productos | LACE </title>
  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">
  <link rel="shortcut icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" media="all" href="css/styles-menu.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/switchery.min.css">
  <script type="text/javascript" src="js/switchery.min.js"></script>
  <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap-switch.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap-switch.min.css">
  <style>
  .text {font-size:10; font-family:Arial, Tahoma, sans-serif; color:#0072C6; text-decoration:none}
  .text:hover {font-size:10; font-family:Arial, Tahoma, sans-serif; color:#005B99; text-decoration:none}
  </style>
  <script type="text/javascript" src="js/script.js"></script>
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
          <a href="<?php echo $linkmenu ; ?>">
            <img src="img/logo2.png"  id="logo" title="Menu anterior">
          </a>
        </p>

    </li>

    <li>
      <h1>Productos</h1>
    </li>
      <p>
        <form name="formulario" action="" onSubmit="enviarDatos(); return false" autocomplete="off">
          <li><input type="text" placeholder="Buscar..." name="busca" id="busca"></li>
        </form>
      </p>
    <li>
      <a href="<?php echo $linkvacio ?>" class="add"><img src="img/addprod.png" title="Agregar Productos"></a>
    </li>
  </ul>
</nav>


      <table class="sortable" id="sorter">
        <tr>
          <th>Folio</th>
          <th>Nombre</th>
          <th>Fecha Stock</th>
          <th>Fecha Inicio</th>
          <th>Fecha T&eacute;rmino</th>
          <th>Fecha Caducidad</th>
          <th>Ficha</th>
          <!-- th class="nosort">Agregar</th -->
        </tr>

<?php
  include("includes/conexion.php");

  $con = mysqli_connect($host, $user, $pwd, $db);
  $paginationCtrls = '';
  if (mysqli_connect_errno()) {
    echo "Falló la conexión: ".mysqli_connect_error();
    }
/*Verifica si el campo busca esta vacio*/
    if(empty($_GET['busca'])){
              $sql = "SELECT
              count(idinventario)
              FROM inventario";
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

      $sql = "SELECT  idinventario,
                      nombre_art,
                      fechastock,
                      fechainicio,
                      fechatermino,
                      fechacaducidad
              FROM inventario
              ORDER BY idinventario
              ASC $limit";
      $query = mysqli_query($con, $sql);



      if($last != 1){
          if($pagenum > 1){
            $previous = $pagenum - 1;
            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Anterior</a> &nbsp; &nbsp; ';

            for($i = $pagenum-4; $i < $pagenum; $i++){
                if($i > 0){
                    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
                }
	          }
          }

          $paginationCtrls .= ''.$pagenum.' &nbsp; ';

          for($i = $pagenum+1; $i <= $last; $i++){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		        if($i >= $pagenum+4){
			          break;
		        }
	        }

          if ($pagenum != $last) {
                $next = $pagenum + 1;
                $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Siguiente</a> ';
          }
      }

    }
    else{
        $pac = $_GET['busca'];
        $search = '%'.$pac.'%';

        $sql = "SELECT
                      idinventario,
                      nombre_art,
                      fechastock,
                      fechainicio,
                      fechatermino,
                      fechacaducidad
                  FROM inventario
                WHERE nombre_art LIKE '$search'" ;
                $query = $con -> query($sql);
        }



         while ($fila = mysqli_fetch_array($query, MYSQLI_ASSOC)){
         $nombre = $fila['nombre_art'];
         $idprod = $fila['idinventario'];
         $link = "productos.php?prod=".urlencode(base64_encode($idprod));
 ?>
        <tr>
          <td><?php echo $idprod; ?></td>
          <td><?php echo $nombre; ?></td>
          <td><?php echo $fila['fechastock']; ?></td>
          <td><?php echo $fila['fechainicio']; ?></td>
          <td><?php echo $fila['fechatermino']; ?></td>
          <td><?php echo $fila['fechacaducidad']; ?></td>
          <td><a class="text" href= "<?php echo $link?>"><strong class="text">Ver</strong></a> </td>
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
