<?php

	if(isset($_SESSION['enviado'])){
		$linkpacientes   = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));
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

   				text: "<?php echo utf8_decode("El paciente no tiene cuenta de correo asignada ¡ Favor de revisar !."); ?>",

    			type: "warning"

  			}, function(){

							<?php 	  if(  $sesion == 'vvv') { ?>
								window.location.href = '<?php echo $linkpacientes; ?>';
							<?php } ?>
								
				}
			);
	</script>
</html>