<?php

	include("includes/conexion.php");



	if(isset($_SESSION['valueF'])){

	}

	$linkpaciente    = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));

     $linkmedico      = "menu_medicos.php?V=".urlencode(base64_encode('variable'));

     $linkusuarios    = "menu_usuarios.php?V=".urlencode(base64_encode('variable'));

     $linkproveedores = "menu_proveedores.php?V=".urlencode(base64_encode('variable'));

     $linkproductos = "menu_productos.php?V=".urlencode(base64_encode('variable'));

	 $linkestudio = "menu_estudios.php?V=".urlencode(base64_encode('variable')); 

?>

<html>

	<header>

		<script src="js/sweetalert.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

	</header>



	<script type="text/javascript">



			swal({

  				title: "Guardado",

   				text: "<?php echo utf8_decode("Guardado con éxito."); ?>",

    			type: "success"

  			}, function(){



							<?php 	  if(  $sesion == 'PROVEEDOR' or $sesion == 'PROVEEDORUP') { ?>

								window.location.href = '<?php echo $linkproveedores; ?>';



								<?php } 	  if(  $sesion == 'PRODUCTOS') { ?>

								window.location.href = '<?php echo $linkproductos; ?>';

							<?php	} if (  $sesion == 'EMPLEADO' ) { ?>

								window.location.href = '<?php echo $linkusuarios; ?>';

							<?php	} if (  $sesion == 'MEDICOS' or $sesion == 'MEDICOSUP') { ?>

								window.location.href = '<?php echo $linkmedico; ?>';

							<?php	} if (  $sesion == 'PACIENTES' OR $sesion == 'PACIENTESUP' ) { ?>

								window.location.href = '<?php echo $linkpaciente; ?>';

							<?php	} if (  $sesion == 'USUARIO'  or $sesion == 'USUARIOUP' ) { ?>

								window.location.href = '<?php echo $linkusuarios; ?>';

							<?php	} if (  $sesion == 'ESTUDIO'  or $sesion == 'USUARIOUP' ) { ?>

								window.location.href = '<?php echo $linkestudio; ?>';

							<?php	} 





							?>



				}

			);

	</script>



</html>