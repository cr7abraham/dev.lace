<?php
  include("includes/conexion.php");

  session_start();
   $_SESSION['valueF'] = 'PRODUCTOS';
   $con = mysqli_connect($host, $user, $pwd, $db);
            if (mysqli_connect_errno()) {
          echo "Falló la conexión:".mysqli_connect_error();
              }
foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

 $linkproductos = "menu_productos.php?V=".urlencode(base64_encode("variable"));
 $prod = 0;
if ($_GET['prod'] != '0'){
 $prod = $_GET['prod'];
  $sql    = "SELECT * FROM inventario where idinventario = '$prod' ";
   $query  = mysqli_query($con, $sql);
   $fila   = mysqli_fetch_array($query, MYSQLI_ASSOC);
 
    $fechastock = utf8_encode($fila['fechastock']);
         if ($fechastock != null) {
            list($añofechastock, $mesfechastock, $diafechastock) = explode('-', $fechastock);
        }
        else{
          $añofechastock = '';
          $mesfechastock = '';
          $diafechastock = '';
        }

         $fechainicio = utf8_encode($fila['fechainicio']);
         if ($fechainicio != null) {
            list($añofechainicio, $mesfechainicio, $diafechainicio) = explode('-', $fechainicio);
        }
        else{
          $añofechainicio = '';
          $mesfechainicio = '';
          $diafechainicio = '';
        }
        $fechatermino = utf8_encode($fila['fechatermino']);
         if ($fechatermino != null) {
            list($añofechatermino, $mesfechatermino, $diafechatermino) = explode('-', $fechatermino);
        }
        else{
          $añofechatermino = '';
          $mesfechatermino = '';
          $diafechatermino = '';
        }

        $fechacaducidad = utf8_encode($fila['fechacaducidad']);
         if ($fechacaducidad != null) {
            list($añofechacaducidad, $mesfechacaducidad, $diafechacaducidad) = explode('-', $fechacaducidad);
        }
        else{
          $añofechacaducidad = '';
          $mesfechacaducidad = '';
          $diafechacaducidad = '';
        }

   $query1 = $con -> query ("SELECT idproveedores FROM inventario where idinventario = '$prod' ");
    $idproveedor1 = mysqli_fetch_array($query1);

   $query2 = $con -> query ("SELECT idproveedores, nombre FROM proveedores where idproveedores = '$idproveedor1[idproveedores]' ");
         $nombreproveedor1 = mysqli_fetch_array($query2);
        // echo '<option value="'.$valores[idproveedores].'">'.$valores[nombre].'</option>';
         
  //   $sql1    = "SELECT  nombre FROM proveedores where idproveedores = '$prod' ";
   //$query1  = mysqli_query($con, $sql1);
   //$nombreproveedor1   = mysqli_fetch_array($query1, MYSQLI_ASSOC);
   // $nombreproveedor = $nombreproveedor1['nombre'];
 
//echo $nombreproveedor;
}

else{
  $prod = 0;
  $añofechastock = '';
  $mesfechastock = '';
  $diafechastock = '';
  $añofechainicio = '';
  $mesfechainicio = '';
  $diafechainicio = '';
  $añofechatermino = '';
  $mesfechatermino = '';
  $diafechatermino = '';
  $añofechacaducidad = '';
  $mesfechacaducidad = '';
  $diafechacaducidad = '';
}
?>
<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html">
  <title>Productos | LACE</title>
  <link rel="shortcut icon" href="img/icon.png">
  <?php  if(!isset($_GET['prod']) ){
   include("includes/error_nologin.php"); 
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
          <a href="<?php echo $linkproductos; ?>">
	        <img src="img/logo2.png" id="logo">
        </a>
        </p>

    </li>

    <li>
      <h1>Productos</h1>
    </li>
  </ul>
</nav>

<?php
    $filaCosto = "";
    
    $con = mysqli_connect($host, $user, $pwd, $db);
    $sqlCost   = "SELECT costo/cantidad AS cost FROM inventario WHERE idinventario='$prod'";
    $queryCost = $con -> query($sqlCost);
    while($row = mysqli_fetch_array($queryCost, MYSQLI_ASSOC))
    {
        $filaCosto = $row['cost'];
    }
?>


   <form action="guarda.php" method="post" autocomplete="off">

    <div class="col-3">
      <label>
        Nombre Producto
        <input  name="nombre_art" tabindex="1" value="<?php if($prod !=0){ echo $fila['nombre_art'];} ?>" required style="text-transform:capitalize;">
      </label>
    </div>
    <div class="col-3">
      <label>
        Cantidad
        <input  name="cantidad" value="<?php if($prod !=0){ echo $fila['cantidad'];} ?>" tabindex="2" required>
      </label>
    </div>
    <div class="col-3">
      <label>
        Costo
        <input  name="Costo" value="<?php if($prod !=0){ echo $fila['costo'];} ?>" tabindex="3" required>
      </label>
    </div>

    <div class="col-3">
      <label>
        Unidad de Medida
        <input  name="u_medida" value="<?php if($prod !=0){ echo $fila['u_medida'];} ?>" tabindex="3" required>
      </label>
  </div>
    <div class="col-3">
        <label>
          Fecha Stock
          <br><br>
        <div  id="fechastock" class="datefield">
         <input id="day" name="diafechastock" value="<?php if($diafechastock !=null){ echo $diafechastock;} ?>"  maxlength="2" placeholder="DD"  value="" required/>  /
         <input id="month" name="mesfechastock" value="<?php if($mesfechastock !=null){ echo $mesfechastock;} ?>" maxlength="2" placeholder="MM" value=""  required/> /
         <input id="year" name="aniofechastock" value="<?php if($añofechastock !=null){ echo $añofechastock;} ?>" maxlength="4" placeholder="AAAA" value=""  required/>
       </div>
        </label>
 </div>
        <div class="col-3">
          <label>
            Proveedores <?php //echo $nombreproveedor1['nombre'];  ?>
                        <br><br>
 <select id="idproveedor"  name="idproveedor" >

        <?php if($fila == 0) {?> <option   value="0"  >  Seleccionar Proveedor </option> 
        <?php  } else{
       echo '<option value="'.$nombreproveedor1[idproveedores].'">'.$nombreproveedor1[nombre].'</option>';
        }

          $query = $con -> query ("SELECT idproveedores, nombre FROM proveedores");

          while ($valores = mysqli_fetch_array($query)) {
            if($nombreproveedor1['nombre'] != $valores['nombre'] ){
            echo '<option value="'.$valores[idproveedores].'">'.$valores[nombre].'</option>';
         }
          }
        ?>
      </select>

   </div >
</label>
          <div class="col-3">
        <label>
          Fecha Inicio
          <div name="fechainicio" id="fechainicio" class="datefield"><br><br>
     <input id="day" name="diafechainicio" value="<?php if($diafechainicio !=null){ echo $diafechainicio;} ?>" maxlength="2" placeholder="DD"  value="" required/>  /
        <input id="month" name="mesfechainicio" value="<?php if($mesfechainicio !=null){ echo $mesfechainicio;} ?>"  maxlength="2" placeholder="MM" value=""  required/> /
            <input id="year" name="aniofechainicio" value="<?php if($añofechainicio !=null){ echo $añofechainicio;} ?>" maxlength="4" placeholder="AAAA" value=""  required/>

          </div>

        </label>
      </div>
          <div class="col-3">
        <label>
          Fecha Termino
          <div name="fechatermino" id="fechatermino" class="datefield"><br><br>
     <input id="day" name="diafechatermino" value="<?php if($diafechatermino !=null){ echo $diafechatermino;} ?>" maxlength="2" placeholder="DD"  value=""/>  /
        <input id="month" name="mesfechatermino" value="<?php if($mesfechatermino !=null){ echo $mesfechatermino;} ?>" maxlength="2" placeholder="MM" value="" /> /
            <input id="year" name="aniofechatermino"  value="<?php if($añofechatermino !=null){ echo $añofechatermino;} ?>" maxlength="4" placeholder="AAAA" value=""/>

          </div>

        </label>
      </div>
          <div class="col-3">
        <label>
          Fecha Caducidad
          <div name="fechacaducidad" id="fechacaducidad" class="datefield"><br><br>
     <input id="day" name="diafechacaducidad" value="<?php if($diafechacaducidad !=null){ echo $diafechacaducidad;} ?>" maxlength="2" placeholder="DD"  value="" required/>  /
        <input id="month" name="mesfechacaducidad" value="<?php if($mesfechacaducidad !=null){ echo $mesfechacaducidad;} ?>" maxlength="2" placeholder="MM" value=""  required/> /
            <input id="year" name="aniofechacaducidad" value="<?php if($añofechacaducidad !=null){ echo $añofechacaducidad;} ?>" maxlength="4" placeholder="AAAA" value=""  required/>

          </div>

        </label>
      </div>
    <div class="col-3">
      <label>
        Costo Prueba
        <input  name="costo_prueba" value="<?php if($prod !=0){ echo $filaCosto;} ?>" tabindex="9" readonly>
      </label>
    </div>
        <div class="col-3">
      <label>
        Marca
        <input  name="marca" value="<?php if($prod !=0){ echo $fila['marca'];} ?>" tabindex="10" required style="text-transform:capitalize;">
      </label>
    </div>

    <div class="col-3">
      <label>
        Prueba Kit
        <input  name="prueba_kit" value="<?php if($prod !=0){ echo $fila['prueba_kit'];} ?>" tabindex="11" required>
      </label>
    </div>

    <div class="col-submit">
      <button type="submit" class="submitbtn">Guardar</button>
    </div>
   <input name="idprod" value = "<?php echo $prod; ?>" style="display:none;">

  </form>

<script type="text/javascript">
var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
</body>
</html>
