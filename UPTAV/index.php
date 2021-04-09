<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/png" href="img/fav.png">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"
		>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Escritorio | UPTAV</title>
	</head>
	<body id="bdashb">
		<input type="checkbox" id="cerrar">
		<label for="cerrar" class="a"></label>
		<div class="modal">
			<div class="contenido">
				<img src="img/popup.jpg">
			</div>
		</div>
		<?php
		session_start();
		if (isset($_SESSION)) {
			?>
			<div id="alldashb">
				<header id="hdashb">
					<a href="index.php"><img id="hlogo" src="img/uptav.png"></a>
				</header>
				<div id="full">
					<div id="lbar">
						<div id="llogo">
							<!-- <img src="img/uptpcsl.png"> -->
							<button id="enter"><a href="noticias.php" target="frame">Noticias</a></button>
						</div>
						<ul>
							<a href="modulos_sc/inicio.php" target="frame"><li>Inicio</li></a>
							<a href="modulos_sc/pnf.php" target="frame"><li>PNF</li></a>
							<a href="modulos_sc/academico.php" target="frame"><li>Académico</li></a>
							<a href="login.php"><li>Entorno Virtual</li></a>
						</ul>
					</div>
					<iframe id="main" src="noticias.php" name="frame"></iframe>
				</div>
	<footer>
       
                    	<br>
       <div class="container-footer-all">
        
            <div class="container-body">    

					<div class="column1">
						
                    <div class="row">
                        <label>Direccion zona industrial Santa Rosa, urbanizacion La Elvira. Puerto Cabello - Municipio Goaigoaza. Telefono: +58-414-3412031. Direccion de correo electronico glendysodalys@hotmail.com</label>
                    </div>
					</div>
            </div>
        
        </div>        
        				<a href="https://www.instagram.com/" target="_blank"><img src="icon/instagram.png"></a>
        				
        				<a href="https://twitter.com/?lang=es" target="_blank"><img src="icon/twitter.png"></a>

        				<p class="pp"><b>Equipo de desarrollo: Jonatan Monsalve, Jose Álvarez y Kennerth Salazar</b></p>
                        
                        
						
    </footer>
			</div>
			<?php
		} else {
			?>
			<h1 id='back'>Sesión no iniciada</h1>
			<?php
		}	
		?>
		
		<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
		<script src="jquery-3.4.1.js"></script>
		<script src="script.js"></script>
	</body>
</html>