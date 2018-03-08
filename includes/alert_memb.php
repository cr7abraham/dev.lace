<?php

	if(isset($_GET['array'])){
       $ar1   = $_GET['array'];
        $array = explode(",", $ar1);
        //print_r($arrayc);
       // print_r($array);    
    } 

	

	//$membrete = "php/pdf/reporte.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm))."&memb=".urlencode(base64_encode('true'));
	//$membrete= "prueba_analisis.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm))."&memb=".urlencode(base64_encode('true'))."&array=".serialize($array);
	//$nomemb = "php/pdf/reporte.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm))."&memb=".urlencode(base64_encode('false'));
	//$nomemb = "prueba_analisis.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm))."&memb=".urlencode(base64_encode('false'))."&array=".serialize($array);
	if(isset($_GET['print'])){
		$conmembrete = "php/pdf/reporte.php?array=".serialize($array)."&memb=true";
		$nomemb = "php/pdf/reporte.php?array=".serialize($array)."&memb=false";
	}
	/*
	if(isset($_GET['email'])){
		//echo "email";
		$conmembrete = "php/pdf/reporte.php?array=".serialize($array)."&memb=true";
		$nomemb = "php/pdf/reporte.php?array=".serialize($array)."&memb=false";
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
				title: "Membrete",
				text: "¿Desea que el reporte tenga membrete?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#94BE2A",
				confirmButtonText: "SI",
				cancelButtonText: "NO",
				closeOnConfirm: false,
				closeOnCancel: false
				}, function(isConfirm){
				  if (isConfirm){
				  window.location.href = '<?php echo $conmembrete; ?>';
			  } 
			  else{
			  		window.location.href = '<?php echo $nomemb; ?>';
			  }
				}
			);
	</script>

</html>
