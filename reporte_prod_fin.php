<?php
    include('fpdf181/fpdf.php');
    include("includes/conexion.php");
    session_start();
    date_default_timezone_set('America/Mexico_City');
    if(empty($_SESSION['valueuser'])){

    include("includes/error_nologin.php");
    
         }
foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

if(!isset($_GET['V']) ){
   include("includes/error_nologin.php"); 
  }
class PDF extends FPDF
    {
        //******Cabecera
        function Header()
        {

/**************************************************
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
            $dia    = "";
            $mes    = "";
            $anio   = "";
            $fecha  = "";

            $dia    = date("d");
            $mes    = date("m");
            $anio   = date("Y");
            $fecha  = $anio."-".$mes."-".$dia;
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
          //  $this->Cell(30, 10, utf8_decode('Examen practicado a: '.$nombrePaciente), 0, 0 ,'C');
              
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(140);
            $this->Cell(30, 10, utf8_decode('Fecha: ').$fecha, 0, 0 , 'R');

            $this->Ln(5);
            $this->SetFont('Arial', '', 10);
            $this->Cell(26);
           // $this->Cell(30, 10, utf8_decode('Solicitado por el (la) Dr. (a): '.$nombreMedico), 0, 0 ,'C');
            
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
    

    
    $dia    = "";
    $mes    = "";
    $anio   = "";
    $fecha  = "";

    $dia    = date("d");
    $mes    = date("m");
    $anio   = date("Y");
    $fecha  = $anio."-".$mes."-".$dia;


    $con = mysqli_connect($host, $user, $pwd, $db);

    $sql = "SELECT inv.nombre_art, inv.marca, inv.costo_prueba, inv.fechacaducidad,  inv.fechatermino, prov.nombre
                FROM 	inventario AS    inv
                JOIN 	proveedores AS   prov
                ON   	inv.idproveedores = prov.idproveedores
                WHERE   fechatermino <= '$fecha'";

    
    $query = $con -> query($sql);

    
    
    $pdf = new PDF();
    $pdf->Settitle("Reporte Productos Finalizados");
    $pdf->AddPage();
    $pdf->AliasNbPages();


    $pdf->Ln();
    $pdf->Ln(15);
    $pdf->SetX(20);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(175, 6, 'Reporte de Productos finalizados', 0, 1, 'C');

    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetFillColor(45, 76, 130);
    $pdf->SetTextColor(255, 255, 255);

    $pdf->Ln(10);   
    
    $pdf->SetX(5);
    $pdf->Cell(30, 6, 'Nombre '.utf8_decode('Artículo'), 1, 0, 'C', 1);
    
    $pdf->SetX(35);
    $pdf->Cell(40, 6, 'Marca', 1, 0, 'C', 1);
    
    $pdf->SetX(75);
    $pdf->Cell(30, 6, 'Costo Prueba', 1, 0, 'C', 1);
    
    $pdf->SetX(105);
    $pdf->Cell(30, 6, 'Fecha Cad.', 1, 0, 'C', 1);

    $pdf->SetX(135);
    $pdf->Cell(35, 6, 'Fecha termino', 1, 0, 'C', 1);

    $pdf->SetX(170);
    $pdf->Cell(35, 6, 'Proveedor', 1, 0, 'C', 1);
   // $pdf->SetX(155);
    //$pdf->Cell(40, 6, 'Comentarios', 1, 0, 'C', 1);

    
    $pdf->Ln();

    $observaciones = "";
    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
    {
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(0, 0, 0);
        
        $pdf->SetX(5);
        $pdf->Cell(30, 6, $row['nombre_art'], 1, 0, 'C');
        
        $pdf->SetX(35);
        $pdf->Cell(40, 6, $row['marca'], 1, 0, 'C');
        
        $pdf->SetX(75);
        $pdf->Cell(30, 6, $row['costo_prueba'], 1, 0, 'C');
        
        $pdf->SetX(105);
        $pdf->Cell(30, 6, $row['fechacaducidad'], 1, 0, 'C');

        $pdf->SetX(135);
        $pdf->Cell(35, 6, $row['fechatermino'], 1, 0, 'C');

        $pdf->SetX(170);
        $pdf->Cell(35, 6, $row['nombre'], 1, 1, 'C');

/*
        $pdf->SetX(15);
        $pdf->Cell(30, 6, $row['prueba'], 1, 0, 'C');
        
        $pdf->SetX(45);
        $pdf->Cell(100, 6, $row['resultado'], 1, 0, 'C');
        
        $pdf->SetX(145);
        $pdf->Cell(25, 6, $row['unidades'], 1, 0, 'C');
        
        $pdf->SetX(170);
        $pdf->Cell(25, 6, $row['valorreferencia'], 1, 1, 'C');
        
        //$pdf->SetX(155);
        //$pdf->MultiCell(40, 6, $row['observaciones'], 1, 'C', false);

        $observaciones = $row['comentario'];
*/        
        
    }
   
/*
        $pdf->Ln();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(20);
        $pdf->Cell(170, 6, 'Observaciones', 1, 1, 'C');
        $pdf->SetX(20);
        $pdf->MultiCell(170, 6, $observaciones, 1, 'J', true);
 
        $pdf->Ln(50);
        $pdf->SetX(20);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(180, 6, 'Atentamente', 0, 1, 'C');

        $pdf->Ln(20);
        $pdf->SetX(20);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(180, 6, 'QFB. Fabiola Espinosa Bribiesca', 0, 1, 'C');
*/
        $pdf->Output();
?>