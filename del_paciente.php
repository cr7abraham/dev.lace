<?php
 include("includes/conexion.php");

      $mysqli = mysqli_connect($host, $user, $pwd, $db);

      if (mysqli_connect_errno()) {

      //echo "Falló la conexión:".mysqli_connect_error();

      }

      else{

      //echo "Error ".mysqli_error($mysqli);

       }

 session_start();
 $sesion = "";


  if(empty($_SESSION['valueuser'])){

    include("includes/error_nologin.php");

}
     $pac = $_GET['V'];

     $con = mysqli_connect($host, $user, $pwd, $db);

			if (mysqli_connect_errno()) {

    		echo "Falló la conexión: ".mysqli_connect_error();

        	}
    // sql to delete a record
    $sql = "DELETE FROM analisis WHERE pacientes_idpacientes = $pac";

    if (mysqli_query($con, $sql)) {
        //echo "Record deleted successfully";
        $sql2 = "DELETE FROM pacientes WHERE idpacientes = $pac";
        if (mysqli_query($con, $sql2)) {
             $sesion = "DELPAC";
             include("includes/alert.php");
        }
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
    
?>