<?php
    date_default_timezone_set('America/Mexico_City');
    $idpac = 0;
    
    if(isset($_GET['array']) && (!empty($_GET['array']))){
        $ar1   = $_GET['array'];
        $array = explode(",", $ar1);
    }  
        if(isset($_GET['idpaciente'])){
            $idpac = $_GET['idpaciente'];
        }
    
    	if($_GET['print3'] == "print"){
            include('includes/alert_memb.php');
        }
	    if($_GET['print3'] == "mail"){
            header("Location: recupera.php?idpac=".$idpac."&array=".$array);           
        } 
    
?>