<?php

	include('../../includes/conexion.php');
	foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

    $idpr   = 0;
    $idpac  = 0;
    $idmed  = 0;
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

		$con = mysqli_connect($host, $user, $pwd, $db);

        $sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.observaciones
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $query = $con -> query($sql);


		//$conname = mysqli_connect($host, $user, $pwd, $db);
        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $queryname = $con -> query($sqlname);

	
	
	
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

#footer {padding-top:5px 0; border-top: 2px solid #10C86F; width:100%;}
#footer .fila td {text-align:right; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}

#central {width:100%; margin: 20px 0 0 -40px;}
#central tr td {text-align: left; width:100%; font-size:12px;}


#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}
#atte {margin-top:80px;}
#paciente {margin-top:100px;}
#paciente tr td {font-size: 11.5px;}


-->
</style>

<!-- page define la hoja con los márgenes señalados -->
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">
    <page_header> <!-- Define el header de la hoja -->
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
        

    
    <!-- Define el cuerpo de la hoja -->
	<?php
		while ($row = mysqli_fetch_array($queryname, MYSQLI_ASSOC)) {
			$nombreMedico = $row['medico'];
			$nombrePaciente = $row['paciente'];
			$fecha = $row['fecha'];
		}
	?>


	<table id="paciente">
		<tr>
			<td>
				<span>Examen practicado a: <?php echo $nombrePaciente;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Practicado por el médico: <?php echo $nombreMedico;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Fecha de aplicación: <?php echo $fecha;?></span>
			</td>
		</tr>
	</table>

	
	<table id="central">
		<tr>
			<td >
				<table id="datos">
					<tr class="fila">
						<td style="width:300px">
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
					</tr>
				</table>
			</td>
		</tr>
				<?php
					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
        					{
								
								$observaciones = $row['comentario'];
							
				?>
						<tr>
							<td >
								<table id="datos">
									<tr>
									
										<td style="width:300px; font-size:10px;">
											<?php 	
													$pru = $row['prueba'];
													//$prueba = wordwrap($pru, 10, "\n");
													echo $pru;		
											?>
										</td>
										<td style="width:90px; font-size:10px;">
											<?php
													$res = $row['resultados'];
												 	//$resultados = wordwrap($res, 10, "\n");
													echo $res;		
											?>
										</td>
										<td style="width:100px; font-size:10px;">
											<?php 	
													$uni = $row['unidades'];
													//$unidades = wordwrap($uni, 10, "\n") ;
													echo $uni;
											?>
										</td>
										<td style="width:120px; font-size:10px;">
											<?php 	
													$val = $row['valorreferencia'];
													//$valorref = wordwrap($val, 3, true);
													echo "$val ";
											?>
										</td>						
									</tr>
								</table>
							</td>
						</tr>
				<?php
							}
				?>
				<table id="line">
					<tr>
						<td></td>
					</tr>
				</table>
				<table>
					<tr>
						<td style="font-size:10px;">
							Observaciones: <?php echo $observaciones;?>
						</td>
					</tr>
				</table>
				<table id="atte">
					<tr>
						<td>
							Atentamente
						</td>
					</tr>
					<tr>
						<td>
							Q. F. B. Fabiola Espinosa Bribiesca ________________________________
						</td>
					</tr>
				</table>
				
				
	</table>
    <!-- Fin del cuerpo de la hoja -->

	<page_footer> <!-- Define el footer de la hoja -->
		<table id="footer">
            <tr class="fila">
				<td>
					<span>Pénjamo, Gto. <?php echo $fechaAct; ?></span>
				</td>
			</tr>
        </table>
    </page_footer>

</page>
<?php 
	}
	else{
		$con = mysqli_connect($host, $user, $pwd, $db);

        $sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.observaciones
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $query = $con -> query($sql);


		//$conname = mysqli_connect($host, $user, $pwd, $db);
        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $queryname = $con -> query($sqlname);

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

#footer {padding-top:5px 0; border-top: 2px solid #10C86F; width:100%;}
#footer .fila td {text-align:right; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}

#central {width:100%; margin: 20px 0 0 -40px;}
#central tr td {text-align: left; width:100%; font-size:12px}

#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}
#atte {margin-top:80px;}
#paciente {margin-top:100px;}
#paciente tr td {font-size: 11.5px;}


-->
</style>

<!-- page define la hoja con los márgenes señalados -->
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">
    <page_header> <!-- Define el header de la hoja -->
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
        

    
    <!-- Define el cuerpo de la hoja -->
	<?php
		while ($row = mysqli_fetch_array($queryname, MYSQLI_ASSOC)) {
			$nombreMedico = $row['medico'];
			$nombrePaciente = $row['paciente'];
			$fecha = $row['fecha'];
		}
	?>


	<table id="paciente">
		<tr>
			<td>
				<span>Examen practicado a: <?php echo $nombrePaciente;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Practicado por el médico: <?php echo $nombreMedico;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Fecha de aplicación: <?php echo $fecha;?></span>
			</td>
		</tr>
	</table>

	
	<table id="central">
		<tr>
			<td >
				<table id="datos">
					<tr class="fila">
						<td style="width:300px">
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
					</tr>
				</table>
			</td>
		</tr>
				<?php
					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
        					{
								
								$observaciones = $row['comentario'];
							
				?>
						<tr>
							<td >
								<table id="datos">
									<tr>
									
										<td style="width:300px; font-size:10px;">
											<?php 	
													$pru = $row['prueba'];
													//$prueba = wordwrap($pru, 10, "\n");
													echo $pru;		
											?>
										</td>
										<td style="width:90px; font-size:10px;">
											<?php
													$res = $row['resultados'];
												 	//$resultados = wordwrap($res, 10, "\n");
													echo $res;		
											?>
										</td>
										<td style="width:100px; font-size:10px;">
											<?php 	
													$uni = $row['unidades'];
													//$unidades = wordwrap($uni, 10, "\n") ;
													echo $uni;
											?>
										</td>
										<td style="width:120px; font-size:10px;">
											<?php 	
													$val = $row['valorreferencia'];
													//$valorref = wordwrap($val, 3, true);
													echo "$val ";
											?>
										</td>						
									</tr>
								</table>
							</td>
						</tr>
				<?php
							}
				?>
				<table id="line">
					<tr>
						<td></td>
					</tr>
				</table>
				<table>
					<tr>
						<td style="font-size:10px;">
							Observaciones: <?php echo $observaciones;?>
						</td>
					</tr>
				</table>
				<table id="atte">
					<tr>
						<td>
							Atentamente
						</td>
					</tr>
					<tr>
						<td>
							Q. F. B. Fabiola Espinosa Bribiesca ________________________________
						</td>
					</tr>
				</table>
				
				
	</table>
    <!-- Fin del cuerpo de la hoja -->

	<page_footer> <!-- Define el footer de la hoja -->
		<table id="footer">
            <tr class="fila">
				<td>
					<span>Pénjamo, Gto. <?php echo $fechaAct; ?></span>
				</td>
			</tr>
        </table>
    </page_footer>

</page>



<?php
	}
?>