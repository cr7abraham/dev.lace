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
  				title: "Error",
   				text: "Revisa tus credenciales",
   				text: "Usuario o Contraseña incorrecta",
    			type: "warning"
  			}, function(){
						window.location.href = 'index.php';
				
				}
			);
	</script>

</html>