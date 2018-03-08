<?php 

    include("includes/conexion.php");
    session_start();
    $_SESSION['me'] ="";
	if(empty($_SESSION['valueuser'])){

	include("includes/error_nologin.php");
	
		 }
foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
if(!isset($_GET['V']) && !isset($_GET['busca']) ){
   include("includes/error_nologin.php"); 
  } 
$linkreporte_prod_fin  = "reporte_prod_fin.php?V=".urlencode(base64_encode('variable'));
$linkreporte_prod_no_fin  = "reporte_prod_no_fin.php?V=".urlencode(base64_encode('variable'));
$linkreporte_reporte_gral_analisis  = "reporte_gral_analisis.php?V=".urlencode(base64_encode('variable')); 
$linkmenu  = "menu.php?V=".urlencode(base64_encode('variable')); 
  ?>

 <!DOCTYPE html>
<html lang="es" class="no-js">
<head>
		<meta charset="UTF-8" />
		<title>Menú Reporte</title>
		<link rel="shortcut icon" href="img/icon.png">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	</head>
  <body>
    <div class="container">
        <header>
				  <span><a href="<?php echo $linkmenu; ?>"><img src="img/logo2.png" class="imag" title="Menu anterior"></a></span>
			  </header>
      <div class="main clearfix">
          <nav id="menu" class="nav" style="">
              <ul>
                  <li style="visibility:hidden;">
                    <a href="">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-services"></i>
								    </span>
								    <span>Correo electr&oacutenico</span>
							      </a>
                  </li>



<!--*****************************************************************************************-->
                  <li>
                    <a target="_blank" href="<?php echo $linkreporte_prod_fin; ?>">
						<span class="icon">
					        <i aria-hidden="true" class="icon-prodterm"></i>
					   </span>
					   <span style="font-size: 17px">Productos finalizados</span>
					</a>
                  </li>

                   <li>
                    <a target="_blank" href="<?php echo $linkreporte_prod_no_fin; ?>">
					    <span class="icon">
						    <i aria-hidden="true" class="icon-prodexis"></i>
					    </span>
						<span style="font-size: 16.4px">Productos no finalizados</span>
					</a>
                  </li>

                  <li>
                    <a href="#" class="show">
						<span class="icon">
						    <i aria-hidden="true" class="icon-veranalis"></i>
						</span>
				        <span>Mostrar análisis</span>
				    </a>
                  </li>
<!--*****************************************************************************************-->
                   <li style="visibility:hidden;">
                    <a href="">
						<span class="icon">
						   <i aria-hidden="true" class="icon-services"></i>
						</span>
						<span>Correo electr&oacutenico</span>
				    </a>
                  </li>
                  <li style="visibility:hidden;">
                    <a >
						<span >
						   <i aria-hidden="true" class="icon-services"></i>
					    </span>
					    <span>Visualizar PDF</span>
					</a>
                  </li>
              </ul>
          </nav><!--NAV-->
      </div> <!--class = "main clearfix"-->
    </div> <!--Cointainer-->

	<div id="dynamic_field" >
		<form name="fechas" method="get" action="reporte_gral_analisis.php" target="_blank" ALIGN=center autocomplete="off">
			<div>
				<label style="font-size: 15px;">De: <input type="text" id="datepicker" name="f1" required></label>
				<label style="font-size: 15px;">A:  <input type="text" id="datepicker2" name="f2" required ></label>
				<button class="guardar" >Enviar</button>
			</div>
		</form>
	</div>
  </body>

</html>

<script type="text/javascript">

 $(document).ready(function(){
document.getElementById('dynamic_field').style.display = 'none';	
	 $(document).on('click', '.show', function(){
		 $( function() {
				$( "#datepicker" ).datepicker();
			} );
			 $( function() {
				$( "#datepicker2" ).datepicker();
			} );
		document.getElementById('dynamic_field').style.display = 'block';	
      });

  });


 </script>

