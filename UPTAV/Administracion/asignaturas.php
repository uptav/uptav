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
	<body id="badm" class="asgn">
		<div id="col1">
			<h2 id="asgn">Asignaturas <input type="submit" value="Agregar"></h2>
			<?php
			$sql= "SELECT * FROM asignatura";
			if ($data= mysqli_query($key, $sql)) {
				if (mysqli_num_rows($data)>0) {
					$html = "<table>";
					$html .= "<tr>";
					$html .= "<th>Id</th>";
					$html .= "<th>Nombre</th>";
					$html .= "<th class='botones'></th>";
					$html .= "</tr>";
					while($i = mysqli_fetch_array($data)){
						if ($i['Id'] != 1) {
							$html .= "<tr>";
							$html .= "<td class='id'>${i['Id']}</td>";
							$html .= "<td class='nombre'>${i['Nombre']}</td>";
							$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
							$html .= "</tr>";
						}
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
		<div id="col2">
			<h2>Cursos</h2>
			<?php
			$sql= "SELECT p_e.*, p.Nombre, p.Apellido, c.Fecha, s.Nombre, asg.Nombre, au.Nombre
				FROM profesor_estudiante p_e
				LEFT JOIN profesor p ON p_e.Id_Profesor = p.Id
				LEFT JOIN cohorte c ON p_e.Id_Cohorte = c.Id
				LEFT JOIN seccion s ON p_e.Id_Seccion = s.Id
				LEFT JOIN asignatura asg ON p_e.Id_Asignatura = asg.Id
				LEFT JOIN aula au ON p_e.Id_Aula = au.Id
				WHERE p_e.Estatus = 'Activo'
				ORDER BY p_e.Id_Seccion";
			if ($data= mysqli_query($key, $sql)) {
				if (mysqli_num_rows($data)>0) {
					$html = "<table>";
					$html .= "<tr>";
					$html .= "<th>Id</th>";
					$html .= "<th>Profesor</th>";
					$html .= "<th>Asignatura</th>";
					$html .= "<th>Seccion</th>";
					$html .= "<th>Cohorte</th>";
					$html .= "<th>Aula</th>";
					$html .= "<th class='botones'></th>";
					$html .= "</tr>";
					while($i = mysqli_fetch_array($data)){
						$html .= "<tr>";
						$html .= "<td><span class='id'>${i['Id']}</span></td>";
						$html .= "<td><span class='idprofesor' hidden>${i['Id_Profesor']}</span><span>${i[7]} ${i[8]}</span></td>";
						$html .= "<td><span class='idasignatura' hidden>${i['Id_Asignatura']}</span><span>${i[11]}</span></td>";
						$html .= "<td><span class='idseccion' hidden>${i['Id_Seccion']}</span><span>${i[10]}</span></td>";
						$html .= "<td><span class='idcohorte' hidden>${i['Id_Cohorte']}</span><span>${i[9]}</span></td>";
						$html .= "<td><span class='idaula' hidden>${i['Id_Aula']}</span><span>${i[12]}</span></td>";
						$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
						$html .= "</tr>";
					}
					$html .= "</table>";
					echo $html;
					mysqli_free_result($data);
				} else {
					echo "No cursos encontradas";
				}
			} else {
				echo "Error de ejecución";
				echo mysqli_error($key);
			}
			?>
			<h2 id="addcurso">Agregar</h2>
			<form id="frmcurso" class="addfrm">
				<fieldset>
					<label>
						<span>Profesor</span>
						<select id="profesor">
							<?php
							$sql= "SELECT * FROM profesor
								WHERE Estatus = 'Activo'";
							if ($data= mysqli_query($key, $sql)) {
								$html = "";
								while($i = mysqli_fetch_array($data)){
									$html .= "<option value='${i['Id']}'>${i['Nombre']} ${i['Apellido']}</option>";
								}
								echo $html;
								mysqli_free_result($data);
							} else {
								echo "Error de ejecución";
								echo mysqli_error($key);
							}
							?>
						</select>
					</label>
					<label>
						<span>Asignatura</span>
						<select id="asignatura">
							<?php
							$sql= "SELECT * FROM asignatura";
							if ($data= mysqli_query($key, $sql)) {
								$html = "";
								while($i = mysqli_fetch_array($data)){
									if ($i['Id'] != 1)
										$html .= "<option value='${i['Id']}'>${i['Nombre']}</option>";
								}
								echo $html;
								mysqli_free_result($data);
							} else {
								echo "Error de ejecución";
								echo mysqli_error($key);
							}
							?>
						</select>
					</label>
					<label>
						<span>Cohorte</span>
						<select id="cohorte">
							<?php
							$sql= "SELECT * FROM cohorte";
							if ($data= mysqli_query($key, $sql)) {
								$html = "";
								while($i = mysqli_fetch_array($data)){
									$html .= "<option value='${i['Id']}'>${i['Fecha']}</option>";
								}
								echo $html;
								mysqli_free_result($data);
							} else {
								echo "Error de ejecución";
								echo mysqli_error($key);
							}
							?>
						</select>
					</label>
					<label>
						<span>Sección</span>
						<select id="seccion">
							<?php
							$sql= "SELECT * FROM seccion";
							if ($data= mysqli_query($key, $sql)) {
								$html = "";
								while($i = mysqli_fetch_array($data)){
									$html .= "<option value='${i['Id']}'>${i['Nombre']}</option>";
								}
								echo $html;
								mysqli_free_result($data);
							} else {
								echo "Error de ejecución";
								echo mysqli_error($key);
							}
							?>
						</select>
					</label>
					<label>
						<span>Aula</span>
						<select id="aula">
							<?php
							$sql= "SELECT * FROM aula";
							if ($data= mysqli_query($key, $sql)) {
								$html = "";
								while($i = mysqli_fetch_array($data)){
									$html .= "<option value='${i['Id']}'>${i['Nombre']}</option>";
								}
								echo $html;
								mysqli_free_result($data);
							} else {
								echo "Error de ejecución";
								echo mysqli_error($key);
							}
							?>
						</select>
					</label>
				</fieldset>
				<input type="submit" value="Registrar curso">
			</form>
		</div>
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css">
		<script src="../jquery-3.4.1.js"></script>
		<script src="admin-script.js"></script>
	</body>
</html>
<?php
}