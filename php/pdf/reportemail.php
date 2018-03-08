<?php
	//ob_start guardará en un búfer lo que esté
	//en la ruta del include.
	ob_start();
    include(dirname(__FILE__).'/vistas/reportemail.php');
    //En una variable llamada $content se obtiene lo que tenga la ruta especificada
    //NOTA: Se usa ob_get_clean porque trae SOLO el contenido
    //Evitará este error tan común en FPDF:
    //FPDF error: Some data has already been output, can't send PDF
    $content = ob_get_clean();

    //Se obtiene la librería
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    /* Las lineas siguientes siempre serán las mismas
     * A mi parecer no hay mucho que explicar. Se explican
     * por sí solas :D
     * */
     
     

     if($filacontar <= 6){
        //$html2pdf = new HTML2PDF('P', array($width_in_mm,$height_in_mm), 'en', true, 'UTF-8', array(0, 0, 0, 0));
        try
        {
            $html2pdf = new HTML2PDF('L', array(210, 148.5), 'es', true, 'UTF-8', 3); //Configura la hoja
            $html2pdf->pdf->SetDisplayMode('fullpage'); //Ver otros parámetros para SetDisplaMode
            $html2pdf->writeHTML($content); //Se escribe el contenido 
            $html2pdf->Output('Reporte.pdf'); //Nombre default del PDF
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
     } 
     else{
        try
        {
            $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', 3); //Configura la hoja
            $html2pdf->pdf->SetDisplayMode('fullpage'); //Ver otros parámetros para SetDisplaMode
            $html2pdf->writeHTML($content); //Se escribe el contenido 
            $html2pdf->Output('Reporte.pdf'); //Nombre default del PDF
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
     }

    
?>
