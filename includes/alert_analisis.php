<?php
	include("includes/conexion.php");
	session_start();
  // $_SESSION['idpaciente'] = null;
   $variable = $_SESSION['p'];

?>
<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>
<?php $linkanalisis    = "menu_analisis.php?p=".urlencode( $variable); ?>
	<script type="text/javascript">

			swal({
  				title: "Guardado",
   				text: "Guardado con éxito.",
    			type: "success"
  			}, function(){


								window.location.href = '<?php echo $linkanalisis; ?>';




				}
			);
	</script>

</html>
