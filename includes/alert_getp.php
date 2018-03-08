<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>

	<script type="text/javascript">

			swal({
  				title: "Advertencia",
   				text: "No se ha seleccionado el paciente correctamente",
    			type: "info"
  			}, function(){
				   //window.history.back();
                   window.location.href = 'menu_pacientes.php';
				}
			);
	</script>

</html>
