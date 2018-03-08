<?php

	if(isset($_SESSION['enviado'])){
		$linkpacientes   = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));
		$linkusuarios   = "menu_usuarios.php?V=".urlencode(base64_encode('variable'));
        $sesion = $_SESSION['enviado'];
	}
     
?>

<html>
	<header>

		<script src="js/sweetalert.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

	</header>
	<script type="text/javascript">



			swal({

  				title: "ERROR",

   				text: "<?php echo utf8_decode("El paciente no tiene cuenta de correo asignada."); ?>",

    			type: "warning"

  			}, function(){

							<?php 	  if(  $sesion == 'vvv') { ?>
								window.location.href = '<?php echo $linkpacientes; ?>';
							<?php } 
							
							if(  $sesion == 'vvv2') {?>
								window.location.href = '<?php echo $linkusuarios; ?>';
							<?php } ?>
				}
			);
	</script>
</html>