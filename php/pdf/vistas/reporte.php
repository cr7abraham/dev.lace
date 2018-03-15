<?php

	session_start();

	include('../../includes/conexion.php');

	//foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

	date_default_timezone_set('America/Mexico_City');

    $idpr   = 0;

    $idpac  = 0;

    $idmed  = 0;

	$membrete = "";

    $queryhead = "";

    $nombrePaciente = "";

    $nombreMedico   = "";

    $fecha = "";

    $conCuenta = "";

	$observaciones = "";

	$dia    = "";

    $mes    = "";

    $anio   = "";

    $fechaAct  = "";



	$dia    = date("d");

	$mes    = date("m");

    $anio   = date("Y");

	$fechaAct  = $anio."-".$mes."-".$dia;

	$estudio = "";

	$subtitulo = "";

	$filacontar =0;



	$arrayEsp = [];

	

    

		if(isset($_GET['memb'])){

			$membrete = $_GET['memb'];

		}

		if(isset($_GET['array'])){

			$array_restored_from_db = unserialize($_GET['array']);

			//print_r($array_restored_from_db);

		    foreach( $array_restored_from_db as $c){

				  $sqlContar = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.subtitulo, a.estudio

                    FROM analisis AS a 

                    JOIN pacientes AS p 

                    ON a.pacientes_idpacientes = p.idpacientes

                    JOIN medicos m

                    ON a.medicos_idmedicos = m.idmedicos

                    WHERE a.idpropio = '$c'

                    ORDER BY a.idpropio";

    			$conContar = mysqli_connect($host, $user, $pwd, $db);

    			$resultContar = mysqli_query($conContar, $sqlContar);

				$filacontar = mysqli_num_rows($resultContar) + $filacontar;

			}

		}

		

		$conEstudio = mysqli_connect($host, $user, $pwd, $db);

		$sqlEstudio = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.subtitulo, a.estudio

                    FROM analisis AS a 

                    JOIN pacientes AS p 

                    ON a.pacientes_idpacientes = p.idpacientes

                    JOIN medicos m

                    ON a.medicos_idmedicos = m.idmedicos

                    WHERE a.idpropio = '$c'

                    ORDER BY a.idpropio";

		$query2 = $conEstudio -> query($sqlEstudio);

		while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

			if($estudio != $row['estudio']){

        		$estudio = $row['estudio'];

				if($estudio == "ESPERMATOBIOSCOPIA"){			

?>

<?php

		$con = mysqli_connect($host, $user, $pwd, $db);

		

		

/*

		//$conname = mysqli_connect($host, $user, $pwd, $db);

        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha, a.estudio, a.subtitulo

                    FROM analisis AS a 

                    JOIN pacientes AS p 

                    ON a.pacientes_idpacientes = p.idpacientes

                    JOIN medicos m

                    ON a.medicos_idmedicos = m.idmedicos

                    WHERE a.idpropio = '$idpr'

                    ORDER BY a.idpropio;";



        

        $queryname = $con -> query($sqlname);



		$sqlTitles = "SELECT  a.estudio, a.subtitulo

						FROM analisis AS a 

						JOIN pacientes AS p 

						ON a.pacientes_idpacientes = p.idpacientes

						JOIN medicos m

						ON a.medicos_idmedicos = m.idmedicos

						WHERE a.idpropio = '$idpr'

						group by a.estudio

						ORDER BY a.idpropio;";

		$queryTitles = $con -> query($sqlTitles);



		$array = [];

*/

?>

<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->

<style>

<!--

#encabezado {padding:20px 0; border-top: 1px solid #0B08AB; border-bottom: 1px solid #0B08AB; width:100%;}

#encabezado .fila #col_1 {width: 10%}

#encabezado .fila #col_2 {padding: 0px 0px 0px 100px; width: 88%; }

/*#encabezado .fila #col_3 {width: 30%}*/





#encabezado .fila td img {width:120%; margin: 0 0 10px 0;}

#encabezado .fila #col_2 #span1{font-size: 18px; padding: 100px 0 0 0px;}

#encabezado .fila #col_2 #span2{margin:10px 0 0 50px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span3{margin:8px 0 0 45px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span4{margin:8px 0 0 65px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span5{margin:6px 0 0 50px;font-size: 10px; color: #000000; }



/*#footer {padding:25px 0 0 0; border-top: 2px solid #10C86F; width:100%;}*/

#footer .fila td {text-align:left; width:100%; padding:10px 0; }

#footer .fila td span {font-size: 10px; color: #000; padding:50px 0; }



#central {width:100%; margin: 20px 0 0 -40px;}

#central tr td {text-align: left; width:100%; font-size:12px; height:0px;}



#central #datos .fila {font-weight: bold; text-decoration: underline;}





#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}

#footer #atte1 td .attext{width:20%; margin: -25px 0 0 440px; }

#footer #atte2 td .name{width:44%; margin: 0 0 0 440px; }

#footer #atteline td .divline{width:44%; margin: 0 0 0 440px; }

#footer #atte1 td {font-size:10px; width:20%;}

#footer #atte2 td {font-size:10px;}

#paciente {margin-top:-15px;}

#paciente tr td {font-size: 11.5px;}



#encabezado2 {padding:20px 0; border-top: 0px solid #0B08AB; border-bottom: 0px solid #0B08AB; width:100%;}

#encabezado2 .fila2 #col_12 {width: 10%}

#encabezado2 .fila2 #col_22 {padding: 0px 0px 0px 100px; width: 88%; }

/*#encabezado .fila #col_3 {width: 30%}*/

#encabezado2 .fila2 td img {width:120%; margin: 0 0 10px 0;}

#encabezado2 .fila2 #col_2 #span12{font-size: 18px; padding: 100px 0 0 0px;}

#encabezado2 .fila2 #col_2 #span22{margin:10px 0 0 50px;font-size: 10px; color: #000000; }

#encabezado2 .fila2 #col_2 #span32{margin:8px 0 0 45px;font-size: 10px; color: #000000; }

#encabezado2 .fila2 #col_2 #span42{margin:8px 0 0 65px;font-size: 10px; color: #000000; }

#encabezado2 .fila2 #col_2 #span52{margin:6px 0 0 50px;font-size: 10px; color: #000000; }



#central #diasF{ margin: 10px 0 0 0;width: 50%; }

#central #diasF .dias{ width:120px; display:inline; padding:10px;}

#central #diasF .diasres{border: 0.5px solid #000; width:20px;display:inline; padding: 10px; }



#central #aspectos{ margin: 5px 0 0 0; width:50%;display:inline; }



#central #aspectos #aspecto {padding:5px 0 0 5px;}

#central #aspectos #aspecto .nameaspecto{width:120px; display:inline;padding:5px;}

#central #aspectos #aspecto .cajaaspecto{border: 0.5px solid #000; width:20px; display:inline; padding:5px;}

#central #aspectos #aspecto #lado{width:20px; display:inline; margin: 0 0 0 5px;}

#central #aspectos #aspecto #lado .normal{width:20px; margin:0 0 -10px 0;}

#central #aspectos #aspecto #lado .normal2{ width:20px; padding: -12px 0 0 0; margin:0 0 -5px 0;}





#central #aspectos #licuefaccion {padding:-2px 0 0 5px;}

#central #aspectos #licuefaccion .namelicuefaccion{width:120px; display:inline;padding:5px;}

#central #aspectos #licuefaccion .cajalicuefaccion{border: 0.5px solid #000; width:20px; display:inline; padding:5px;}



#central #aspectos #viscosidad {padding:-2px 0 0 5px;}

#central #aspectos #viscosidad .nameviscosidad{width:120px; display:inline;padding:5px;}

#central #aspectos #viscosidad .cajaviscosidad{border: 0.5px solid #000; width:20px; display:inline; padding:5px;}



#central #aspectos #volumen {padding:-2px 0 0 5px;}

#central #aspectos #volumen .namevolumen{width:120px; display:inline;padding:5px;}

#central #aspectos #volumen .cajavolumen{border: 0.5px solid #000; width:20px; display:inline; padding:5px;}

#central #aspectos #volumen .ml{ width:20px; display:inline; padding:5px;}



#central #aspectos #ph {padding:-2px 0 0 5px;}

#central #aspectos #ph .nameph{width:120px; display:inline;padding:5px;}

#central #aspectos #ph .cajaph{border: 0.5px solid #000; width:20px; display:inline; padding:5px;}

#central #aspectos #ph .infoph{ width:20px; display:inline; padding:5px;}



#central #motilidad{ margin: -40px 0 0 120px; width:40%; display:inline;}

#central #motilidad #titulo .titumot{border: 0.5px solid #000; width:100%; padding:5px 0 0 0; text-align:center; }

#central #motilidad #a .letraa{ width:20px; padding: 3px; display:inline;}

#central #motilidad #a .cajaa{border: 0.5px solid #000; width:35px; padding:3px; display:inline; text-align:center}

#central #motilidad #a .porcena{width:20px; padding:3px; display:inline;}

#central #motilidad #a #lado2{width:100px; display:inline; margin: 0 0 0 50px;}

#central #motilidad #a #lado2 .normal{width:100px; }

#central #motilidad #a #lado2 .normal2{ width:100px; padding: -10px 0 0 0; margin:0 0 -5px 0;}

#central #motilidad #b .letrab{width:20px; padding: 3px; display:inline;}

#central #motilidad #b .cajab{border: 0.5px solid #000; width:35px; padding:3px; display:inline; text-align:center}

#central #motilidad #b .porcenb{width:20px; padding:3px; display:inline;}

#central #motilidad #c .letrac{ width:20px; padding: 3px; display:inline;}

#central #motilidad #c .cajac{border: 0.5px solid #000; width:35px; padding:3px; display:inline; text-align:center}

#central #motilidad #c .porcenc{width:20px; padding:3px; display:inline;}

#central #motilidad #c .aprogres{ width:120px; padding:3px; margin: 0 0 0 40px;display:inline;}

#central #motilidad #d .letrad{ width:20px; padding: 3px; display:inline;}

#central #motilidad #d .cajad{border: 0.5px solid #000; width:35px; padding:3px; display:inline; text-align:center}

#central #motilidad #d .porcend{ width:20px; padding:3px; display:inline;}

#central #motilidad #d .bprogres{ width:120px; padding:3px; margin: 0 0 0 40px;display:inline;}

#central #motilidad #movin .cmovimiento{ width:135px; padding:3px; margin: 0 0 0 136px;display:inline;}

#central #motilidad #inmovil .dinmovil{width:135px; padding:3px; margin: 0 0 0 136px;display:inline;}



#central #concentracion { margin: 40px 0 0 45px; width:90%;}

#central #concentracion #concen .concentitulo{ padding: 5px; width: 80px; display:inline;}

#central #concentracion #concen .concentituloline {border-bottom: 1.5px solid #000000; width:90px; height:12px; display:inline; padding:2px;text-align:center;}

#central #concentracion #concen .concentitulomill{ margin: 0 0 0 0; padding: 5px; width: 140px; display:inline;}

#central #concentracion #concen .vrconcentracion{border: 0.5px solid #000; margin: 0 0 0 30px; padding: 5px; width: 160px; display:inline;}



#central #bigdiv{margin: 20px 0 0 45px; width:90%;}

#central #bigdiv #divleft { width:100%;display:inline;}

#central #bigdiv #divleft #via .viabilidad {width:70px; display:inline; padding:2px;text-align:right;}

#central #bigdiv #divleft #via .viabilidadline {border-bottom: 1.5px solid #000000; width:100px; height:12px; display:inline; padding:2px;text-align:center;}

#central #bigdiv #divleft #via .vrviabilidad {border: 0.5px solid #000; width:150px; padding: 2px; display:inline; text-align:center;}

#central #bigdiv #divleft #leu .leucocitos { width:70px; padding: 2px; display:inline; text-align:right;}

#central #bigdiv #divleft #leu .leucocitosline {border-bottom: 1.5px solid #000000; width:100px;height:12px; padding: 2px; display:inline;text-align:center;}

#central #bigdiv #divleft #leu .textleu {width:150px; padding: 2px; display:inline; text-align:center;}

#central #bigdiv #divleft #aglu .aglutinacion { width:70px; padding: 2px; display:inline; text-align:right;}

#central #bigdiv #divleft #aglu .aglutinacionline {border-bottom: 1.5px solid #000000; width:100px; height:12px; padding: 2px; display:inline; text-align:center;}

#central #bigdiv #divleft #aglu .negativa { width:150px; padding: 2px; display:inline; text-align:center;}



#central #bigdiv #divleft #via .bacterias{width:70px; display:inline; padding:2px; margin: 0 0 0 50px; text-align:right;}

#central #bigdiv #divleft #via .bacteriasline{border-bottom: 1.5px solid #000000; width:100px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #via .bacteriasnegativo{ width:70px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #leu .eritrocitos{ width:70px; display:inline; padding:2px; margin: 0 0 0 50px; text-align:right;}

#central #bigdiv #divleft #leu .eritrocitosline{border-bottom: 1.5px solid #000000; width:100px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #leu .eritrocitoscero{width:70px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #aglu .germinales{ width:70px; display:inline; padding:2px; margin: 0 0 0 50px; text-align:right;}

#central #bigdiv #divleft #aglu .germinalesline{border-bottom: 1.5px solid #000000; width:100px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #aglu .germinalesplus{ width:70px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #celulas .epiteliales{width:100px; display:inline; padding:2px; margin: 0 0 0 354px; text-align:right;}

#central #bigdiv #divleft #celulas .epitelialesline{border-bottom: 1.5px solid #000000; width:100px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #celulas .epitelialesplus{ width:70px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #detritus .celulares{width:100px; display:inline; padding:2px; margin: 0 0 0 354px; text-align:right;}

#central #bigdiv #divleft #detritus .celularesline{border-bottom: 1.5px solid #000000; width:100px; display:inline; padding:2px; text-align:center;}

#central #bigdiv #divleft #detritus .celularesplus{ width:70px; display:inline; padding:2px; text-align:center;}





#central #bigdivmorfologia{border: 0.5px solid #000; margin: 20px 0 0 45px; width:90%;}

#central #bigdivmorfologia #divmorfologia .morfologia{ padding: 2px; width: 100%; text-align:center;}

#central #bigdivmorfologia #divvalores .valores{ border-bottom: 0.5px solid #000; padding: 2px; width: 100%; text-align:center;}

#central #bigdivmorfologia #divuno .divnormales{width:80px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right;}

#central #bigdivmorfologia #divuno .divnormalesbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divuno .divnormalesporcent{ width:20px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divuno .divpiriformes{ width:70px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 90px}

#central #bigdivmorfologia #divuno .divpiriformesbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divuno .divpiriformesporcent{width:20px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divuno .divacintados{ width:70px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 90px}

#central #bigdivmorfologia #divuno .divacintadosbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divuno .divacintadosporcent{ width:20px; display:inline; padding:2px; text-align:center;}



#central #bigdivmorfologia #divdos .divmacrocefalos{ width:80px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right;}

#central #bigdivmorfologia #divdos .divmacrocefalosbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divdos .divmacrocefalosporcent{ width:20px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divdos .divcola{width:100px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 60px}

#central #bigdivmorfologia #divdos .divcolabox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divdos .divcolaporcent{ width:20px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divdos .divalfiler{ width:70px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 90px}

#central #bigdivmorfologia #divdos .divalfilerbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divdos .divalfilerporcent{ width:20px; display:inline; padding:2px; text-align:center;}



#central #bigdivmorfologia #divtres .divmicrocefalos{ width:80px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right;}

#central #bigdivmorfologia #divtres .divmicrocefalosbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divtres .divmicrocefalosporcent{width:20px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divtres .divamorfos{ width:100px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 60px}

#central #bigdivmorfologia #divtres .divamorfosbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divtres .divamorfosporcent{ width:20px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divtres .divduplicados{ width:70px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 90px}

#central #bigdivmorfologia #divtres .divduplicadosbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divtres .divduplicadosporcent{width:20px; display:inline; padding:2px; text-align:center;}



#central #bigdivmorfologia #divcuatro .divgota{width:120px; display:inline; padding:2px; margin: 0 0 0 0; text-align:right; margin:0 0 0 450px}

#central #bigdivmorfologia #divcuatro .divgotabox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #bigdivmorfologia #divcuatro .divgotaporcent{ width:20px; display:inline; padding:2px; text-align:center;}



#central #divlast{ margin: 20px 0 0 45px; width:90%;}

#central #divlast #divrowuno .divhinchamiento{ padding: 2px; width: 180px; display: inline; margin: 0 0 0 100px;}

#central #divlast #divrowuno .divhinchamientobox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #divlast #divrowuno .divhinchamientoporcent{width:20px; display:inline; padding:2px; text-align:center;}

#central #divlast #divrowuno .divhinchamientovr{width:100px; display:inline; padding:2px; text-align:center;}

#central #divlast #divrowdos .divconcentracion{padding: 2px; width: 200px; display: inline; margin: 0 0 0 80px;}

#central #divlast #divrowdos .divconcentracionbox{border: 0.5px solid #000000; width:50px; display:inline; padding:2px; text-align:center;}

#central #divlast #divrowdos .divconcentracionmill{ width:310px; display:inline; padding:2px;}



-->

</style>



<!-- page define la hoja con los márgenes señalados -->

<page backtop="40mm" backbottom="10mm" backleft="10mm" backright="20mm">

    <!-- Define el header de la hoja -->

	<?php

		if($membrete == 'true'){

		?>

    <page_header> 

		<table id="encabezado">

            <tr class="fila">

                <td id="col_1" >

					<span id="span2">

						<img src="../../img/logo2.png"/>

					</span>

				</td>

                <td id="col_2">

					<span id="span1">LABORATORIOS DE ANALISIS CLINICOS ESPINOSA</span>

					<br>

					<span id="span2">Suc. Centro, Calle Hidalgo No. 9 Int 1-A Tel. (469) 692 08 75 Pénjamo. Gto.</span>

					<br>

					<span id="span3">Suc. Arboledas, Prol. Insurgentes No. 100 Tel.(469) 692 21 95 Pénjamo. Gto.</span>

					<br>

					<span id="span4">Universidad de Guanajuato Ced. Profesional 1888051 SSA 1931</span>

					<br>

					<span id="span5">Instituto de Hemopatología Ced. Especialidad 5554071 SSA Esp. 4564</span>

				</td>

            </tr>

        </table>

    </page_header>

	<?php

		}

		else{

	?>

	<page_header> 

		<table id="encabezado2">

            <tr class="fila2">

                <td id="col_12" >

					<span id="span22">

						<!--img src="../../img/logo2.png"/-->

					</span>

				</td>

                <td id="col_22">

					<span id="span12"></span>

					<br>

					<span id="span22"></span>

					<br>

					<span id="span32"></span>

					<br>

					<span id="span42"></span>

					<br>

					<span id="span52"></span>

				</td>

            </tr>

        </table>

    </page_header>

	<?php

		}

	?>



    <!-- Fin del cuerpo de la hoja -->



	<!-- page_footer> <!-- Define el footer de la hoja -->

		<table id="footer">

			<tr id="atte1">

				<td>

					<div class="attext" style="font-size:12px;">

						Atentamente

					</div>

				</td>

			</tr>

			<tr id="atteline">

				<td>

					<div class="divline">

						_____________________________

					</div>

				</td>

			</tr>

			<tr id="atte2">

				<td>

					<div class="name" style="font-size=12px;">

						Q. F. B. y E. H. D. L Fabiola Espinosa B.

					</div>

				</td>

			</tr>

            <tr class="fila">

				<td>

				<!--<span>Pénjamo, Gto. <?php echo $fechaAct; ?></span> -->

				</td>

			</tr>

        </table>

    </page_footer -->



        



    

    <!-- Define el cuerpo de la hoja -->

	<?php

	

		foreach( $array_restored_from_db as $c){



			$sql = "SELECT  p.nombre AS paciente, m.nombre AS medico, a.fecha as fecha

						FROM analisis AS a 

						JOIN pacientes AS p 

						ON a.pacientes_idpacientes = p.idpacientes

						JOIN medicos m

						ON a.medicos_idmedicos = m.idmedicos

						WHERE a.idpropio = '$c'

						ORDER BY a.estudio;";



					

				$query = $con -> query($sql);

				

			}

			

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$nombreMedico = $row['medico'];

			$nombrePaciente = $row['paciente'];

			$fecha = $row['fecha'];

		}

	

	?>





	<table id="paciente">

		<tr>

			<td>

				<span>Examen practicado a: <?php echo utf8_encode($nombrePaciente);?></span>

			</td>

		</tr>

		<tr>

			<td>

				<span>Practicado por el médico: <?php echo utf8_encode($nombreMedico);?></span>

			</td>

		</tr>

		<tr>

			<td>

				<span>Fecha de aplicación: <?php echo $fecha;?></span>

			</td>

		</tr>

	</table>



				<?php

				

					foreach( $array_restored_from_db as $c){



						$sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.subtitulo, a.estudio

									FROM analisis AS a 

									JOIN pacientes AS p 

									ON a.pacientes_idpacientes = p.idpacientes

									JOIN medicos m

									ON a.medicos_idmedicos = m.idmedicos

									WHERE a.idpropio = '$c'

									ORDER BY a.estudio;";	

						$query = $con -> query($sql);

					



					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))

        					{

								$observaciones = $row['comentario'];

								array_push($arrayEsp, $row['resultados']);

							} 

					}

					//print_r($arrayEsp);

					

					

				?>

	

	<table id="central">





						<tr>

							<td>

								<?php		

									echo "<b><u>".'ESPERMATOBIOSCOPIA'."</u></b>"."<br>";

								?>

								

								<div id="diasF">

									<div class="dias">Días de abstinencia:</div>

									<div class="diasres" style="font-size:10px"><?php echo $arrayEsp[0];?></div>

								</div>

								<div id="aspectos">

									<div id="aspecto">

										<div class="nameaspecto">Aspecto:</div>

										<div class="cajaaspecto" style="font-size:10px"><?php echo $arrayEsp[1];?></div>

										<div id="lado">

											<div class="normal">1=Normal</div>

											<div class="normal2">2=Anormal</div>

										</div>

									</div>

									<div id="licuefaccion">

										<div class="namelicuefaccion">Licuefacción:</div>

										<div class="cajalicuefaccion" style="font-size:10px"><?php echo $arrayEsp[2];?></div>

									</div>

									<div id="viscosidad">

										<div class="nameviscosidad">Viscosidad:</div>

										<div class="cajaviscosidad" style="font-size:10px"><?php echo $arrayEsp[3];?></div>

									</div>

									<div id="volumen">

										<div class="namevolumen">Volumen:</div>

										<div class="cajavolumen" style="font-size:10px"><?php echo $arrayEsp[4];?></div>

										<div class="ml">ml.</div>

									</div>

									<div id="ph">

										<div class="nameph">pH:</div>

										<div class="cajaph" style="font-size:10px"><?php echo $arrayEsp[5];?></div>

										<div class="infoph">7.0-8.0</div>

									</div>

								</div>

								<div id="motilidad">

									<div id="titulo">

										<div class="titumot">Motilidad</div>

									</div>

									<div id="a">

										<div class="letraa">A:</div>

										<div class="cajaa" style="font-size:10px"><?php echo $arrayEsp[27];?></div>

										<div class="porcena">%</div>

										<div id="lado2">

											<div class="normal">VR. A>=25%</div>

											<div class="normal2">A y B>=50%</div>

										</div>

									</div>

									<div id="b">

										<div class="letrab">B:</div>

										<div class="cajab" style="font-size:10px"><?php echo $arrayEsp[28];?></div>

										<div class="porcenb">%</div>

									</div>

									<div id="c">

										<div class="letrac">C:</div>

										<div class="cajac" style="font-size:10px"><?php echo $arrayEsp[29];?></div>

										<div class="porcenc">%</div>

										<div class="aprogres">A: Progresiva rápida</div>

									</div>

									<div id="d">

										<div class="letrad">D:</div>

										<div class="cajad" style="font-size:10px"><?php echo $arrayEsp[30];?></div>

										<div class="porcend">%</div>

										<div class="bprogres">B: Progresiva lenta</div>

									</div>

									<div id="movin">

										<div class="cmovimiento">C: Movimiento "IN SITU"</div>

									</div>

									<div id="inmovil">

										<div class="dinmovil">D: Inmoviles</div>

									</div>

								</div>

								<div id="concentracion">

									<div id="concen">

										<div class="concentitulo">Concentración:</div>

										<div class="concentituloline" style="font-size:10px"><?php echo $arrayEsp[6];?></div>

										<div class="concentitulomill">Millones de Esp./ml. </div>

										<div class="vrconcentracion">VR >= 20 millones de esp./ml</div>

									</div>

								</div>

								<div id="bigdiv">

									<div id="divleft">

										<div id="via">

											<div class="viabilidad">Viabilidad</div>

											<div class="viabilidadline" style="font-size:10px"><?php echo $arrayEsp[7];?></div>

											<div class="vrviabilidad">VR. >= 75%</div>

											<div class="bacterias">Bacterias</div>

											<div class="bacteriasline" style="font-size:10px"><?php echo $arrayEsp[10];?></div>

											<div class="bacteriasnegativo">Negativo</div>

										</div>

										<div id="leu">

											<div class="leucocitos">Leucocitos</div>

											<div class="leucocitosline" style="font-size:10px"><?php echo $arrayEsp[8];?></div>

											<div class="textleu">0/C</div>

											<div class="eritrocitos">Eritrocitos</div>

											<div class="eritrocitosline" style="font-size:10px"><?php echo $arrayEsp[11];?></div>

											<div class="eritrocitoscero">0/C</div>

										</div>

										<div id="aglu">

											<div class="aglutinacion">Aglutinación</div>

											<div class="aglutinacionline" style="font-size:10px"><?php echo $arrayEsp[9];?></div>

											<div class="negativa">Negativa / Inespecífica</div>

											<div class="germinales">Germinales</div>

											<div class="germinalesline" style="font-size:10px"><?php echo $arrayEsp[12];?></div>

											<div class="germinalesplus">++/C</div>

										</div>

										<div id="celulas">

											<div class="epiteliales">Cel. Epiteliales</div>

											<div class="epitelialesline" style="font-size:10px"><?php echo $arrayEsp[13];?></div>

											<div class="epitelialesplus">+/C</div>

										</div>

										<div id="detritus">

											<div class="celulares">Detritus Celulares</div>

											<div class="celularesline" style="font-size:10px"><?php echo $arrayEsp[14];?></div>

											<div class="celularesplus">+/C</div>

										</div>

									</div>

								</div>

								<div id="bigdivmorfologia">

									<div id="divmorfologia">

										<div class="morfologia">MORFOLOGIA</div>

									</div>

									<div id="divvalores">

										<div class="valores">VALORES DE REFERENCIA: POR CRITERIOS ESTRICTOS DE KRUGER >= 14%</div>

									</div>

									<div id="divuno">

										<div class="divnormales">Normales:</div>

										<div class="divnormalesbox" style="font-size:10px"><?php echo $arrayEsp[15];?></div>

										<div class="divnormalesporcent">%</div>

										<div class="divpiriformes">Piriformes:</div>

										<div class="divpiriformesbox" style="font-size:10px"><?php echo $arrayEsp[18];?></div>

										<div class="divpiriformesporcent">%</div>

										<div class="divacintados">Acintados:</div>

										<div class="divacintadosbox" style="font-size:10px"><?php echo $arrayEsp[21];?></div>

										<div class="divacintadosporcent">%</div>

									</div>

									<div id="divdos">

										<div class="divmacrocefalos">Macrocefalos:</div>

										<div class="divmacrocefalosbox" style="font-size:10px"><?php echo $arrayEsp[16];?></div>

										<div class="divmacrocefalosporcent">%</div>

										<div class="divcola">Cola anormal:</div>

										<div class="divcolabox" style="font-size:10px"><?php echo $arrayEsp[19];?></div>

										<div class="divcolaporcent">%</div>

										<div class="divalfiler">Alfiler:</div>

										<div class="divalfilerbox" style="font-size:10px"><?php echo $arrayEsp[22];?></div>

										<div class="divalfilerporcent">%</div>

									</div>

									<div id="divtres">

										<div class="divmicrocefalos">Microcefalos:</div>

										<div class="divmicrocefalosbox" style="font-size:10px"><?php echo $arrayEsp[17];?></div>

										<div class="divmicrocefalosporcent">%</div>

										<div class="divamorfos">Amorfos:</div>

										<div class="divamorfosbox" style="font-size:10px"><?php echo $arrayEsp[20];?></div>

										<div class="divamorfosporcent">%</div>

										<div class="divduplicados">Duplicados:</div>

										<div class="divduplicadosbox" style="font-size:10px"><?php echo $arrayEsp[23];?></div>

										<div class="divduplicadosporcent">%</div>

									</div>

									<div id="divcuatro">

										<div class="divgota">Gota citoplasmática</div>

										<div class="divgotabox" style="font-size:10px"><?php echo $arrayEsp[24];?></div>

										<div class="divgotaporcent">%</div>

									</div>

								</div>

								<div id="divlast">

									<div id="divrowuno">

										<div class="divhinchamiento">P. Hinchamiento Hiposmótica:</div>

										<div class="divhinchamientobox" style="font-size:10px"><?php echo $arrayEsp[25];?></div>

										<div class="divhinchamientoporcent">%</div>

										<div class="divhinchamientovr">VR > 60%</div>

									</div>

									<div id="divrowdos">

										<div class="divconcentracion">Concentración Espermática Total:</div>

										<div class="divconcentracionbox" style="font-size:10px"><?php echo $arrayEsp[26];?></div>

										<div class="divconcentracionmill">millones de esp/eyaculado VR: >= 40 mill. esp/eyaculado</div>

									</div>

								</div>





								<table id="datos">

									<tr>

										<td style="width:300px; font-size:10px;">

											<?php 	

													$pru = $row['prueba'];

													//$prueba = wordwrap($pru, 10, "\n");

													//echo $pru;		

											?>

										</td>

										<td style="width:90px; font-size:10px;">

											<?php

													$res = $row['resultados'];

												 	//$resultados = wordwrap($res, 10, "\n");

													//echo $res;		

											?>

										</td>

										<td style="width:100px; font-size:10px;">

											<?php 	

													$uni = $row['unidades'];

													//$unidades = wordwrap($uni, 10, "\n") ;

													//echo $uni;

											?>

										</td>

										<td style="width:120px; font-size:10px;">

											<?php 	

													$val = $row['valorreferencia'];

													//$valorref = wordwrap($val, 3, true);

													//echo "$val ";

											?>

										</td>						

									</tr>

								</table>

							</td>

						</tr>

				



				<table id="line">

					<tr>

						<td></td>

					</tr>

				</table>

				<table>

					<tr>

						<td style="font-size:12px;">

							Observaciones: <?php echo $observaciones;?>

						</td>

					</tr>

				</table>		

	</table>

	





</page>



















					

<?php				}else{?>

		

<?php		



	if($filacontar <= 7){



		$con = mysqli_connect($host, $user, $pwd, $db);



        $sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario

                    FROM analisis AS a 

                    JOIN pacientes AS p 

                    ON a.pacientes_idpacientes = p.idpacientes

                    JOIN medicos m

                    ON a.medicos_idmedicos = m.idmedicos

                    WHERE a.idpropio = '$idpr'

                    ORDER BY a.idpropio;";



        

        $query = $con -> query($sql);





		//$conname = mysqli_connect($host, $user, $pwd, $db);

        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha, a.estudio, a.subtitulo

                    FROM analisis AS a 

                    JOIN pacientes AS p 

                    ON a.pacientes_idpacientes = p.idpacientes

                    JOIN medicos m

                    ON a.medicos_idmedicos = m.idmedicos

                    WHERE a.idpropio = '$idpr'

                    ORDER BY a.idpropio;";



        

       

	

	

	

?>

<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->

<style>

<!--

#encabezado {padding:20px 0; border-top: 1px solid #0B08AB; border-bottom: 1px solid #0B08AB; width:100%;}

#encabezado .fila #col_1 {width: 10%}

#encabezado .fila #col_2 {padding: 0px 0px 0px 100px; width: 88%; }

/*#encabezado .fila #col_3 {width: 30%}*/





#encabezado .fila td img {width:120%; margin: 0 0 10px 0;}

#encabezado .fila #col_2 #span1{font-size: 18px; padding: 100px 0 0 0px;}

#encabezado .fila #col_2 #span2{margin:10px 0 0 50px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span3{margin:8px 0 0 45px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span4{margin:8px 0 0 65px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span5{margin:6px 0 0 50px;font-size: 10px; color: #000000; }



/*

#footer {padding-top:5px 0; border-top: 2px solid #10C86F; width:100%;}

#footer .fila td {text-align:left; width:100%;}

#footer .fila td span {font-size: 10px; color: #000;}

#footer tr td .divatte {margin: 0 0 0 500px; font-size: 10px;}

#footer tr td .divatte2 {margin: 10px 0 0 500px; font-size: 10px;}

#footer tr td .divqfb {margin: 0 0 0 500px; font-size: 10px;}

*/

#central {width:100%; margin: 20px 0 0 -40px;}

#central tr td {text-align: left; width:100%; font-size:12px;}



#titulo tr td {font-size:11.5px; text-decoration: underline; font-weight: bold;}

#subtitulo tr td {font-size:11.5px; align-text: center; font-weight: bold;}

#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}





#linefooter {margin: 20px 30px 0 0 ; border-bottom: 2px solid #10C86F;  width:100%; }



#paciente {margin: 100px 0 0 0 ;}

#paciente tr td {font-size: 11px;}

#nobreak { page-break-inside: avoid;}



#divfooter #divfecha {width: 60px; font-size: 12px; display:inline}

#divfooter #divatte {width: 65px; font-size: 12px; margin: 0 0 0 480px;}

#divfooter #divline {width: 150px; margin: 10px 0 0 460px; }

#divfooter #divnombre {width: 220px; font-size: 12px; margin: 2px 0 0 460px;}



-->

</style>



<!-- page define la hoja con los márgenes señalados -->

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">

    <!-- Define el header de la hoja -->

	<?php

		if($membrete == 'true'){

		?>

    <page_header> 

		<table id="encabezado">

            <tr class="fila">

                <td id="col_1" >

					<span id="span2">

						<img src="../../img/logo2.png"/>

					</span>

				</td>

                <td id="col_2">

					<span id="span1">LABORATORIOS DE ANALISIS CLINICOS ESPINOSA</span>

					<br>

					<span id="span2">Suc. Centro, Calle Hidalgo No. 9 Int 1-A Tel. (469) 692 08 75 Pénjamo. Gto.</span>

					<br>

					<span id="span3">Suc. Arboledas, Prol. Insurgentes No. 100 Tel.(469) 692 21 95 Pénjamo. Gto.</span>

					<br>

					<span id="span4">Universidad de Guanajuato Ced. Profesional 1888051 SSA 1931</span>

					<br>

					<span id="span5">Instituto de Hemopatología Ced. Especialidad 5554071 SSA Esp. 4564</span>

				</td>

            </tr>

        </table>



    </page_header>

	<?php

		}

	?>

        


	<br>
    

    <!-- Define el cuerpo de la hoja -->

	<?php

		foreach( $array_restored_from_db as $c){



			$sql = "SELECT p.nombre AS paciente, m.nombre AS medico, a.fecha as fecha, a.estudio, a.subtitulo

						FROM analisis AS a 

						JOIN pacientes AS p 

						ON a.pacientes_idpacientes = p.idpacientes

						JOIN medicos m

						ON a.medicos_idmedicos = m.idmedicos

						WHERE a.idpropio = '$c'

						ORDER BY a.estudio;";



					

				$query = $con -> query($sql);

			}

			 

		

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$nombreMedico = $row['medico'];

			$nombrePaciente = $row['paciente'];

			$fecha = $row['fecha'];

			$estudio = $row['estudio'];

			$subtitulo = $row['subtitulo'];

		}

		/*

		while ($row = mysqli_fetch_array($queryname, MYSQLI_ASSOC)) {

			$nombreMedico = $row['medico'];

			$nombrePaciente = $row['paciente'];

			$fecha = $row['fecha'];

			$estudio = $row['estudio'];

			$subtitulo = $row['subtitulo'];

		}

		*/

	?>





	<table id="paciente">

		<tr>

			<td>

				<span>Examen practicado a: <?php echo "<u>".utf8_encode($nombrePaciente)."</u>";?></span>

			</td>

		</tr>

		<tr>

			<td>

				<span>Practicado por el médico: <?php echo "<u>".utf8_encode($nombreMedico)."</u>";?></span>

			</td>

		</tr>

		<tr>

			<td>

				<span>Fecha de aplicación: <?php echo $fecha;?></span>

			</td>

		</tr>

	</table>

	

	<table id="central">

				<?php

					foreach( $array_restored_from_db as $c){



						$sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.coment2, a.subtitulo, a.estudio

									FROM analisis AS a 

									JOIN pacientes AS p 

									ON a.pacientes_idpacientes = p.idpacientes

									JOIN medicos m

									ON a.medicos_idmedicos = m.idmedicos

									WHERE a.idpropio = '$c'

									ORDER BY a.estudio;";	

						$query = $con -> query($sql);

						

					$estudio = "";

	                $subtitulo = "";

					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))

        					{

								

								$observaciones = $row['comentario'];

							

				?>

						<tr>

							<td >

							<div style="margin-top: -15px">

								<?php

										if($estudio != $row['estudio']){

												$estudio = $row['estudio'];

												echo "<br><b><u>".$estudio."</u></b>"."<br>";

											}	

								

										if($subtitulo != $row['subtitulo']){

											$subtitulo = $row['subtitulo'];

											echo "<div align='center'><b>".$row['subtitulo']."</b></div>"; ?>

											

													<table id="datos">

														<tr class="fila">

															<td style="width:250px">

																Prueba

															</td>

															<td style="width:90px">

																Resultados

															</td>

															<td style="width:100px">

																Unidades

															</td>

															<td style="width:120px">

																Valor de Referencia

															</td>

															<td style="width:120px">

																Comentarios

															</td>

														</tr>

													</table>

													<table id="line2">

														<tr>

															<td></td>

														</tr>

													</table>

												

										<?php } ?>

									</div>

								<table id="datos">

									<tr>

									

										<td style="width:250px; font-size:12px; padding: 0 0 0 0">

											<?php 	

													$pru = $row['prueba'];

													//$prueba = wordwrap($pru, 10, "\n");

													echo $pru;		

											?>

										</td>

										<td style="width:90px; font-size:12px; padding: 0 0 0 20px">

											<?php

													$res = $row['resultados'];

												 	//$resultados = wordwrap($res, 10, "\n");

													echo $res;		

											?>

										</td>

										<td style="width:100px; font-size:12px; padding: 0 0 0 -18px">

											<?php 	

													$uni = $row['unidades'];

													//$unidades = wordwrap($uni, 10, "\n") ;

													echo $uni;

											?>

										</td>

										<td style="width:120px; font-size:12px; padding: 0 0 0 40px">

											<?php 	

													$val = $row['valorreferencia'];

													//$valorref = wordwrap($val, 3, true);

													echo "$val ";

											?>

										</td>	
										
										<td style="width:120px; font-size:12px; padding: 0 0 0 -55px">

											<?php 	
//CGLG 02.06.2017
													$val = $row['coment2'];

													//$valorref = wordwrap($val, 3, true);

													echo "$val ";
//CGLG 02.06.2017
											?>

										</td>					

									</tr>

								</table>

							

							</td>

						</tr>

				<?php

							}

					}

				?>

				<table id="line">

					<tr>

						<td></td>

					</tr>

				</table>

				<table>

					<tr>

						<td style="font-size:12px;">

							Observaciones: <?php echo $observaciones;?>

						</td>

					</tr>

				</table>

				<!--<table id="linefooter">

					<tr>

						<td></td>

					</tr>

				</table> -->

				<!-- div id="divfooter" >

					<div id="divatte" style="font-size: 12px;">Atentamente</div>

					<div id="divline">_____________________________</div>

					<div id="divnombre" style="font-size: 12px;">Q. F. B. y E. H. D. L Fabiola Espinosa B.</div>

				</div -->





	</table>

    <!-- Fin del cuerpo de la hoja -->



	<!--page_footer>

		<table id="footer">

			<tr>

				<td>

					<div class="divatte">

						Atentamente

					</div>

				</td>

			</tr>

			<tr>

				<td>

					<div class="divatte2">

						________________________________

					</div>

				</td>

			</tr>

			<tr>

				<td>

					<div class="divqfb">

						Q. F. B. Fabiola Espinosa Bribiesca 

					</div>

				</td>

			</tr>

            <tr class="fila">

				<td>

					<span>Pénjamo, Gto. <?php //echo $fechaAct; ?></span>

				</td>

			</tr>

        </table>

    </page_footer -->

	



</page>

<?php 

	}

	else{

		$con = mysqli_connect($host, $user, $pwd, $db);

		$estudio = "";

		$subtitulo = "";

		



		//$conname = mysqli_connect($host, $user, $pwd, $db);

        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha, a.estudio, a.subtitulo

                    FROM analisis AS a 

                    JOIN pacientes AS p 

                    ON a.pacientes_idpacientes = p.idpacientes

                    JOIN medicos m

                    ON a.medicos_idmedicos = m.idmedicos

                    WHERE a.idpropio = '$idpr'

                    ORDER BY a.idpropio;";



        

        $queryname = $con -> query($sqlname);



		$sqlTitles = "SELECT  a.estudio, a.subtitulo

						FROM analisis AS a 

						JOIN pacientes AS p 

						ON a.pacientes_idpacientes = p.idpacientes

						JOIN medicos m

						ON a.medicos_idmedicos = m.idmedicos

						WHERE a.idpropio = '$idpr'

						group by a.estudio

						ORDER BY a.idpropio;";

		$queryTitles = $con -> query($sqlTitles);



		$array = [];



?>

<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->

<style>

<!--

#encabezado {padding:20px 0; border-top: 1px solid #0B08AB; border-bottom: 1px solid #0B08AB; width:100%;}

#encabezado .fila #col_1 {width: 10%}

#encabezado .fila #col_2 {padding: 0px 0px 0px 100px; width: 88%; }

/*#encabezado .fila #col_3 {width: 30%}*/





#encabezado .fila td img {width:120%; margin: 0 0 10px 0;}

#encabezado .fila #col_2 #span1{font-size: 18px; padding: 100px 0 0 0px;}

#encabezado .fila #col_2 #span2{margin:10px 0 0 50px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span3{margin:8px 0 0 45px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span4{margin:8px 0 0 65px;font-size: 10px; color: #000000; }

#encabezado .fila #col_2 #span5{margin:6px 0 0 50px;font-size: 10px; color: #000000; }





 /*#footer {padding:1px 0 0 0; border-top: 2px solid #10C86F; width:100%;}*/

#footer .fila td {text-align:left; width:100%; padding:10px 0; }

#footer .fila td span {font-size: 10px; color: #000; padding:50px 0; }





#central {width:100%; margin: 20px 0 0 -40px;}

#central tr td {text-align: left; width:100%; font-size:12px; height:0px;}



#central #datos .fila {font-weight: bold; font-size:12px;}



#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}

#line2 {margin-top:0px ; border-top: 1px solid #000; width:108%;}

#footer #atte1 td .attext{width:20%; margin: 0 0 0 520px; padding: 0 0 40px 0;}

#footer #atte2 td .name{width:44%; margin: 0 0 0 440px;}

#footer #atteline td .divline{margin: 0 0 0 440px; }

#footer #atte1 td {font-size:10px; width:20%;}

#footer #atte2 td {font-size:10px;}

#paciente {margin-top:-15px;}

#paciente tr td {font-size: 11.5px;}



#encabezado2 {padding:20px 0; border-top: 0px solid #0B08AB; border-bottom: 0px solid #0B08AB; width:100%;}

#encabezado2 .fila2 #col_12 {width: 10%}

#encabezado2 .fila2 #col_22 {padding: 0px 0px 0px 100px; width: 88%; }

/*#encabezado .fila #col_3 {width: 30%}*/

#encabezado2 .fila2 td img {width:120%; margin: 0 0 10px 0;}

#encabezado2 .fila2 #col_2 #span12{font-size: 18px; padding: 100px 0 0 0px;}

#encabezado2 .fila2 #col_2 #span22{margin:10px 0 0 50px;font-size: 10px; color: #000000; }

#encabezado2 .fila2 #col_2 #span32{margin:8px 0 0 45px;font-size: 10px; color: #000000; }

#encabezado2 .fila2 #col_2 #span42{margin:8px 0 0 65px;font-size: 10px; color: #000000; }

#encabezado2 .fila2 #col_2 #span52{margin:6px 0 0 50px;font-size: 10px; color: #000000; }





-->

</style>



<!-- page define la hoja con los márgenes señalados -->

<page backtop="40mm" backbottom="10mm" backleft="10mm" backright="20mm">

    <!-- Define el header de la hoja -->

	<?php

		if($membrete == 'true'){

		?>

    <page_header> 

		<table id="encabezado">

            <tr class="fila">

                <td id="col_1" >

					<span id="span2">

						<img src="../../img/logo2.png"/>

					</span>

				</td>

                <td id="col_2">

					<span id="span1">LABORATORIOS DE ANALISIS CLINICOS ESPINOSA</span>

					<br>

					<span id="span2">Suc. Centro, Calle Hidalgo No. 9 Int 1-A Tel. (469) 692 08 75 Pénjamo. Gto.</span>

					<br>

					<span id="span3">Suc. Arboledas, Prol. Insurgentes No. 100 Tel.(469) 692 21 95 Pénjamo. Gto.</span>

					<br>

					<span id="span4">Universidad de Guanajuato Ced. Profesional 1888051 SSA 1931</span>

					<br>

					<span id="span5">Instituto de Hemopatología Ced. Especialidad 5554071 SSA Esp. 4564</span>

				</td>

            </tr>

        </table>

    </page_header>

	<?php

		}

		else{

	?>

	<page_header> 

		<table id="encabezado2">

            <tr class="fila2">

                <td id="col_12" >

					<span id="span22">

						<!--img src="../../img/logo2.png"/-->

					</span>

				</td>

                <td id="col_22">

					<span id="span12"></span>

					<br>

					<span id="span22"></span>

					<br>

					<span id="span32"></span>

					<br>

					<span id="span42"></span>

					<br>

					<span id="span52"></span>

				</td>

            </tr>

        </table>

    </page_header>

	<?php

		}

	?>



    <!-- Fin del cuerpo de la hoja -->

   

    <!-- Define el cuerpo de la hoja -->

	<?php 

	

		foreach( $array_restored_from_db as $c){



			$sql = "SELECT  p.nombre AS paciente, m.nombre AS medico, a.fecha as fecha

						FROM analisis AS a 

						JOIN pacientes AS p 

						ON a.pacientes_idpacientes = p.idpacientes

						JOIN medicos m

						ON a.medicos_idmedicos = m.idmedicos

						WHERE a.idpropio = '$c'

						ORDER BY a.estudio;";



					

				$query = $con -> query($sql);

			}

			

		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

			$nombreMedico = $row['medico'];

			$nombrePaciente = $row['paciente'];

			$fecha = $row['fecha'];

		}

	?>





	<table id="paciente">

		<tr>

			<td>

				<span>Examen practicado a: <?php echo "<u>".utf8_encode($nombrePaciente)."</u>";?></span>

			</td>

		</tr>

		<tr>

			<td>

				<span>Practicado por el médico: <?php echo "<u>".utf8_encode($nombreMedico)."</u>";?></span>

			</td>

		</tr>

		<tr>

			<td>

				<span>Fecha de aplicación: <?php echo $fecha;?></span>

			</td>

		</tr>

	</table>





	

	<table id="central">

				<?php

					foreach( $array_restored_from_db as $c){



						$sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.coment2, a.subtitulo, a.estudio

									FROM analisis AS a 

									JOIN pacientes AS p 

									ON a.pacientes_idpacientes = p.idpacientes

									JOIN medicos m

									ON a.medicos_idmedicos = m.idmedicos

									WHERE a.idpropio = '$c'

									ORDER BY a.estudio;";	

						$query = $con -> query($sql);

					



					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))

        					{

								$observaciones = $row['comentario'];

				?>



						<tr>

							<td>

								<?php

									if($estudio != $row['estudio']){

											$estudio = $row['estudio'];

											echo "<br><b><u>".$estudio."</u></b>"."<br>";

										}	

							

									if($subtitulo != $row['subtitulo']){

										$subtitulo = $row['subtitulo'];

										echo "<div align='center'><b>".$row['subtitulo']."</b></div>"; ?>

										

												<table id="datos">

													<tr class="fila">

														<td style="width:250px">

															Prueba

														</td>

														<td style="width:90px">

															Resultados

														</td>

														<td style="width:100px">

															Unidades

														</td>

														<td style="width:120px">

															Valor de Referencia

														</td>

														<td style="width:120px">

															Comentarios

														</td>

													</tr>

												</table>

												<table id="line2">

													<tr>

														<td></td>

													</tr>

												</table>

											

									<?php } ?>

								<table id="datos">

									<tr>

										<td style="width:250px; font-size:12px; padding: 0 0 0 0">

											<?php 	

													$pru = $row['prueba'];

													//$prueba = wordwrap($pru, 10, "\n");

													echo $pru;		

											?>

										</td>

										<td style="width:90px; font-size:12px; padding: 0 0 0 15px">

											<?php

													$res = $row['resultados'];

												 	//$resultados = wordwrap($res, 10, "\n");

													echo $res;		

											?>

										</td>

										<td style="width:100px; font-size:12px; padding: 0 0 0 -20px">

											<?php 	

													$uni = $row['unidades'];

													//$unidades = wordwrap($uni, 10, "\n") ;

													echo $uni;

											?>

										</td>

										<td style="width:120px; font-size:12px; padding: 0 0 0 20px">

											<?php 	

													$val = $row['valorreferencia'];

													//$valorref = wordwrap($val, 3, true);

													echo "$val ";

											?>

										</td>

										<td style="width:120px; font-size:12px; padding: 0 0 0 20px">

											<?php 	
//CGLG 02.06.2017
													$val = $row['coment2'];

													//$valorref = wordwrap($val, 3, true);

													echo "$val ";
//CGLG 02.06.2017
											?>

										</td>						

									</tr>

								</table>

							</td>

						</tr>

				<?php

							} 

					}

				?>



				<table id="line">

					<tr>

						<td></td>

					</tr>

				</table>

				<table>

					<tr>

						<td style="font-size:12px;">

							Observaciones: <?php echo $observaciones;?>

						</td>

					</tr>

				</table>		

	</table>

	





</page>









<?php

	}

?>

					









<?php

				}

			}

		}

?>

		

		

		

			

		

