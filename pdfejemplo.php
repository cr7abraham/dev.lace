<?php
    include('fpdf181/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPAge();
    $pdf->SetFont('Arial', 'B', '16');
    $pdf->Cell(40, 10, 'Hola Mundo');
    $pdf->Output();

?>