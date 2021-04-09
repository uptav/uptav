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
	<body id="badm"  class="user">
		<div id="col1">
			<h2 id="adm">Administradores</h2>
			<?php
			$sql= "SELECT * FROM administrador
				WHERE Estatus = 'Activo'";
			if ($data= mysqli_query($key, $sql)) {
				if (mysqli_num_rows($data)>0) {
					$html = "<table>";
					$html .= "<tr>";
					$html .= "<th>Id</th>";
					$html .= "<th>Nombre</th>";
					$html .= "<th>Apellido</th>";
					$html .= "<th>Cedula</th>";
					$html .= "<th hidden>Id_Usuario</th>";
					$html .= "<th hidden>Form</th>";
					$html .= "<th class='botones'></th>";
					$html .= "</tr>";
					while($i = mysqli_fetch_array($data)){
						$html .= "<tr>";
						$html .= "<td class='id'>${i['Id']}</td>";
						$html .= "<td class='nombre'>${i['Nombre']}</td>";
						$html .= "<td class='apellido'>${i['Apellido']}</td>";
						$html .= "<td class='cedula'>${i['Cedula']}</td>";
						$html .= "<td class='idusuario' hidden>${i['Id_Usuario']}</td>";
						$html .= "<td class='idform' hidden>frmadmi</td>";
						$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
						$html .= "</tr>";
					}
					$html .= "</table>";
					echo $html;
					mysqli_free_result($data);
				} else {
					echo "No estudiantes encontrados";
				}
			} else {
				echo "Error de ejecución";
				echo mysqli_error($key);
			}
			?>
			<h2 id="prf">Profesores</h2>
			<?php
			$sql= "SELECT * FROM profesor
				WHERE Estatus = 'Activo'";
			if ($data= mysqli_query($key, $sql)) {
				if (mysqli_num_rows($data)>0) {
					$html = "<table>";
					$html .= "<tr>";
					$html .= "<th>Id</th>";
					$html .= "<th>Codigo</th>";
					$html .= "<th>Nombre</th>";
					$html .= "<th>Apellido</th>";
					$html .= "<th>Cedula</th>";
					$html .= "<th hidden>Id_Usuario</th>";
					$html .= "<th hidden>Form</th>";
					$html .= "<th class='botones'></th>";
					$html .= "</tr>";
					while($i = mysqli_fetch_array($data)){
						$html .= "<tr>";
						$html .= "<td class='id'>${i['Id']}</td>";
						$html .= "<td class='codigo'>${i['Codigo']}</td>";
						$html .= "<td class='nombre'>${i['Nombre']}</td>";
						$html .= "<td class='apellido'>${i['Apellido']}</td>";
						$html .= "<td class='cedula'>${i['Cedula']}</td>";
						$html .= "<td class='idusuario' hidden>${i['Id_Usuario']}</td>";
						$html .= "<td class='idform' hidden>frmprof</td>";
						$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
						$html .= "</tr>";
					}
					$html .= "</table>";
					echo $html;
					mysqli_free_result($data);
				} else {
					echo "No estudiantes encontrados";
				}
			} else {
				echo "Error de ejecución";
				echo mysqli_error($key);
			}
			?>
			<h2 id="stu">Estudiantes</h2>
			<?php
			$sql= "SELECT estudiante.*, GROUP_CONCAT(trayecto.Numero), GROUP_CONCAT(trimestre.Numero), GROUP_CONCAT(cohorte.Fecha), GROUP_CONCAT(seccion.Nombre), GROUP_CONCAT(aula.Nombre) 
				FROM estudiante
				LEFT JOIN trayecto ON estudiante.Id_Trayecto = trayecto.Id
				LEFT JOIN trimestre ON estudiante.Id_Trimestre = trimestre.Id
				LEFT JOIN cohorte ON estudiante.Id_Cohorte = cohorte.Id
				LEFT JOIN seccion ON estudiante.Id_Seccion = seccion.Id
				LEFT JOIN aula ON estudiante.Id_Aula = aula.Id
				WHERE estudiante.Estatus = 'Activo'
				GROUP BY estudiante.Id";
			if ($data= mysqli_query($key, $sql)) {
				if (mysqli_num_rows($data)>0) {
					$html = "<table>";
					$html .= "<tr>";
					$html .= "<th>Id</th>";
					$html .= "<th>Cod</th>";
					$html .= "<th>Nombre</th>";
					$html .= "<th>Apellido</th>";
					$html .= "<th>Cedula</th>";
					$html .= "<th>Tra</th>";
					$html .= "<th>Tri</th>";
					$html .= "<th>Cohorte</th>";
					$html .= "<th>Sección</th>";
					$html .= "<th>Aula</th>";
					$html .= "<th hidden>Id_Usuario</th>";
					$html .= "<th hidden>Form</th>";
					$html .= "<th class='botones'></th>";
					$html .= "</tr>";
					while($i = mysqli_fetch_array($data)){
						$html .= "<tr>";
						$html .= "<td class='id'>${i['Id']}</td>";
						$html .= "<td class='codigo'>${i['Codigo']}</td>";
						$html .= "<td class='nombre'>${i['Nombre']}</td>";
						$html .= "<td class='apellido'>${i['Apellido']}</td>";
						$html .= "<td class='cedula'>${i['Cedula']}</td>";
						$html .= "<td><span class='idtrayecto' hidden>${i['Id_Trayecto']}</span><span class='trayecto'>${i[12]}</span></td>";
						$html .= "<td><span class='idtrimestre' hidden>${i['Id_Trimestre']}</span><span class='trimestre'>${i[13]}</span></td>";
						$html .= "<td><span class='idcohorte' hidden>${i['Id_Cohorte']}</span><span class='cohorte'>${i[14]}</span></td>";
						$html .= "<td><span class='idseccion' hidden>${i['Id_Seccion']}</span><span class='seccion'>${i[15]}</span></td>";
						$html .= "<td><span class='idaula' hidden>${i['Id_Aula']}</span><span class='aula'>${i[16]}</span></td>";
						$html .= "<td class='idusuario' hidden>${i['Id_Usuario']}</td>";
						$html .= "<td class='idform' hidden>frmestu</td>";
						$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
						$html .= "</tr>";
					}
					$html .= "</table>";
					echo $html;
					mysqli_free_result($data);
				} else {
					echo "No estudiantes encontrados";
				}
			} else {
				echo "Error de ejecución";
				echo mysqli_error($key);
			}
			?>
			<h2 id="voc">Voceros</h2>
			<?php
			$sql= "SELECT * FROM vocero
				WHERE Estatus = 'Activo'";
			if ($data= mysqli_query($key, $sql)) {
				if (mysqli_num_rows($data)>0) {
					$html = "<table>";
					$html .= "<tr>";
					$html .= "<th>Id</th>";
					$html .= "<th>Nombre</th>";
					$html .= "<th>Apellido</th>";
					$html .= "<th>Cedula</th>";
					$html .= "<th hidden>Id_Usuario</th>";
					$html .= "<th hidden>Form</th>";
					$html .= "<th class='botones'></th>";
					$html .= "</tr>";
					while($i = mysqli_fetch_array($data)){
						$html .= "<tr>";
						$html .= "<td class='id'>${i['Id']}</td>";
						$html .= "<td class='nombre'>${i['Nombre']}</td>";
						$html .= "<td class='apellido'>${i['Apellido']}</td>";
						$html .= "<td class='cedula'>${i['Cedula']}</td>";
						$html .= "<td class='idusuario' hidden>${i['Id_Usuario']}</td>";
						$html .= "<td class='idform' hidden>frmvoce</td>";
						$html .= "<td class='botones'><span class='editar fas fa-pencil-alt'></span><span class='eliminar fas fa-trash'></span></td>";
						$html .= "</tr>";
					}
					$html .= "</table>";
					echo $html;
					mysqli_free_result($data);
				} else {
					echo "No estudiantes encontrados";
				}
			} else {
				echo "Error de ejecución";
				echo mysqli_error($key);
			}
			?>
		</div>
		<div id="col2">
			<label id="switchcargo"><h2>Añadir nuevo</h2>
			<select>
				<option value="frmadmi">Administrador</option>
				<option value="frmprof">Profesor</option>
				<option value="frmestu">Estudiante</option>
				<option value="frmvoce">Vocero</option>
			</select></label>
			<form id="frmadmi" class="addfrm">
				<fieldset>
					<label><span>Nombre</span><input type="text" class="nombre" placeholder="Nombre" required></label>
					<label><span>Apellido</span><input type="text" class="apellido" placeholder="Apellido" required></label>
					<label><span>Cedula</span><input type="number" class="cedula" placeholder="Cedula" required></label>
				</fieldset>
				<input type="submit" value="Registrar administrador">
			</form>
			<form id="frmprof" class="addfrm" hidden>
				<fieldset>
					<label><span>Codigo</span><input type="number" class="codigo" placeholder="Codigo" required></label>
					<label><span>Nombre</span><input type="text" class="nombre" placeholder="Nombre" required></label>
					<label><span>Apellido</span><input type="text" class="apellido" placeholder="Apellido" required></label>
					<label><span>Cedula</span><input type="number" class="cedula" placeholder="Cedula" required></label>
				</fieldset>
				<input type="submit" value="Registrar profesor">
			</form>
			<form id="frmestu" class="addfrm" hidden>
				<fieldset>
					<label><span>Codigo</span><input type="number" class="codigo" placeholder="Codigo" required></label>
					<label><span>Nombre</span><input type="text" class="nombre" placeholder="Nombre" required></label>
					<label><span>Apellido</span><input type="text" class="apellido" placeholder="Apellido" required></label>
					<label><span>Cedula</span><input type="number" class="cedula" placeholder="Cedula" required></label>
				</fieldset>
				<fieldset>
					<label>
						<span>Trayecto</span>
						<select id="trayecto">
							<option value="1">Trayecto 1</option>
							<option value="2">Trayecto 2</option>
							<option value="3">Trayecto 3</option>
							<option value="4">Trayecto 4</option>
						</select>
					</label>
					<label>
						<span>Trimestre</span>
						<select id="trimestre">
							<option value="1">Trimestre 1</option>
							<option value="2">Trimestre 2</option>
							<option value="3">Trimestre 3</option>
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
				<input type="submit" value="Registrar estudiante">
			</form>
			<form id="frmvoce" class="addfrm" hidden>
				<fieldset>
					<label><span>Nombre</span><input type="text" class="nombre" placeholder="Nombre" required></label>
					<label><span>Apellido</span><input type="text" class="apellido" placeholder="Apellido" required></label>
					<label><span>Cedula</span><input type="number" class="cedula" placeholder="Cedula" required></label>
				</fieldset>
				<input type="submit" value="Registrar vocero">
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