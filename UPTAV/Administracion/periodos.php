<?php 
session_start(); 
$key= mysqli_connect("localhost", "id16512843_root", "lqdd8Dn?j)GnRp]c", "id16512843_uptav");
if ($key === false) {
	echo mysqli_connect_error();
} else {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body id="badm">
		<div id=tablecontainer>
			<div id="tray" class="pertable">
				<h2>Trayectos <input type="submit" value="Agregar"></h2>
				<?php
				$sql= "SELECT * FROM trayecto";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "<table id='trayecto'>";
						$html .= "<tr>";
						$html .= "<th hidden>Id</th>";
						$html .= "<th class='celda'>Numero</th>";
						$html .= "<th class='botones'></th>";
						$html .= "</tr>";
						while($i = mysqli_fetch_array($data)){
							$html .= "<tr>";
							$html .= "<td class='id' hidden>${i['Id']}</td>";
							$html .= "<td class='numero'>${i['Numero']}</td>";
							$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
							$html .= "</tr>";
						}
						$html .= "</table>";
						echo $html;
						mysqli_free_result($data);
					} else {
						echo "No asignaturas encontradas";
					}
				} else {
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				?>
			</div>
			<div id="trim" class="pertable">
				<h2>Trimestres <input type="submit" value="Agregar"></h2>
				<?php
				$sql= "SELECT * FROM trimestre";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "<table id='trimestre'>";
						$html .= "<tr>";
						$html .= "<th hidden>Id</th>";
						$html .= "<th class='celda'>Numero</th>";
						$html .= "<th class='botones'></th>";
						$html .= "</tr>";
						while($i = mysqli_fetch_array($data)){
							$html .= "<tr>";
							$html .= "<td class='id' hidden>${i['Id']}</td>";
							$html .= "<td class='numero'>${i['Numero']}</td>";
							$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
							$html .= "</tr>";
						}
						$html .= "</table>";
						echo $html;
						mysqli_free_result($data);
					} else {
						echo "No asignaturas encontradas";
					}
				} else {
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				?>
			</div>
			<div id="secc" class="pertable">
				<h2>Secciones <input type="submit" value="Agregar"></h2>
				<?php
				$sql= "SELECT * FROM seccion";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "<table id='seccion'>";
						$html .= "<tr>";
						$html .= "<th hidden>Id</th>";
						$html .= "<th class='celda'>Nombre</th>";
						$html .= "<th class='botones'></th>";
						$html .= "</tr>";
						while($i = mysqli_fetch_array($data)){
							$html .= "<tr>";
							$html .= "<td class='id' hidden>${i['Id']}</td>";
							$html .= "<td class='numero'>${i['Nombre']}</td>";
							$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
							$html .= "</tr>";
						}
						$html .= "</table>";
						echo $html;
						mysqli_free_result($data);
					} else {
						echo "No asignaturas encontradas";
					}
				} else {
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				?>
			</div>
			<div id="coho" class="pertable">
				<h2>Cohorte <input type="submit" value="Agregar"></h2>
				<?php
				$sql= "SELECT * FROM cohorte";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "<table id='cohorte'>";
						$html .= "<tr>";
						$html .= "<th hidden>Id</th>";
						$html .= "<th class='celda'>Fecha</th>";
						$html .= "<th class='botones'></th>";
						$html .= "</tr>";
						while($i = mysqli_fetch_array($data)){
							$html .= "<tr>";
							$html .= "<td class='id' hidden>${i['Id']}</td>";
							$html .= "<td class='numero'>${i['Fecha']}</td>";
							$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
							$html .= "</tr>";
						}
						$html .= "</table>";
						echo $html;
						mysqli_free_result($data);
					} else {
						echo "No asignaturas encontradas";
					}
				} else {
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				?>
			</div>
			<div id="aula" class="pertable">
				<h2>Aulas <input type="submit" value="Agregar"></h2>
				<?php
				$sql= "SELECT * FROM aula";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "<table id='aula'>";
						$html .= "<tr>";
						$html .= "<th hidden>Id</th>";
						$html .= "<th class='celda'>Nombre</th>";
						$html .= "<th class='botones'></th>";
						$html .= "</tr>";
						while($i = mysqli_fetch_array($data)){
							$html .= "<tr>";
							$html .= "<td class='id' hidden>${i['Id']}</td>";
							$html .= "<td class='numero'>${i['Nombre']}</td>";
							$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
							$html .= "</tr>";
						}
						$html .= "</table>";
						echo $html;
						mysqli_free_result($data);
					} else {
						echo "No asignaturas encontradas";
					}
				} else {
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				?>
			</div>
		</div>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
		<script src="../jquery-3.4.1.js"></script>
		<script src="admin-script.js"></script>
	</body>
</html>
<?php
}