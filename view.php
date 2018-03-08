<?php
    include("includes/conexion.php");
    $con = "";
    $con = mysqli_connect($host, $user, $pwd, $db);
    if (mysqli_connect_errno()) {
        echo "Falló la conexión: ".mysqli_connect_error();
	}
    $id = 0;
    if(isset($_GET['p'])){
        $id = $_GET['p'];
        $sqlC = " CREATE VIEW contador as SELECT *
                              FROM analisis
                              WHERE pacientes_idpacientes = '$id' 
                              group by idpropio";
        mysqli_query($con, $sqlC);
        mysqli_close($con);
        header ("Location: menu_analisis.php?p=".$id);
    }
    else{
        $sqlViewStudio = " CREATE VIEW view_studio AS SELECT *
                                FROM estudios
                                GROUP BY nombre_estudio;";
        mysqli_query($con, $sqlViewStudio);
        mysqli_close($con);
        header ("Location: menu_estudios.php");
    }


    

?>