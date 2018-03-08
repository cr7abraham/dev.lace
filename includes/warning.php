<?php
	include("includes/conexion.php");

	if(isset($_SESSION['valueF'])){
	}
?>
<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>

	<script type="text/javascript">
		
		swal({
  				title: "Paciente ya existe",
   				text: "¡El paciente con ese nombre ya se encuentra registrado, favor verificar!",
    			type: "warning"
  			}, function(){

				<?php 	  if(  $sesion == 'PROVEEDOR') { ?>
								window.location.href = 'proveedores.php';
							<?php	} if (  $sesion == 'EMPLEADO' ) { ?>
								window.location.href = 'empleados.php';
							<?php	} if (  $sesion == 'MEDICOS' ) { ?>
								window.location.href = 'menu_medicos.php';
							<?php	} if (  $sesion == 'PACIENTES' ) { ?>
								window.location.href = 'menu_pacientes.php';
							<?php	} if (  $sesion == 'PACIENTESUP' ) { ?>
								window.location.href = 'menu_pacientes.php';
							<?php   } ?>

				
	
				}
			);


		
	</script>

</html>