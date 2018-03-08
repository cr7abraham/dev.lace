<?php

	session_start();
	date_default_timezone_set('America/Mexico_City');
	if(empty($_SESSION['valueuser'])){

	include("includes/error_nologin.php");
	
		 }
    if ($_SESSION['me'] != "menu" && !isset($_GET['V']) ){
    include("includes/error_nologin.php");
    }
   
		 foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

     $linkpaciente    = "menu_pacientes.php?V=".urlencode(base64_encode('variable'));
     $linkmedico      = "menu_medicos.php?V=".urlencode(base64_encode('variable'));
     $linkusuarios    = "menu_usuarios.php?V=".urlencode(base64_encode('variable'));
     $linkproveedores = "menu_proveedores.php?V=".urlencode(base64_encode('variable'));
     $linkproductos = "menu_productos.php?V=".urlencode(base64_encode('variable')); 
	 $linkreporte = "menu_reporte.php?V=".urlencode(base64_encode('variable'));
	 $linkmenu = "menu.php?V=".urlencode(base64_encode('variable'));

		  ?>
<!DOCTYPE html>
<html lang="es" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<title>Menú Principal</title>
		<link rel="shortcut icon" href="img/icon.png">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/menu.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<!-- Codrops top bar -->
			<div class="codrops-top clearfix">

				<span class="right">
					<ul id="menu">
						 <li id="hov">
							 <span class="right">
							 <h5 style="margin-top: 2.1em; font-size: 12px;">Bienvenido, <?php echo $_SESSION['valueuser'] ?></h5>
							 </span>
	 							<img src="img/conf.png" width="20%" >
             <ul>
               <li id="ex"><a href="index.php" >Cerrar Sesion</a></li>
             </ul>
               </li>
         </ul>
				</span>

			</div>
			<header>
				<span><a href="<?php echo $linkmenu; ?>"><img src="img/logo2.png" class="imag" title="Laboratorio de analisis clinicos Espinoza"></a></span>
			</header>
			<div class="main clearfix">
				<nav id="menu" class="nav">
					<ul>
						<li>
							<a href="<?php echo $linkpaciente;?>" >
								<span class="icon">
									<i aria-hidden="true" class="icon-services" width="25%"></i>
								</span>
								<span>Pacientes</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $linkmedico;?>" >
								<span class="icon">
									<i aria-hidden="true" class="icon-team"></i>
								</span>
								<span>Médicos</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $linkusuarios;?>">
								<span class="icon">
									<i aria-hidden="true" class="icon-blog"></i>
								</span>
								<span>Usuarios</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $linkproveedores;?>">
								<span class="icon">
									<i aria-hidden="true" class="icon-menu"></i>
								</span>
								<span>Proveedores</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $linkproductos;?>">
								<span class="icon">
									<i aria-hidden="true" class="icon-portfolio"></i>
								</span>
								<span>Inventario</span>
							</a>
						</li>
						<li>
							<a href="<?php echo $linkreporte; ?>">
								<span class="icon">
									<i aria-hidden="true" class="icon-contact"></i>
								</span>
								<span>Reporte</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div><!-- /container -->
		<script>
			//  The function to change the class
			var changeClass = function (r,className1,className2) {
				var regex = new RegExp("(?:^|\\s+)" + className1 + "(?:\\s+|$)");
				if( regex.test(r.className) ) {
					r.className = r.className.replace(regex,' '+className2+' ');
			    }
			    else{
					r.className = r.className.replace(new RegExp("(?:^|\\s+)" + className2 + "(?:\\s+|$)"),' '+className1+' ');
			    }
			    return r.className;
			};

			//  Creating our button in JS for smaller screens
		//	var menuElements = document.getElementById('menu');
		//	menuElements.insertAdjacentHTML('afterBegin','<button type="button" id="menutoggle" class="navtoogle" aria-hidden="true"><i aria-hidden="true" class="icon-menu"> </i> Menu</button>');

			//  Toggle the class on click to show / hide the menu
			document.getElementById('menutoggle').onclick = function() {
				changeClass(this, 'navtoogle active', 'navtoogle');
			}

			// http://tympanus.net/codrops/2013/05/08/responsive-retina-ready-menu/comment-page-2/#comment-438918
			document.onclick = function(e) {
				var mobileButton = document.getElementById('menutoggle'),
					buttonStyle =  mobileButton.currentStyle ? mobileButton.currentStyle.display : getComputedStyle(mobileButton, null).display;

				if(buttonStyle === 'block' && e.target !== mobileButton && new RegExp(' ' + 'active' + ' ').test(' ' + mobileButton.className + ' ')) {
					changeClass(mobileButton, 'navtoogle active', 'navtoogle');
				}
			}
		</script>
	</body>
</html>
