<?php
    include("includes/conexion.php");
    $_SESSION['idpaciente'] = null;
	/*
	$p 	= 0;
	$pro = 0;
	if(empty($_GET['p']) && empty($_GET['pro'])){
		$p 	= $_GET['p'];
		$pro =	$_GET['pro'];
	}
	else{
		echo "NO";
	}
	*/
	
?>
<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>

	<script type="text/javascript">

			swal({
  				title: "Advertencia",
   				text: "Médico no seleccionado",
    			type: "info"
  			}, function(){
				   window.history.back();
				}
			);
	</script>

</html>
