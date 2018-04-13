
<?php
//INI Modificación M008 CGLG 

	if(isset($_SESSION['valueF'])){

	}

	$linkpaciente    = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));
	$pac = $_GET['p'];
	$delpac = "del_paciente.php?V=".$pac;
?>

<html>

	<header>

		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">

	</header>
	<script type="text/javascript">

			swal({
				title: "Eliminar Paciente",
				text: "Se eliminará el paciente y toda la información relacionada a éste, ¿Desea continuar?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#94BE2A",
				confirmButtonText: "SI",
				cancelButtonText: "NO",
				closeOnConfirm: false,
				closeOnCancel: false
				}, 
				function(isConfirm){
				  if (isConfirm){
				 	window.location.href = '<?php echo $delpac; ?>';
			  } 
			  else{
			  		window.location.href = '<?php echo $linkpaciente; ?>';
			  }
				}
			);
	</script>


<!--FIN Modificación M008 CGLG -->
</html>