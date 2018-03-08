<?php

	include("includes/conexion.php");
	if(isset($_SESSION['enviado'])){
        $linkusuarios    = "menu_usuarios.php?V=".urlencode(base64_encode('variable'));
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

  				title: "Enviado",

   				text: "<?php echo utf8_decode("En unos instantes recibirá un correo con la información solicitada."); ?>",

    			type: "success"

  			}, function(){

							<?php 	  if(  $sesion == 'si') { ?>
								window.location.href = '<?php echo $linkusuarios; ?>';
								//window.close();
							<?php } else{ ?>
								/*window.location.href = '<?php //echo $linkpacientes; ?>';*/
								window.close();
							<?php } ?>
				}
			);
	</script>
</html>