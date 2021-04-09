<?php
	session_start();
	if (isset($_SESSION['user_id'])) {
		header('location:chat.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/png" href="img/fav.png">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Iniciar Sesión | UPTAV</title>
	</head>
	<body id="bindex">
		<div id="allindex">
			<div id="box">
				<div id="col1">
					<img src="img/uptpc.png">
				</div>
				<div id="col2">
					<i id="log" class="fas fa-lg fa-users"></i>
					<form id="logForm">
						<input type="text" id="Name" class="imp" name="Name" placeholder="Nombre" required>
						<input type="number" id="Pass" class="imp" name="Pass" placeholder="Cedula" required>
						<input type="submit" id="Login" name="Login" value="Iniciar sesion">
					</form>
				</div>
			</div>
		</div>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
		<script src="jquery-3.4.1.js"></script>
		<script src="script.js"></script>
	</body>
</html>