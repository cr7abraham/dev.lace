<?php
    include('fpdf181/fpdf.php');

    class PDF extends FPDF
    {
//******Cabecera
        function Header()
        {
            //Logo
            $this->Image('img/conf.png', 10, 8, 33);
            //Fuente
            $this->SetFont('Arial', 'B', 15);
            //Espacio
            $this->Cell(80);
            //Titulo
            $this->Cell(30, 10, 'Ejemplo', 1, 0 ,'C');
            //Salto de linea
            $this->Ln(30);
        }

//******Pie de pagina
        function Footer()
        {
            //Posicion: a 1.5 cm del final
            $this->SetY(-15);
            //Arial Italic 8
            $this->SetFont('Arial', 'I', 8);
            //Numero de pagina
            $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');

        }
    }

//******Creacion del objeto de la clase heredada
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPAge();
    $pdf->SetFont('Times', '', 12);
    for($i=1; $i<=40; $i++){
        $pdf->Cell(0, 10, 'Imprimiendo linea número '.$i, 0, 1);
    }
    $pdf->Output();

    

?>