<?php
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/png" href="img/fav.png">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="fstyles.css">
		<title>Administracion | UPTAV</title>
	</head>
	<body id="bdashb">
		<?php
		if (isset($_SESSION)) {
			if ($_SESSION['user_cargo'] == 1) {
				?>
				<div id="alldashb">
					<header id="hdashb">
						<a href="index.php"><img id="hlogo" src="img/uptav.png"></a>
						<div id="hbutton">
							<div id="bell" class="fas fa-lg fa-bell">
								<div id="blbox">
									<div id="blnot">
										<p>No hay notificaciones</p>
									</div>
									<input type="button" id="blbutton" value="Ver todo">
								</div>
							</div>
							<div id="profile" class="fas fa-lg fa-user">
								<div id="pfbox">
									<div id="pfdata">
										<img src="<?php echo $_SESSION['user_photo']; ?>"><p><?php echo $_SESSION['person_nombre']." ".$_SESSION['person_apellido']; ?></p>
									</div>
									<input type="button" id="pfview" value="Perfil">
									<input type="button" id="pfexit" value="Salir">
									<?php if ($_SESSION['user_cargo'] == 1) 
										echo "<a id='pfadmi' href='adminboard.php'>Administracion</a>";
									?>
								</div>
							</div>
						</div>
					</header>
					<div id="full">
						<div id="lbar">
							<h3>Gestion del aula</h3>
							<ul>
								<a href="Administracion/usuarios.php" target="frame"><li>Usuarios</li></a>
								<a href="Administracion/asignaturas.php" target="frame"><li>Asignaturas</li></a>
								<a href="Administracion/periodos.php" target="frame"><li>Periodos</li></a>
								<a href="noticias_admin.php" target="frame"><li>Noticias</li></a>
							</ul>
						</div>
						<iframe id="main" src="" name="frame"></iframe>
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
                        
                        
						
    </footer>
				</div>
				<?php
			} else {
				?>
				<h1 id='back'>Nada que ver aqui</h1>
				<?php
			}
		} else {
			?>
			<h1 id='back'>Sesión no iniciada</h1>
			<?php
		}	
		?>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
		<script src="jquery-3.4.1.js"></script>
		<script src="script.js"></script>
	</body>
</html>