<?php
	include("includes/conexion.php");

	if(isset($_SESSION['valueF'])){
	}
	$linkpaciente    = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));
     $linkmedico      = "menu_medicos.php?V=".urlencode(base64_encode('variable'));
     $linkusuarios    = "menu_usuarios.php?V=".urlencode(base64_encode('variable'));
     $linkproveedores = "menu_proveedores.php?V=".urlencode(base64_encode('variable'));
     $linkproductos = "menu_productos.php?V=".urlencode(base64_encode('variable')); 
?>
<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>

	<script type="text/javascript">

			swal({
  				title: "Error",
   				text: "El Registro existe.",
    			type: "warning"
  			}, function(){

				<?php 	  if(  $sesion == 'PROVEEDOR') { ?>
								window.location.href = '<?php echo $linkproveedores; ?>';
							<?php	} if (  $sesion == 'EMPLEADO' ) { ?>
								window.location.href = '<?php echo $linkusuarios; ?>';
							<?php	} if (  $sesion == 'MEDICOS' ) { ?>
								window.location.href = '<?php echo $linkmedico; ?>';
							<?php	} if (  $sesion == 'PACIENTES' ) { ?>
								window.location.href = '<?php echo $linkpaciente; ?>';
							<?php	} if (  $sesion == 'PACIENTESUP' ) { ?>
								window.location.href = '<?php echo $linkpaciente; ?>';
							<?php   } ?>

				<?php 	  if(  $sesion == 'PROVEEDOR') { ?>
					window.location.href = '<?php echo $linkproveedores; ?>';
				<?php	} if (  $sesion == 'USUARIO' ) { ?>
					window.location.href = '<?php echo $linkusuarios; ?>';
				<?php	} if (  $sesion == 'MEDICOS' ) { ?>
					window.location.href = '<?php echo $linkmedico; ?>';
				<?php	} if (  $sesion == 'PACIENTES' ) { ?>
					window.location.href = '<?php echo $linkpaciente; ?>';
				<?php   } ?>
	
				}
			);
	</script>

</html>