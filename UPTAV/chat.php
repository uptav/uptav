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
		<title>Chat | UPTAV</title>
	</head>
	<body id="bchat">
		<?php
		if (isset($_SESSION)) {
			if ($_SESSION['user_cargo'] != 4) {
				?>
				<div id="allchat">
					<header id="hchat">
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
						<?php
						if ($_SESSION['user_cargo'] != 3) {
							?>
							<div id="viewtask" class="hidden">
								<span></span>
								<div id="taskbox" class="hidden">
									<p id="tbtop">
										<span id="tbid" hidden="true">id</span>
										<span id="tbdate">0000-00-00 00:00:00</span>
										<span id="tbteach">Profesor</span>
									</p>
									<h3 id="tbtitl">Titulo</h3>
									<div id="tbasgn" class="hidden">
										<p id="tblimi">0000-00-00 00:00:00</p>
										<button id="tbrply">Respuestas
											<div id="tbrplylist">
												<ul>
													<li>Cargando...</li>
												</ul>
											</div>
										</button>
									</div>
									<p id="tbdesc">Descripción</p>
									<div id="tbbtns" class="hidden">
										<button class="tblink"><a href="#" download>Descargar archivo</a></button>
									</div>
								</div>
								<div id="sbmtbox" class="hidden">
									<form id="sbmtform">
										<label id="sbmttitle"><b>Título del contenido</b>
										<input type="text" placeholder="Título" required></label>
										<label id="sbmtasgn"><input type="checkbox">¿Es una asignación?</label>
										<label id="sbmtdate" class="hidden"><b>Fecha límite de entrega</b>
										<input type="datetime-local"></label>
										<label id="sbmtdesc"><b>Descripción del cotenido</b>
										<textarea placeholder="Descripción" rows="5" required></textarea></label>
										<label id="sbmtfile"><span>Subir archivo</span><input type="file" name="Archivos[]" multiple="multiple"></label>
										<input type="submit" id="sbmt" value="Enviar">
									</form>
								</div>
								<div id="planbox" class="hidden">
									<p id="pbtop">
										<span id="pbid" hidden="true">id</span>
										<span id="pbasgn">Asignatura</span>
										<span id="pbteach">Profesor</span>
									</p>
									<h3 id="pbtitl">Titulo</h3>
									<p id="pbdesc">Descripción</p>
								</div>
							</div>
							<div id="lbar">
								<div id="rooms">
									<h3>Salas de chat</h3>
									<div id="listcontainer">
										<ul id="roomlist">
											<li>...</li>
										</ul>
									</div>
								</div>
								<div id="members" class="hidden">
									<i class="fas fa-arrow-left"></i>
									<h3>Seccion</h3>
									<div id="listcontainer">
										<ul id="memberslist">
											<li>...</li>
										</ul>
									</div>
								</div>
							</div>
							<div id="messages">
								<h3>En espera...</h3> 
							</div>
							<div id="rbar">
								<h3>Contenido:</h3>
								...
							</div>
							<?php
						} else {
							?>
							<div id="viewtask" class="hidden">
								<span></span>
								<div id="taskbox" class="hidden">
									<p id="tbtop">
										<span id="tbid" hidden="true">id</span>
										<span id="tbdate">0000-00-00 00:00:00</span>
										<span id="tbteach">Profesor</span>
									</p>
									<h3 id="tbtitl">Titulo</h3>
									<div id="tbasgn" class="hidden">
										<p id="tblimi">0000-00-00 00:00:00</p>
										<button id="tbrply">Responder</button>
									</div>
									<p id="tbdesc">Descripción</p>
									<div id="tbbtns" class="hidden">
										<button class="tblink"><a href="#" download>Descargar archivo</a></button>
									</div>
								</div>
								<div id="rplybox" class="hidden">
									<form id="rplyform">
										<span id="rplyid" hidden="true">id</span>
										<h4 id="rplyname">Respondiendo a: asignacion</h4>
										<label id="rplycomm"><b>¿Algún comentario adicional?</b>
										<textarea placeholder="Comentarios" rows="5" required></textarea></label>
										<label id="rplyfile"><span>Subir archivo</span><input type="file" name="Archivos[]" multiple="multiple"></label>
										<input type="submit" id="rply" value="Enviar">
									</form>
								</div>
								<div id="planbox" class="hidden">
									<p id="pbtop">
										<span id="pbid" hidden="true">id</span>
										<span id="pbasgn">Asignatura</span>
										<span id="pbteach">Profesor</span>
									</p>
									<h3 id="pbtitl">Titulo</h3>
									<p id="pbdesc">Descripción</p>
								</div>
							</div>
							<div id="lbar">
								<h3 id="seccion"><?php echo "${_SESSION['person_seccion']} (${_SESSION['person_cohorte']})"; ?></h3>
								<div hidden="true"><?php echo "<span id='secc'>${_SESSION['person_idseccion']}</span> <span id='coho'>${_SESSION['person_idcohorte']}</span>"; ?><span id='asig'>1</span></div>
								<h4>Asignaturas:</h4>
								<select id="asgralist">
									<option value="1">General</option>
								</select>
								<div id="listcontainer">
									<ul id="memberlist">
										<li>...</li>
									</ul>
								</div>
							</div>
							<div id="messages">
								<div id="show">
									<img id="loading" src="img/loading.gif">
								</div>
								<form id="upload" autocomplete="off" required>
									<textarea id="upimp" placeholder="Contribuye sanamente"></textarea>
									<button type="submit" id="upbtn"><i class="fas fa-lg fa-comment"></i></button>
								</form>
							</div>
							<div id="rbar">
								<button id='showplan'>Planificación</button>
								<button id='swthcont' class='selected'>Contenido</button>
								<button id='swthasig'>Asignaciones</button>
								<div id="listcontainer">
									<ul id="taskslist" class='hidden'>
										<li>...</li>
									</ul>
									<ul id="contlist">
										<li>...</li>
									</ul>
								</div>
							</div>
							<?php
						}
						?>
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
				<h1><a href="dashboard.php">Nada que ver por aquí...</a></h1>
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