<?php   include("includes/conexion.php");

         $mysqli = mysqli_connect($host, $user, $pwd, $db);

      if (mysqli_connect_errno()) {

      // echo "Falló la conexión:".mysqli_connect_error();

      }

session_start();

  $_SESSION['valueF'] = 'ESTUDIO';

  if(empty($_SESSION['valueuser'])){



  include("includes/error_nologin.php");



     }



foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));



  $cont = 1;

  $i = 1;

  $idmed = 0;?>





				   <script language='javascript'>

				  var i = 1;

          var vi = 1;

          var primer_renglon = 0;

          var n_subtitulo = 0;

          var n_renglones = 0;

          var primer_subtitulo = 0;

          var button_id_alterno=0;

          var editar=0;

          var j= 0;

          var t= 0;

          var vi=0;

          var arreglo = [""];

          var matriz = new Array();

          var matriz2 = new Array();

          var extra = 1;

                 sessionStorage.LocalToGlobalVar = vi;

                 sessionStorage.LocalToGlobalVar = matriz;

                 sessionStorage.LocalToGlobalVar = matriz2;

                 sessionStorage.LocalToGlobalVar = editar;

                 sessionStorage.LocalToGlobalVar = primer_renglon;

                 sessionStorage.LocalToGlobalVar = n_subtitulo;

                 sessionStorage.LocalToGlobalVar = n_renglones;

                 sessionStorage.LocalToGlobalVar = primer_subtitulo;

                 sessionStorage.LocalToGlobalVar = j;

                 sessionStorage.LocalToGlobalVar = t;

                 sessionStorage.LocalToGlobalVar = button_id_alterno;

                 sessionStorage.LocalToGlobalVar = extra;



			</script>

<!doctype html>

 <html lang="en-US">

      <head>

           <title>Análisis</title>

           <script src="js/jquery.min.js"></script>



 <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">

  <?php if (isset($_GET['es'])){



if(isset($_GET['es'])){

  $es = $_GET['es'];

    $sql    = "SELECT * FROM estudios where idpropio = '$es' ";

        $query  = mysqli_query($mysqli, $sql);

        $fila = $mysqli->query($sql);

        $fila1 = mysqli_fetch_array($query);

    mysqli_close($mysqli);



}

          ?>



    <?php    }

    else{ $fila = null;

         $fila1 = null;

      $es = 0;

       }

  ?>









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

	        <img src="img/logo2.png" id="logo">

        </a>

        </p>



    </li>



    <li>

      <h1>Estudio</h1>

    </li>

  </ul>

</nav>



      <div class="container">

        <div class="form-group">

          <form name="add_name" id="add_name" method="post" action="guarda.php " ALIGN=center autocomplete="off">

    	    <div class="col-2">

      			<label >

     					Nombre del Estudio

    						<input name="estudio" value="<?php if($fila1 != null) { echo $fila1 [1]; }?>" style="background-color:powderblue; "required>

            </label>

  				</div>



          



<?php  if($fila == null) { ?>

<div class="table-responsive">

          <table class="table table-bordered" id="dynamic_field">

          <tr>

            <td><input type="form-control" name="subtitulo[]" placeholder="Subtitulo" class="form-control name_list" /></td>

            <td><button type="button" name="addsub" id="addsub" class="agregar">Agregar Subtitulo</button></td>

          </tr>

            <tr>

              <td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" /></td>

              <td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td>

              <td><input  type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td>

              <td><input  type="form-control" name="idsubtitulo[]" value="0" style="display:none;"  class="form-control name_list" /></td>

              <td><button type="button" name="add" id="add" class="agregar">Agregar</button></td>

            </tr>

          </table>

          <hr>

              </div>

          <div id="dynamic_field2">



          </div>

<?php

      } 

      else{ ?> <script type="text/javascript">editar++;</script>

       <?php   $primera_vez = 0;  $subt1="";  $subt="";  $contadorprimeravez = 0; $ii=1; $segunda_vez =0; $idsubtitulo1=1;  

      $elementovector=1; $contadorrowx=0; $guardaultimoid=0; $cont_un_subtitulo = 0;

        while (  $row = mysqli_fetch_array($fila, MYSQLI_ASSOC)) {

    if ($subt1 != $row['subtitulo']){

      $subt1 =$row['subtitulo'];

      $primera_vez ++;

     }

        if($primera_vez<=1){?>

                <?php if($contadorprimeravez == 0){ ?>





                    <div class="table-responsive">

                <table class="table table-bordered" id="dynamic_field">

          <tr>

            <td><input type="form-control" name="subtitulo[]"  value="<?php if($row['subtitulo']!="") {echo $row['subtitulo']; }?>"  class="form-control name_list" placeholder="Subtitulo" /></td>

           <td><button type="button" name="addsub" id="addsub" class="agregar">Agregar Subtitulo</button></td>

          </tr>

          <tr>

              <td><input type="form-control" name="pruebas[]" value="<?php if($row['prueba']!="") {echo $row['prueba']; }?>"  class="form-control name_list" placeholder="Prueba" /></td>

              <td><input type="form-control" name="unidades[]" value="<?php if($row['unidades']!="") { echo $row['unidades']; } ?>" class="form-control name_list" placeholder="Unidades"  /></td>

              <td><input  type="form-control" name="valorreferencia[]" value="<?php if($row['valorreferencia']!="") { echo $row['valorreferencia'];} ?>"  class="form-control name_list"  placeholder="Valor de referencia" /></td>

              <td><input  type="form-control" name="idsubtitulo[]" value="0" style="display:none;"  class="form-control name_list" /></td>

              <td><button type="button" name="add" id="add" class="agregar">Agregar</button></td>

            </tr>



          <?php $contadorprimeravez++; } else{ ?>

          <tr id="row<?php echo $ii; ?>">

              <td><input type="form-control" name="pruebas[]" value="<?php if($row['prueba']!="") {echo $row['prueba']; }?>"  class="form-control name_list" placeholder="Prueba" /></td>

              <td><input type="form-control" name="unidades[]" value="<?php if($row['unidades']!="") { echo $row['unidades']; } ?>" class="form-control name_list" placeholder="Unidades"  /></td>

              <td><input  type="form-control" name="valorreferencia[]" value="<?php if($row['valorreferencia']!="") { echo $row['valorreferencia'];} ?>"   placeholder="Valor de referencia"  class="form-control name_list" /></td>

              <td><input  type="form-control" name="idsubtitulo[]" value="0" style="display:none;" class="form-control name_list" /></td>

               <td><button type="button" name="remove" id="<?php echo $ii; $ii++;?>" class="eliminar btn_remove">X</button></td>

           </tr>

          

           <script type="text/javascript">

          primer_renglon++;  t++; 

           matriz[[primer_subtitulo,primer_renglon]] = t; //alert(matriz[[primer_subtitulo,primer_renglon]]); </script>

            <?php } ?>

          

       <?php } else{  if ($segunda_vez == 0){ ?>

       </table>

      

      </div>

      <div id="dynamic_field3">

      <?php   $segunda_vez++;

          }

       

       if($subt != $row['subtitulo']){ $cont_un_subtitulo++;?>

           <div id="rowx<?php echo $idsubtitulo1-1;  ?>">

         

         </div><hr>

     

         </div>

      <?php  $contadorrowx=0;

        $guardaultimoid=$idsubtitulo1;

       $subt =$row['subtitulo'];

        $ii =1; $idsubtitulo1++; ?> 



          <div id="sub<?php echo $idsubtitulo1-1;  ?>">

  <div style="display: flex;margin-top: 10px;">

  <input type="form-control" name="subtitulo[]" value="<?php if($row['subtitulo']!="") {echo $row['subtitulo']; }?>" placeholder="Subtitulo" class="form-control name_list" />

  <button type="button" name="remove" id="<?php echo $idsubtitulo1-1; ?>" class="eliminar btn_removesub">X</button>

  </div>

    <div id="row<?php echo $ii; ?>" style="display: flex;">

   

   <input type="form-control" name="pruebas[]" value="<?php if($row['prueba']!="") {echo $row['prueba']; }?>"  placeholder="Prueba" class="form-control name_list" />

  <input type="form-control" name="unidades[]" value="<?php if($row['unidades']!="") {echo $row['unidades']; }?>"  placeholder="Unidades" class="form-control name_list" />

   <input type="form-control" name="valorreferencia[]" value="<?php if($row['valorreferencia']!="") {echo $row['valorreferencia']; }?>"  placeholder="Valor de referencia" class="form-control name_list" />

   <input type="form-control" name="idsubtitulo[]" value="<?php echo $idsubtitulo1-1; ?>"  style="display:none;"  class="form-control name_list" />

    <button type="button" name="add" id="<?php echo $idsubtitulo1-1; ?>" class="agregar2">Agregar</button> </div>

   

   

  <script type="text/javascript">



  j++;

  matriz[[n_subtitulo,n_renglones]] = j;

  //alert(n_subtitulo);

  //alert(n_renglones);

  //alert(j);

   //alert(matriz[[n_subtitulo,n_renglones]]);

  button_id_alterno++;

  lleva=1;

 </script>  

   <?php     }

   else{ $variable = ($idsubtitulo1-1).$ii; $variable2 = ($idsubtitulo1-1).",".$ii; $ii++; ?>

  

 <div id="reg<?php echo $variable; ?>" style="display: flex;">

 <input type="form-control" name="pruebas[]" value="<?php if($row['prueba']!="") {echo $row['prueba']; }?>" class="form-control name_list" />



 <input type="form-control" name="unidades[]" value="<?php if($row['unidades']!="") {echo $row['unidades']; }?>" placeholder="Unidades" class="form-control name_list" />

 <input type="form-control" name="valorreferencia[]" value="<?php if($row['valorreferencia']!="") {echo $row['valorreferencia']; }?>" placeholder="Valor de referencia" class="form-control name_list" />

 <input type="form-control" name="idsubtitulo[]" value="<?php echo $idsubtitulo1-1; ?>" style="display:none;"

   class="form-control name_list" />

 <button type="button" name="remove" id="<?php echo $variable2; ?>" class="eliminar btn_remove2">X</button> </div>

 

<?php $contadorrowx++; ?>

 <script type="text/javascript"> 



     //  alert(lleva-1);

        //  alert("buton"+button_id_alterno);

          //alert("lleva"+lleva);

        matriz[[button_id_alterno-1,lleva]]=lleva; 

        lleva++; </script>

  <?php  }



       ?>

         

       <?php } }
        if($contadorrowx!=0){?>

<div id="rowx<?php echo $idsubtitulo1-1;  ?>">

         

         </div><hr></div>

      <?php  }

      else{?>

 <div id="rowx<?php echo $idsubtitulo1-1;  ?>">

         

         </div><hr>

      <?php }
if($cont_un_subtitulo==0){?>
  </table>



      </div> 

      <?php  }
    
        ?>  <div id="dynamic_field2"></div> <?php 
}
      

       ?>



     

      <div class="col-submit button">

        <input name="idpropio" value="<?php  echo  $es;?>"   style='display:none;'>

        <input name="idpaciente" value = "<?php echo $idpac; ?>" style="display:none;">

            <button name="submit"   class="guardar" >GUARDAR</button>

      </div>

  </form>

      </div>

    </div>

  </body>

 </html>



 <script>

   var i = 0;



 $(document).ready(function(){

      $('#add').click(function(){

           primer_renglon++;

       

           

           t++;

           $('#dynamic_field').append(

               '<tr id="row'+t+'">'+

               '<td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" /></td>'+

               '<td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td>'+



               '<td><input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td>'+

               '<td><input  type="form-control" name="idsubtitulo[]" value="'+0+'"  style="display:none;"  class="form-control name_list" /></td>'+

               '<td><button type="button" name="remove" id="'+t+'" class="eliminar btn_remove">X</button></td></tr>');

           matriz[[primer_subtitulo,primer_renglon]] = t;

         //  alert( matriz[[primer_subtitulo,primer_renglon]]);

           

      console.log("T"+t);

         console.log("matriz" + matriz[[primer_subtitulo,primer_renglon]]);

      });



      $(document).on('click', '.btn_remove', function(){

           var button_id = $(this).attr("id");

      //     alert(button_id);

           $('#row'+button_id+'').remove();

          // t--;

           console.log("T"+t);

      });

      $('#submit').click(function(){

           $.ajax({

                url:"guarda.php",

                method:"POST",

                data:$('#add_name').serialize(),

                success:function(data)

                {

                     alert(data);

                     $('#add_name')[0].reset();

                }

           });

      });

//Subtitulos

$('#addsub').click(function(){

  if(editar==0){

            i++;

            j++;

            vi++;



 n_subtitulo++;

 var control=1;

  matriz[[n_subtitulo,n_renglones]] = j;

 // alert(n_subtitulo);

  //alert(n_renglones);

  //alert(j);

   //alert(matriz[[n_subtitulo,n_renglones]]);

 }

 

  else{

   i++;

            j++;

            vi++;



 n_subtitulo=j;

 var control=1;

  matriz[[n_subtitulo,n_renglones]] = j;

 // alert(n_subtitulo);

  //alert(n_renglones);

  //alert(j);

 //  alert(matriz[[n_subtitulo,n_renglones]]);

  }

 

 // alert(n_subtitulo);

           $('#dynamic_field2').append(

               '<div id="sub'+j+'">'+

               '<div style="display: flex;margin-top: 10px;">'+

                        '<input type="form-control" name="subtitulo[]" placeholder="Subtitulo" class="form-control name_list" />'+

                        '<button type="button" name="remove" id="'+j+'" class="eliminar btn_removesub">X</button>'+

                    '</div>'+

               '<div id="row'+j+'" style="display: flex;">'+

                  

                    '<input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" />'+

                    '<input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" />'+

                    '<input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" />'+

                    '<input type="form-control" name="idsubtitulo[]" value="'+n_subtitulo+'" style="display:none;"  class="form-control name_list" />'+

                    '<button type="button" name="add" id="'+j+'" class="agregar2">Agregar</button></div>'+

                    '<div id="rowx'+j+'"></div><hr></div>');

          

           matriz2[n_subtitulo]= control;

           console.log(matriz2[n_subtitulo]);

          arreglo.push(i);

          i=0;

    //  console.log("i"+i);

      console.log("j"+j);

    //  console.log(arreglo);



      });



      $(document).on('click', '.agregar2', function(){



          var button_id = $(this).attr("id");

      //  alert(button_id);

       //  console.log(button_id);

       //alert(button_id);

          i = arreglo[button_id];

         // i++;

         var zas = "";

         var lleva =1;

         var encontro =0;

         //alert (zas);

         var ass = 0;

        

         while(zas!== undefined){

         zas = matriz[[button_id,lleva]];

        

       //  alert(zas);

         if(zas!=undefined){

            encontro = zas;

         }

         lleva++;

         }

         if(encontro===undefined){

          encontro=0;

         }

       //  alert(button_id);

          var control = encontro+1;

        matriz[[button_id,lleva-1]]=control; 

       // alert(button_id);

        lleva = lleva-1;

          //console.log(matriz[[control,1]]);

            $('#rowx'+button_id+'').append(

               '<div id="reg'+button_id+''+lleva+'"style="display: flex;">'+

                    '<input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" />'+

                    



                    '<input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" />'+

                    '<input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" />'+

                    '<input type="form-control" name="idsubtitulo[]" value="'+button_id+'" style="display:none;"  class="form-control name_list" />'+

                    '<button type="button" name="remove" id="'+button_id+','+lleva+'" class="eliminar btn_remove2">X</button></div>');

            

           arreglo.splice(button_id, 1, i);

           i=0;

          // console.log("i"+i);

          // console.log("j"+j);

          // console.log(arreglo);

      });



      $(document).on('click', '.btn_remove2', function(){

           var button_id = $(this).attr("id");

           var patron=",";

           var res=button_id.replace(patron,'');

         //  alert(res);



          //alert( matriz[[button_id]]);

        //  alert(button_id);

           $('#reg'+res+'').remove();

           //vi--;

           //console.log("I"+i);

           //console.log("j"+j);

           //console.log(arreglo);

          // alert(button_id);

      });

      $(document).on('click', '.btn_removesub', function(){//arreglar

           var button_id = $(this).attr("id");

       // alert(button_id);

       



           //var aux=button_id.split("-", 1);

           $('#sub'+button_id+'').remove();

           //j--;

           //vi--;

           //arreglo.splice(aux, 1, "");

           //console.log("J"+aux);

           //console.log("J"+arreglo);

      });

 });



 </script>

