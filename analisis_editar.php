<?php   include("includes/conexion.php");
         $mysqli = mysqli_connect($host, $user, $pwd, $db);
      if (mysqli_connect_errno()) {
      // echo "Falló la conexión:".mysqli_connect_error();
      }
          else{
      // echo "Error ".mysqli_error($mysqli);
       }
session_start();
  if(empty($_SESSION['valueuser'])){

  include("includes/error_nologin.php");

     }

foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
 $_SESSION['p']=$_GET['p'];
$icontador = 1;
  $cont = 1;
  $i = 1;
  $idmed = 0;?>
 
  <?php if(!isset($_GET['p'])){
  // include("includes/error_usuario1.php"); 
      include("includes/error_nologin.php");
  }
  else{

if($_GET['p']==null){
  $_GET['p']=$_SESSION['p'];
  echo  $_SESSION['p'];

}

         $sql123 = "SELECT *
                  FROM estudios" ;

$conta2 = 1;
         $query123  = mysqli_query($mysqli, $sql123);
    while ($fila = mysqli_fetch_array($query123, MYSQLI_ASSOC)){
        // $fila = mysqli_fetch_array($query123, MYSQLI_ASSOC);
 $a= $fila["prueba"];

// "id_fruta":"1","1":"Manzana","nombre_fruta":"Manzana";
 $arrayPHP [0][$conta2]=array($fila["idpropio"],$fila["prueba"],$fila["unidades"],$fila["valorreferencia"],$fila["nombre_estudio"],$fila["subtitulo"]);

$conta2 =$conta2 +1;
  }
    ?>
				   <script language='javascript'>
				  var i = 1;
          var vi = 1;
          var t = 1;
          var containterno = 0;
          var arreglo = [];
          sessionStorage.LocalToGlobalVar = i;
          sessionStorage.LocalToGlobalVar = vi;
          sessionStorage.LocalToGlobalVar = t;
          sessionStorage.LocalToGlobalVar = containterno;
           sessionStorage.LocalToGlobalVar = arreglo;
			</script>

<!doctype html>
 <html lang="en-US">
      <head>
           <title>Análisis</title>
           <script src="js/jquery.min.js"></script>
                    <?php
 $idpac = $_GET['p']; ?>
 <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <?php if ($_GET['pro'] != 0){


    $idpropio = $_GET['pro'];

    $sql    = "SELECT * FROM analisis where idpropio = '$idpropio' ";
        $query  = mysqli_query($mysqli, $sql);
        $fila = $mysqli->query($sql);
        $fil3 = $mysqli->query($sql);
        $fila1 = mysqli_fetch_array($query);
    mysqli_close($mysqli);
          ?>

    <?php    }
    else{ $fila = null;
         $fila1 = null;

       }
  }?>

           <link rel="shortcut icon" href="img/icon.png">
           <meta charset="utf-8">
           <!-- Pantalla de carga-->
           <script type="text/javascript">
             window.onload = detectarCarga;
               function detectarCarga(){
                 document.getElementById("cargando").style.visibility="hidden";
               }
           </script>

           <!-- Pantalla de carga-->
      </head>
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
<body>
<nav id="hola">
  <ul>
    <li><p>
          <a href="<?php echo $_SERVER['HTTP_REFERER'];?>">
	        <img src="img/logo2.png" id="logo" title="Menu anterior">
        </a>
        </p>

    </li>

    <li>
      <h1>An&aacute;lisis</h1>
    </li>
  </ul>
</nav>

      <div class="container">
        <div class="form-group">
          <form name="add_name" id="add_name" method="post" action="agrega_analisis.php " ALIGN=center autocomplete="off">
      
      <div class="col-3">
      <label >
        Elegir Medico
    <!--    <select id="idmedico"  name="idmedico" >
-->
<form name="add_name" id="add_name" method="post" action="agrega_analisis.php " ALIGN=center autocomplete="off">
        <select id="idmedico"  name="idmedico" >
          
          <?php
            $mysqli = mysqli_connect($host, $user, $pwd, $db);

            if($idpropio != 0){
              if(isset($_GET['idm'])){
                $idmed = $_GET['idm'];
              }
              $querymedicos = $mysqli -> query ("SELECT idmedicos, nombre FROM medicos WHERE idmedicos = '$idmed'");
              $querymedicos2 = $mysqli -> query ("SELECT idmedicos, nombre FROM medicos");

              
              while ($valores =  mysqli_fetch_array($querymedicos, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              } 
              while ($valores =  mysqli_fetch_array($querymedicos2, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              } 

            }else{
              echo "<option  value=".$idmedico.">Seleccionar Médico</option>";
              $querymedicos = $mysqli -> query ("SELECT idmedicos, nombre FROM medicos");
              while ($valores =  mysqli_fetch_array($querymedicos, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              }
            }
            mysqli_close($mysqli);
            
          ?>
        </select>
      </label>
      </div>

      <div class="col-3">
    	 <label>
      				Área <?php //echo $name;?>
      			  <input name="area" value="<?php if($fila1 != null) { echo $fila1 [1]; }?>" style="background-color:powderblue; "required>
    	 </label>
  		 </div>



<div style="text-align:center;" class="col-1" id="dynamic_field">
<label><?php if ($fila != null){
  $i++;
  $control_estudio = "";
 $control_subtitulo = "";
 $idpropioaux = "";
     $llevaid =1;
    while ($fila2 =  mysqli_fetch_array($fila, MYSQLI_ASSOC)) {
 $comentario = $fila2['comentario'];
      if($control_estudio !=$fila2['estudio'] ){

         $llevaid++; 
         if($llevaid>2){?>
  <div><hr></div>
         <?php }
 //echo $llevaid;
 if($llevaid  != $idpropioaux ){  $i++; ?>

  <script type="text/javascript">
 i++;

</script> <?php   }  ?> 

<label id="row<?php  echo $llevaid;  ?>"><?php echo $fila2['estudio']; ?></label>
  <script type="text/javascript">
 arreglo.push(i);

</script>
<?php $control_estudio = $fila2['estudio'];  }
  if($control_subtitulo != $fila2['subtitulo'] ){
    $control_subtitulo = $fila2['subtitulo'];
 ?>

<div align="left" id="row<?php  echo $llevaid;  ?>"><label ><?php echo $fila2['subtitulo']; ?></label></div>
  <script type="text/javascript">
 arreglo.push(i);

</script>
<?php } ?>
  
<div> <table class="table table-bordered"><tr id="row<?php  echo $llevaid;  ?>">
<td ><input readonly="readonly" type="form-control" name="pruebas[]" value="<?php echo $fila2['prueba']; ?>"  class="form-control name_list"/></td>
<td><input type="form-control" placeholder="Resultados" name="resultados[]" value="<?php echo $fila2['resultados']; ?>" placeholder="Resultados" class="form-control name_list" /></td>
<td><input type="form-control" readonly="readonly" value="<?php echo $fila2['unidades']; ?>" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td>
<td><input type="form-control" readonly="readonly" value="<?php echo $fila2['valorreferencia']; ?>" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td>
<td  style=" width: ;"><input type="form-control"  style="display:none"                    value="<?php echo $fila2['estudio']; ?>" name="estudios[]" class="form-control name_list" /></td> 
<td  style=" width: ;"><input type="form-control"  style="display:none"  value="<?php echo $fila2['subtitulo']; ?>"        name="subtitulo[]" class="form-control name_list" /></td>
<?php if($llevaid  != $idpropioaux ){

 $idpropioaux = $llevaid;
 ?>
</td><td><button type="button" name="remove" id="<?php echo  $idpropioaux;  ?>" class="eliminar btn_remove">X</button></td></tr></table></div>
<?php }
else{  ?>
  </td><td><button type="button" name="remove" style="display:none" id="<?php echo $idpropioaux;  ?>" class="eliminar btn_remove">X</button></td></tr></table></div>
<?php  } ?>
  <?php  
  $icontador++;?>
  <script type="text/javascript">
 arreglo.push(i);

</script>
  <?php  }?>



  <?php } ?></label>
</div>

 

        

     	<?php	  $i ;   ?>
       </div>
      
      <div class="col-submit button">
        <input name="idpropio" value="<?php  echo $_GET['pro'];?>"  style='display:none;'>
        <input name="idpaciente" value = "<?php echo $idpac; ?>" style="display:none;">
            <button name="submit1"   class="guardar" >GUARDAR</button>
      </div>
  </form>


 
      </div>
    </div>

  </body>
 </html>


 <script>

 $(document).ready(function(){

      $('#add').click(function(){
       
      $('#submit').click(function(){
           $.ajax({
                url:"agrega_analisis.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                     alert(data);
                     $('#add_name')[0].reset();
                }
           });
      });
 });
 </script>

<script type="text/javascript">
   $(document).on('click', '.btn_remove', function(){
         
           var button_id = $(this).attr("id");
          // alert(button_id);
           var arreglo1 = arreglo.length;
          // alert(arreglo1);
           for(var wz = 0; wz<arreglo1; wz++){
              $('#row'+button_id).remove();
           }
           i--;
          
      });

 function ChangeCarList() {
 sessionStorage.LocalToGlobalVar;
       
    var carList = document.getElementById("car").value;
    var lugar = document.getElementsByName('car');
    t++;
   
  // Obtener la referencia del elemento body
  if(carList!=0){
  
 var arrayJS=<?php echo json_encode($arrayPHP);?>;
    // Mostramos los valores del array
   var a=1;
   var cont=1;
   var subtitulo= 1;
   var primerelemento=1;
   var encontro =0;
     i++;
   while(a==1){
    var cadena = arrayJS[0][cont];
    if(carList==cadena[0]){
      a=2;
    }else{
      cont = cont +1; 
    }
   
   }
   a=1;
   while(a==1){
      

   var cadena = arrayJS[0][cont];

      //document.write(cadena[0]);
  if (cadena[0] == carList ){

   // $('#dynamic_field1').append('<label>pepe</label>'); 
if (primerelemento==1){
  
   var subti = cadena[5];
   if(i<=2){
   $('#dynamic_field').append('<label id="row'+i+'">'+cadena[4]+'</label><label align="left" id="row'+i+'">'+cadena[5]+'</label><div> <table class="table table-bordered"><caption>Título de la tabla</caption><tr id="row'+i+'"><td "><input readonly="readonly" type="form-control"name="pruebas[]" value="'+cadena[1]+'"      class="form-control name_list"  /></td><td><input type="form-control" placeholder="Resultados" name="resultados[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[2]+'" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[3]+'"name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td><td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[4]+'"name="estudios[]" class="form-control name_list" /></td> <td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[5]+'"name="subtitulo[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="eliminar btn_remove">X</button></td></tr></table></div>');
 }
 else{
  $('#dynamic_field').append('<hr><label id="row'+i+'">'+cadena[4]+'</label><label align="left" id="row'+i+'">'+cadena[5]+'</label><div> <table class="table table-bordered"><caption>Título de la tabla</caption><tr id="row'+i+'"><td "><input readonly="readonly" type="form-control"name="pruebas[]" value="'+cadena[1]+'"      class="form-control name_list"  /></td><td><input type="form-control" placeholder="Resultados" name="resultados[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[2]+'" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[3]+'"name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td><td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[4]+'"name="estudios[]" class="form-control name_list" /></td> <td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[5]+'"name="subtitulo[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="eliminar btn_remove">X</button></td></tr></table></div>');
 }
   primerelemento++;
   arreglo.push(i);
  arreglo.push(i);
  arreglo.push(i);
    }
else{
  
  if(subti != cadena[5]){
  $('#dynamic_field').append('<label align="left" id="row'+i+'">'+cadena[5]+'</label><div> <table class="table table-bordered"><caption>Título de la tabla</caption><tr id="row'+i+'"><td ><input readonly="readonly" type="form-control"name="pruebas[]" value="'+cadena[1]+'"      class="form-control name_list"  /></td><td><input type="form-control" placeholder="Resultados" name="resultados[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[2]+'" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[3]+'"name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td><td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[4]+'"name="estudios[]" class="form-control name_list" /></td> <td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[5]+'"name="subtitulo[]" class="form-control name_list" /></td><button type="button" name="remove" id="'+i+'" class="eliminar btn_remove"  style="display:none" >X</button></td></tr></table></div>');
  subti = cadena[5];
  arreglo.push(i);
  arreglo.push(i);
  }
else{
   $('#dynamic_field').append('<div> <table class="table table-bordered"><caption>Título de la tabla</caption><tr id="row'+i+'"><td><input readonly="readonly" type="form-control"name="pruebas[]" value="'+cadena[1]+'"      class="form-control name_list" /></td><td><input type="form-control" placeholder="Resultados" name="resultados[]"  class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[2]+'" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" readonly="readonly" value="'+cadena[3]+'"name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td><td><input type="form-control"  style="display:none"  value="'+cadena[4]+'"name="estudios[]" class="form-control name_list" /></td><td  style=" width: ;"><input type="form-control"  style="display:none"  value="'+cadena[5]+'"name="subtitulo[]" class="form-control name_list" /></td><button  style="display:none"  type="button" name="remove" id="'+i+'" class="eliminar btn_remove">X</button></td> </tr></table></div>');
   arreglo.push(i);
    }
}
     }
    else{
     
  // var x = document.getElementById("car");
    //   x.remove(x.selectedIndex);
vi++;
 a=2;
    }

   
    cont = cont +1;
     
     //   document.write("<br>"+arrayJS[0][1]);
   }
 
  }
    else{
 
  // Crea las celdas
  for (var i2 = 0; i2 < 2; i2++) {
    // Crea las hileras de la tabla
 //   var hilera = document.createElement("tr");
 

 
    // agrega la hilera al final de la tabla (al final del elemento tblbody)
   
  } 
}
 
}
      
</script>
