<?php
    $idpr   = 0;
    $idpac  = 0;
    $idmed  = 0;
	$membrete = "";

    $titulo = "";
   	include('includes/conexion.php');
	foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
	

    if(isset($_GET['idpr']) && isset($_GET['idpac']) && isset($_GET['idm']) ){
        $idpr   = $_GET['idpr'];
        $idpac  = $_GET['idpac'];
        $idmed  = $_GET['idm'];        
		if(isset($_GET['memb'])){
			$membrete = $_GET['memb'];
		}
    }
    
    $sqlContar = "SELECT  a.comentario, a.estudio
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio";
    $conContar = mysqli_connect($host, $user, $pwd, $db);
    $resultContar = mysqli_query($conContar, $sqlContar);
    $filacontar = mysqli_num_rows($resultContar);


    $con = mysqli_connect($host, $user, $pwd, $db);
    $query = $con -> query($sqlContar);
    
    $aux = 0;
    $array = [];
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        if($titulo != $row['estudio']){
            $titulo = $row['estudio'];
    
           // echo $titulo."=";
            
            $sqlConsulta = "SELECT  a.estudio
                                FROM analisis AS a 
                                JOIN pacientes AS p 
                                ON a.pacientes_idpacientes = p.idpacientes
                                JOIN medicos m
                                ON a.medicos_idmedicos = m.idmedicos
                                WHERE a.idpropio = '$idpr' AND a.estudio = '$titulo'
                                ORDER BY a.idpropio;";
            $conConsulta = mysqli_connect($host, $user, $pwd, $db);
            $resultConsulta = mysqli_query($conConsulta, $sqlConsulta);
            $filaConsulta = mysqli_num_rows($resultConsulta);
            array_push($array, $filaConsulta);
            
            
      /*
            if(($filaConsulta >=6 && $filaConsulta <= 26) && $titulo == 'EXAMEN GENERAL DE ORINA'){
                echo 'Pagina para'.$titulo.' '.$filaConsulta;
            }
            else{
                echo "$titulo".$filaConsulta;
            }
      */
            
            
        }
    }
    //print_r($array);
    $length = count($array);
    
    $lleva = 0;
    $auxarray = [];
    
    $other = [];
    $contestudio = 0;
 $contador_other =0;
    $cont = 0;

    $contadorIn = 0;
    for ($i=0; $i < $length; $i++) { 
        $lleva = $array[$i] + $lleva;
        
        if($lleva <= 26){
            $auxarray[$cont] = $lleva;
            $contestudio++;
            $contador_other++;
            $contadorIn++;
        }else{

            if($contadorIn == 0){
                
                $lleva = $lleva - $array[$i] ;
                $auxarray[$cont] = $lleva;
                 array_push($other, $contestudio);  
                 $contador_other=0;
            }
            $contadorIn = 0;
            $lleva = $array[$i];
            if($contador_other!=0){
                array_push($other, $contestudio);   
            }
            
            $cont++;
        
            $contestudio = 1;
            
        }

    }
    if($contestudio >= 1){
        array_push($other, $contestudio);   
    }
    
    print_r($auxarray);
    print_r($other);
          
   

    



?>