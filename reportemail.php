<?php
    include('fpdf181/fpdf.php');
    include("includes/conexion.php");
    
    foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
/*
if(!isset($_GET['V']) ){
   include("includes/error_nologin.php"); 
  }*/



class PDF extends FPDF
    {
        //******Cabecera
        function Header()
        {

/**************************************************/
            include("includes/conexion.php");
            $idpr   = 0;
            $idpac  = 0;
            $idmed  = 0;
            $queryhead = "";
            $nombrePaciente = "";
            $nombreMedico   = "";
            $fecha = "";
            if(isset($_GET['idpr']) && isset($_GET['idpac']) && isset($_GET['idm'])){
                $idpr   = $_GET['idpr'];
                $idpac  = $_GET['idpac'];
                $idmed  = $_GET['idm'];
                
            }
            $conhead = mysqli_connect($host, $user, $pwd, $db);
            $sqlhead = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio";

            $queryhead = $conhead -> query($sqlhead);
            
            while($row = mysqli_fetch_array($queryhead, MYSQLI_ASSOC))
            {
                $nombreMedico   = $row['medico'];
                $nombrePaciente = $row['paciente'];
                $fecha          = $row['fecha'];
            }
            
/***********************************************************/

            //Logo
            $this->Image('img/logo2.png', 10, 8, 33);
            //Fuente
            $this->SetFont('Arial', 'B', 14);
            //Espacio
            $this->Cell(85);
            $this->Cell(30, 10, utf8_decode('Laboratorio Análisis Clínicos Espinosa'), 0, 0 ,'C');
            //Salto de linea
            $this->Ln(5);
            $this->SetFont('Arial', '', 8);
            $this->Cell(85);
            $this->Cell(30, 10, utf8_decode('Hidalgo No. 9 Int. 1-A Tel. 469 692 2195 Pénjamo, Gto.'), 0, 0 ,'C');
            
            $this->Ln(3.5);
            $this->SetFont('Arial', '', 8);
            $this->Cell(85);
            $this->Cell(30, 10, utf8_decode('Universidad de Gto. Cédula Prof. 1888051 SSA 1931'), 0, 0 ,'C');
            
            $this->Ln(14);
            $this->SetFont('Arial', '', 10);
            $this->Cell(20);
            $this->Cell(30, 10, utf8_decode('Examen practicado a: '.$nombrePaciente), 0, 0 ,'L');
              
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(105);
            $this->Cell(30, 10, utf8_decode('Fecha: '.$fecha), 0, 0 ,'C');

            $this->Ln(5);
            $this->SetFont('Arial', '', 10);
            $this->Cell(20);
            $this->Cell(30, 10, utf8_decode('Solicitado por el (la) Dr. (a): '.$nombreMedico), 0, 0 ,'L');
            
        }

//******Pie de pagina
        function Footer()
        {
            //Posicion: a 1.5 cm del final
            $this->SetY(-15);
            //Arial Italic 8
            $this->SetFont('Arial', 'I', 8);
            //Numero de pagina
            $this->Cell(0, 10, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');

        }

/*
        function AcceptPAgeBreak()
        {
             $this->AddPage();
             $this->SetFillColor(232, 232, 232);
             $this->SetFont('Arial', 'B', 12);
             $this->SetX(10);
             $this->Cell(70, 6, 'Prueba', 1, 0, 'C', 1);
             $this->SetX(80);
             $this->Cell(20, 6, 'Resultado', 1, 0, 'C', 1);
             $this->SetX(100);
             $this->Cell(70, 6, 'Unidades', 1, 0, 'C', 1);
             $this->Ln();
        }
*/
    }





    $idpr   = 0;
    $idpac  = 0;
    $idmed  = 0;
    $queryhead = "";
    $nombrePaciente = "";
    $nombreMedico   = "";
    $fecha = "";
    $conCuenta = "";
    if(isset($_GET['idpr']) && isset($_GET['idpac']) && isset($_GET['idm'])){
        $idpr   = $_GET['idpr'];
        $idpac  = $_GET['idpac'];
        $idmed  = $_GET['idm'];        
    }
    $sqlContar = "SELECT  a.prueba
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


    if($filacontar <= 6){
        $idpr   = 0;
        $idpac  = 0;
        $idmed  = 0;
        $queryhead = "";
        if(isset($_GET['idpr']) && isset($_GET['idpac']) && isset($_GET['idm'])){
            $idpr   = $_GET['idpr'];
            $idpac  = $_GET['idpac'];
            $idmed  = $_GET['idm'];
            
        }
        

        $con = mysqli_connect($host, $user, $pwd, $db);

        $sql = "SELECT  a.prueba, a.resultado, a.unidades, a.valorreferencia, a.comentario, a.observaciones
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio";

        
        $query = $con -> query($sql);

        
        
        $pdf = new FPDF('L','mm',array(210, 148.5));
        $pdf->Settitle("Reporte");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(45, 76, 130);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Ln();
        $pdf->Ln(5);

        $pdf->SetX(12);
        $pdf->Cell(100, 6, 'Prueba', 1, 0, 'C', 1);
        
        $pdf->SetX(112);
        $pdf->Cell(30, 6, 'Resultado', 1, 0, 'C', 1);
        
        $pdf->SetX(142);
        $pdf->Cell(30, 6, 'Unidades', 1, 0, 'C', 1);
        
        $pdf->SetX(172);
        $pdf->Cell(25, 6, 'Vl. Referencia', 1, 0, 'C', 1);

    // $pdf->SetX(155);
        //$pdf->Cell(40, 6, 'Comentarios', 1, 0, 'C', 1);

        
        $pdf->Ln();

        $observaciones = "";
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
        {
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(0, 0, 0);
                    
            $pdf->SetX(12);
            $pdf->Cell(100, 6, $row['prueba'], 1, 0, 'C');
            
            $pdf->SetX(112);
            $pdf->Cell(30, 6, $row['resultado'], 1, 0, 'C');
            
            $pdf->SetX(142);
            $pdf->Cell(30, 6, $row['unidades'], 1, 0, 'C');
            
            $pdf->SetX(172);
            $pdf->Cell(25, 6, $row['valorreferencia'], 1, 1, 'C');
            
            //$pdf->SetX(155);
            //$pdf->MultiCell(40, 6, $row['observaciones'], 1, 'C', false);

            $observaciones = $row['comentario'];
            
            
        }
    

            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetX(20);
            $pdf->Cell(170, 6, 'Observaciones', 1, 1, 'C');
            $pdf->SetX(20);
            $pdf->MultiCell(170, 6, utf8_decode($observaciones), 1, 'J', true);
            
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(180, 6, 'Atentamente', 0, 1, 'C');

            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(180, 6, 'QFB. Fabiola Espinosa Bribiesca', 0, 1, 'C');

            $pdf->Output();
    }
    else{
        $idpr   = 0;
        $idpac  = 0;
        $idmed  = 0;
        $queryhead = "";
        if(isset($_GET['idpr']) && isset($_GET['idpac']) && isset($_GET['idm'])){
            $idpr   = $_GET['idpr'];
            $idpac  = $_GET['idpac'];
            $idmed  = $_GET['idm'];
            
        }
        

        $con = mysqli_connect($host, $user, $pwd, $db);

        $sql = "SELECT  a.prueba, a.resultado, a.unidades, a.valorreferencia, a.comentario, a.observaciones
                FROM analisis AS a 
                JOIN pacientes AS p 
                ON a.pacientes_idpacientes = p.idpacientes
                JOIN medicos m
                ON a.medicos_idmedicos = m.idmedicos
                WHERE a.idpropio = '$idpr'
                ORDER BY a.idpropio";

        
        $query = $con -> query($sql);

        
        
        $pdf = new PDF();
        $pdf->Settitle("Reporte");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(45, 76, 130);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Ln();
        $pdf->Ln(5);

        $pdf->SetX(12);
        $pdf->Cell(100, 6, 'Prueba', 1, 0, 'C', 1);
        
        $pdf->SetX(112);
        $pdf->Cell(30, 6, 'Resultado', 1, 0, 'C', 1);
        
        $pdf->SetX(142);
        $pdf->Cell(30, 6, 'Unidades', 1, 0, 'C', 1);
        
        $pdf->SetX(172);
        $pdf->Cell(25, 6, 'Vl. Referencia', 1, 0, 'C', 1);

    // $pdf->SetX(155);
        //$pdf->Cell(40, 6, 'Comentarios', 1, 0, 'C', 1);

        
        $pdf->Ln();

        $observaciones = "";
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
        {
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetTextColor(0, 0, 0);
                    
            $pdf->SetX(12);
            $pdf->Cell(100, 6, $row['prueba'], 1, 0, 'C');
            
            $pdf->SetX(112);
            $pdf->Cell(30, 6, $row['resultado'], 1, 0, 'C');
            
            $pdf->SetX(142);
            $pdf->Cell(30, 6, $row['unidades'], 1, 0, 'C');
            
            $pdf->SetX(172);
            $pdf->Cell(25, 6, $row['valorreferencia'], 1, 1, 'C');
            
            //$pdf->SetX(155);
            //$pdf->MultiCell(40, 6, $row['observaciones'], 1, 'C', false);

            $observaciones = $row['comentario'];
            
            
        }
    

            $pdf->Ln();
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetX(20);
            $pdf->Cell(170, 6, 'Observaciones', 1, 1, 'C');
            $pdf->SetX(20);
            $pdf->MultiCell(170, 6, utf8_decode($observaciones), 1, 'J', true);
            
            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(180, 6, 'Atentamente', 0, 1, 'C');

            $pdf->SetX(15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(180, 6, 'QFB. Fabiola Espinosa Bribiesca', 0, 1, 'C');

            $pdf->Output();
    }






    

?>
