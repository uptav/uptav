<?php

if ($_POST) {
	switch ($_POST['Action']) {
		case 'Login':
			$name= $_POST['Name'];
			$pass= $_POST['Pass'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT * FROM usuario
					WHERE Nombre = '$name'
					AND Cedula = '$pass'
					AND Estatus = 'Activo'";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						session_start();
						foreach($data as $i) {
							$_SESSION['user_id'] = $i['Id'];
							$_SESSION['user_nombre'] = $i['Nombre'];
							$_SESSION['user_cargo'] = $i['Id_Cargo'];
							$_SESSION['user_photo'] = $i['Photo'];
						}
						switch ($_SESSION['user_cargo']) {
							case 1:
								$sql2= "SELECT * FROM administrador
									WHERE Id_Usuario = '${_SESSION["user_id"]}'
									AND Estatus = 'Activo'";
								if ($data2= mysqli_query($key, $sql2)) {
									if (mysqli_num_rows($data2)>0) {
										foreach($data2 as $i) {
											$_SESSION['person_id'] = $i['Id'];
											$_SESSION['person_nombre'] = $i['Nombre'];
											$_SESSION['person_apellido'] = $i['Apellido'];
											$_SESSION['person_ci'] = $i['Cedula'];
										}
										echo "go";
										mysqli_free_result($data2);
									} else {
										echo "El usuario solicitado no posee dueño";
									}
								} else {
									echo "Error de ejecución";
									echo mysqli_error($key);
								}
								break;
							case 2:
								$sql2= "SELECT * FROM profesor
									WHERE Id_Usuario = '${_SESSION["user_id"]}'
									AND Estatus = 'Activo'";
								if ($data2= mysqli_query($key, $sql2)) {
									if (mysqli_num_rows($data2)>0) {
										foreach($data2 as $i) {
											$_SESSION['person_id'] = $i['Id'];
											$_SESSION['person_codigo'] = $i['Codigo'];
											$_SESSION['person_nombre'] = $i['Nombre'];
											$_SESSION['person_apellido'] = $i['Apellido'];
											$_SESSION['person_ci'] = $i['Cedula'];
										}
										echo "go";
										mysqli_free_result($data2);
									} else {
										echo "El usuario solicitado no posee dueño";
									}
								} else {
									echo "Error de ejecución";
									echo mysqli_error($key);
								}
								break;
							case 3:
								$sql2= "SELECT estudiante.*, GROUP_CONCAT(trayecto.Numero), GROUP_CONCAT(trimestre.Numero), GROUP_CONCAT(cohorte.Fecha), GROUP_CONCAT(seccion.Nombre), GROUP_CONCAT(aula.Nombre) 
									FROM estudiante
									LEFT JOIN trayecto ON estudiante.Id_Trayecto = trayecto.Id
									LEFT JOIN trimestre ON estudiante.Id_Trimestre = trimestre.Id
									LEFT JOIN cohorte ON estudiante.Id_Cohorte = cohorte.Id
									LEFT JOIN seccion ON estudiante.Id_Seccion = seccion.Id
									LEFT JOIN aula ON estudiante.Id_Aula = aula.Id
									WHERE Id_Usuario = '${_SESSION["user_id"]}'
									AND Estatus = 'Activo'
									GROUP BY estudiante.Id";
								if ($data2= mysqli_query($key, $sql2)) {
									if (mysqli_num_rows($data2)>0) {
										while($i = mysqli_fetch_array($data2)){
											$_SESSION['person_id'] = $i['Id'];
											$_SESSION['person_codigo'] = $i['Codigo'];
											$_SESSION['person_nombre'] = $i['Nombre'];
											$_SESSION['person_apellido'] = $i['Apellido'];
											$_SESSION['person_ci'] = $i['Cedula'];
											$_SESSION['person_idtrayecto'] = $i['Id_Trayecto'];
											$_SESSION['person_trayecto'] = $i[12];
											$_SESSION['person_idtrimestre'] = $i['Id_Trimestre'];
											$_SESSION['person_trimestre'] = $i[13];
											$_SESSION['person_idcohorte'] = $i['Id_Cohorte'];
											$_SESSION['person_cohorte'] = $i[14];
											$_SESSION['person_idseccion'] = $i['Id_Seccion'];
											$_SESSION['person_seccion'] = $i[15];
											$_SESSION['person_idaula'] = $i['Id_Aula'];
											$_SESSION['person_aula'] = $i[16];
										}
										echo "go";
										mysqli_free_result($data2);
									} else {
										echo "El usuario solicitado no posee dueño";
									}
								} else {
									echo "Error de ejecución";
									echo mysqli_error($key);
								}
								break;
							case 4:
								$sql2= "SELECT * FROM vocero
									WHERE Id_Usuario = '${_SESSION["user_id"]}'
									AND Estatus = 'Activo'";
								if ($data2= mysqli_query($key, $sql2)) {
									if (mysqli_num_rows($data2)>0) {
										foreach($data2 as $i) {
											$_SESSION['person_id'] = $i['Id'];
											$_SESSION['person_nombre'] = $i['Nombre'];
											$_SESSION['person_apellido'] = $i['Apellido'];
											$_SESSION['person_ci'] = $i['Cedula'];
										}
										echo "go";
										mysqli_free_result($data2);
									} else {
										echo "El usuario solicitado no posee dueño";
									}
								} else {
									echo "Error de ejecución";
									echo mysqli_error($key);
								}
								break;
							default:
								echo "Usuario sin cargo";
								break;
						}
						mysqli_free_result($data);
					} else{
						echo "Usuario o clave invalida";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_posts':
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT noticia.*, GROUP_CONCAT(usuario.Nombre) FROM noticia
					LEFT JOIN usuario ON noticia.Id_Autor = usuario.Id
					WHERE noticia.Estatus = 'Activo'
					GROUP BY noticia.Id";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						session_start();
						$html= "";
						while($i = mysqli_fetch_array($data)){
							$html.= "<div class='pst'>
									<div class='psth'>
										<span>Escrito por ${i['5']}</span>
										<span>${i['Fecha']}</span>
									</div>
									<p>${i['Contenido']}</p>
									<div class='pstf'>
										<i>${i['Id']}</i>"
										.((isset($_SESSION['user_id']))?
											(($_SESSION['user_id'] == $i['Id_Autor'] || $_SESSION['user_cargo'] == 1)?
											"<span>
												<b class='edit fas fa-pencil-alt'></b>
												<b class='dele fas fa-trash'></b>
											</span>" : "") : "").
									"</div>
								</div>";
						}
						echo $html;
						mysqli_free_result($data);
					} else{
						echo "No hay publicaciones que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Upload_posts':
			$content= $_POST['Content'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				session_start();
				$sql= "INSERT INTO noticia (Contenido, Id_Autor) 
					VALUES ('$content', '${_SESSION["user_id"]}')";
				if (mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Edit_post':
			$id= $_POST['Id'];
			$content= $_POST['Content'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "UPDATE noticia 
					SET Contenido = '$content' 
					WHERE Id = '$id'";
				if (mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Delete_post':
			$id= $_POST['Id'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "DELETE FROM noticia 
					WHERE Id = '$id'";
				if (mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_members':
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT p.Id, p.Nombre, p.Apellido, p.Cedula, p.Id_Usuario, u.Photo
					FROM profesor_estudiante p_e
					LEFT JOIN profesor p ON p_e.Id_Profesor = p.Id
					LEFT JOIN usuario u ON p.Id_Usuario = u.Id
					WHERE p_e.Id_Seccion = '$secc'
					AND p_e.Id_Cohorte = '$coho'
					AND p_e.Estatus = 'Activo'
					GROUP BY p.Id";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						session_start();
						$html= "<h4>Profesores</h4>";
						while($i = mysqli_fetch_array($data)){
							if ($_SESSION['user_id'] != $i['Id_Usuario']) {
								$html.= "<li class='teacher'><img src='${i['Photo']}'><span>${i['Nombre']} ${i['Apellido']}</li>";
							}
						}
						$sql2= "SELECT e.Id, e.Nombre, e.Apellido, e.Cedula, e.Id_Usuario, u.Photo
							FROM estudiante e
							LEFT JOIN usuario u ON e.Id_Usuario = u.Id
							WHERE e.Id_Seccion = '$secc'
							AND e.Id_Cohorte = '$coho'
							AND e.Estatus = 'Activo'";
						if ($data2= mysqli_query($key, $sql2)) {
							if (mysqli_num_rows($data2)>0) {
								$html.= "<h4>Estudiantes</h4>";
								while($i = mysqli_fetch_array($data2)){
									if ($_SESSION['user_id'] != $i['Id_Usuario']) {
										$html.= "<li><img src='${i['Photo']}'><span>${i['Nombre']} ${i['Apellido']}</li>";
									}
								}
								mysqli_free_result($data2);
							} else{
								echo "No hay publicaciones que mostrar";
							}
						} else{
							echo "Error de ejecución";
							echo mysqli_error($key);
						}
						echo $html;
						mysqli_free_result($data);
					} else{
						echo "No hay publicaciones que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_asign':
			session_start();
			$seccion = $_SESSION['person_idseccion'];
			$cohorte = $_SESSION['person_idcohorte'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT p_e.Id_Asignatura, asignatura.Nombre
					FROM profesor_estudiante p_e
					LEFT JOIN asignatura ON p_e.Id_Asignatura = asignatura.Id
					WHERE p_e.Id_Seccion = '$seccion'
					AND p_e.Id_Cohorte = '$cohorte'
					AND p_e.Estatus = 'Activo'
					GROUP BY p_e.Id_Asignatura";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "<option value='1'>General</option>";
						while($i = mysqli_fetch_array($data)){
							$html .= "<option value='${i['Id_Asignatura']}'>${i['Nombre']}</option>";
						}
						echo $html;
						mysqli_free_result($data);
					} else{
						echo "No hay publicaciones que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_tasks':
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT contenido.*, GROUP_CONCAT(archivo_contenido.url), profesor.Nombre, profesor.Apellido, asignatura.Nombre 
					FROM contenido
					LEFT JOIN profesor ON contenido.Id_Profesor = profesor.Id
					LEFT JOIN asignatura ON contenido.Id_Asignatura = asignatura.Id
					LEFT JOIN archivo_contenido ON contenido.Id = archivo_contenido.Id_Contenido
					WHERE contenido.Id_Seccion = '$secc'
					AND contenido.Id_Cohorte = '$coho'
					AND contenido.Estatus = 'Activo'
					GROUP BY contenido.Id";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						session_start();
						$html= "";
						$html2= "";
						while($i = mysqli_fetch_array($data)){
							if ($_SESSION['user_cargo'] == 3 || ($_SESSION['user_cargo'] == 2 && $i['Id_Profesor'] == $_SESSION['person_id'])) {
								$files = explode(",", $i[11]);
								$spans = "";
								foreach ($files as $l)
									$spans .= "<span hidden='true' class='tsklink'>$l</span>";
								if($i['Asignacion'] > 0) {
									$html.= "<li asgra='${i['Id_Asignatura']}'>
											<span class='tskdate'>${i['Fecha_enviado']}</span><br>
											<span class='tskasgn'>${i[14]}</span><br>
											Por: <span class='tskname'>${i[12]} ${i[13]}</span>
											<span hidden='true' class='tskid'>${i['Id']}</span>
											<span hidden='true' class='tsktitl'>${i['Titulo']}</span>
											<span hidden='true' class='tskdesc'>${i['Descripcion']}</span>
											<span hidden='true' class='tsklimi'>${i['Fecha_limite']}</span>"
											.$spans.
										"</li>";
								} else {
									$html2.= "<li asgra='${i['Id_Asignatura']}'>
											<span class='tskdate'>${i['Fecha_enviado']}</span><br>
											<span class='tskasgn'>${i[14]}</span><br>
											Por: <span class='tskname'>${i[12]} ${i[13]}</span>
											<span hidden='true' class='tskid'>${i['Id']}</span>
											<span hidden='true' class='tsktitl'>${i['Titulo']}</span>
											<span hidden='true' class='tskdesc'>${i['Descripcion']}</span>"
											.$spans.
										"</li>";
								}
							}
						}
						echo $html."--".$html2;
						mysqli_free_result($data);
					} else{
						echo "No hay asignaciones que mostrar--No hay contenidos que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_plan':
			session_start();
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$asgn = $_POST['Asignatura'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT pl.*, pr.Nombre, pr.Apellido, a.Nombre
					FROM planificacion pl
					LEFT JOIN profesor pr ON pl.Id_Profesor = pr.Id
					LEFT JOIN asignatura a ON pl.Id_Asignatura = a.Id
					WHERE pl.Id_Seccion = '$secc'
					AND pl.Id_Cohorte = '$coho'
					AND pl.Id_Asignatura = '$asgn'
					AND pl.Estatus = 'Activo'
					GROUP BY pl.Id_Asignatura";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html = "";
						while($i = mysqli_fetch_array($data)){
							$html .= "<p id='pbtop'>
									<span id='pbid' hidden>${i['Id']}</span>
									<span id='pbasgn'><span hidden>${i['Id_Asignatura']}</span><span>${i[10]}</span></span>
									<span id='pbteach'>${i[8]} ${i[9]}</span>
								</p>
								<h3 id='pbtitl'>${i['Titulo']}</h3>
								<p id='pbdesc'>${i['Contenido']}</p>";
						}
						echo $html;
						mysqli_free_result($data);
					} else {
						$html = "";
						if ($_SESSION['user_cargo'] == 2) {
							$html .= "<form id='psbmtform'>
									<p hidden><span id='psbmtid'>${_SESSION['person_id']}</span><span id='psbmtasgn'>$asgn</span></p>
									<label id='psbmttitle'><b>Título del contenido</b>
									<input type='text' placeholder='Título' required></label>
									<label id='psbmtdesc'><b>Descripción del cotenido</b>
									<textarea placeholder='Descripción' rows='5' required></textarea></label>
									<input type='submit' id='psbmt' value='Enviar'>
								</form>";
						} else 
							$html .= "<h3>No hay planificación aún</h3>";
						echo $html;
						mysqli_free_result($data);
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Write_plan':
			session_start();
			$titl = $_POST['Titulo'];
			$prof = $_POST['Profesor'];
			$cont = $_POST['Contenido'];
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$asgn = $_POST['Asignatura'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "INSERT INTO planificacion (Titulo, Contenido, Id_Profesor, Id_Asignatura, Id_Seccion, Id_Cohorte) 
					VALUES ('$titl','$cont','$prof','$asgn','$secc','$coho')";
				if ($data= mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_messages':
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$asig = $_POST['Asignatura'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT mensaje.*, usuario.Nombre, usuario.Photo FROM mensaje
					LEFT JOIN usuario ON mensaje.Id_Autor = usuario.Id
					WHERE mensaje.Id_Seccion = '$secc'
					AND mensaje.Id_Cohorte = '$coho'
					AND mensaje.Id_Asignatura = '$asig'
					AND mensaje.Estatus = 'Activo'
					GROUP BY mensaje.Id";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						session_start();
						$html= "";
						while($i = mysqli_fetch_array($data)){
							if ($_SESSION['user_id'] == $i['Id_Autor']) {
								$html.= "<div class='msg mymsg'>
										<div>
											<div class='msgh'>
												<span class='msgdate'>${i['Fecha']}</span>
												<span class='msgautor'>${i[8]}</span>
											</div>
											<div class='msgb'>
												<p>${i['Contenido']}</p>
												<i hidden='true'>${i['Id']}</i>
												<button class='msgo'>
													<i class='fas fa-cog'></i>
													<div class='msgmenu'>
														<span class='msgedit fas fa-pencil-alt'>Editar</span>
														<span class='msgerase fas fa-trash'>Eliminar</span>
													</div>
												</button>
											</div>
										</div>
										<img class='msgphp' src='${i[9]}'>
									</div>";
							} else {
								$html.= "<div class='msg'>
										<img class='msgphp' src='${i[9]}'>
										<div>
											<div class='msgh'>
												<span class='msgautor'>${i['8']}</span>
												<span class='msgdate'>${i['Fecha']}</span>
											</div>
											<div class='msgb'>"
												.(($_SESSION['user_cargo'] == 1)?
												"<button class='msgo'>
													<i class='fas fa-cog'></i>
													<div class='msgmenu'>
														<span class='msgedit fas fa-pencil-alt'>Editar</span>
														<span class='msgerase fas fa-trash'>Eliminar</span>
													</div>
												</button>":"").
												"<p>${i['Contenido']}</p>
												<i hidden='true'>${i['Id']}</i>
											</div>
										</div>
									</div>";
							}
						}
						echo $html;
						mysqli_free_result($data);
					} else{
						echo "No hay publicaciones que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Upload_message':
			$asig = $_POST['Asign'];
			$content = $_POST['Content'];
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				session_start();
				$sql= "INSERT INTO mensaje (Contenido, Id_Autor, Id_Seccion, Id_Cohorte, Id_Asignatura) 
					VALUES ('$content', '${_SESSION["user_id"]}', '$secc', '$coho', '$asig')";
				if (mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Edit_message':
			$id= $_POST['Id'];
			$content= $_POST['Content'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "UPDATE mensaje 
					SET Contenido = '$content' 
					WHERE Id = '$id'";
				if (mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Delete_message':
			$id= $_POST['Id'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "DELETE FROM mensaje 
					WHERE Id = '$id'";
				if (mysqli_query($key, $sql)) {
					echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_rooms':
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				session_start();
				$sql= "SELECT p_e.Id_Seccion, p_e.Id_Cohorte, p_e.Id_Asignatura, s.Nombre, c.Fecha, a.Nombre
					FROM profesor_estudiante p_e
					LEFT JOIN seccion s ON p_e.Id_Seccion = s.Id
					LEFT JOIN cohorte c ON p_e.Id_Cohorte = c.Id
					LEFT JOIN asignatura a ON p_e.Id_Asignatura = a.Id
					WHERE p_e.Id_Profesor = '${_SESSION["person_id"]}'
					AND p_e.Estatus = 'Activo'
					ORDER BY s.Id";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html= "";
						while($i = mysqli_fetch_array($data)){
							$html.= "<li>${i[5]}<br>${i[3]} (${i['Fecha']})
								<span hidden='true' class='secc'>${i['Id_Seccion']}</span>
								<span hidden='true' class='coho'>${i['Id_Cohorte']}</span>
								<span hidden='true' class='asgn'>${i['Id_Asignatura']}</span></li>";
						}
						echo $html;
						mysqli_free_result($data);
					} else{
						echo "No hay publicaciones que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Upload_content':
			session_start();
			$title= $_POST['Titulo'];
			$desc= $_POST['Descripcion'];
			$prof= $_SESSION["person_id"];
			$asgn= $_POST['Asignacion'];
			$asgra= $_POST['Asignatura'];
			$secc = $_POST['Seccion'];
			$coho = $_POST['Cohorte'];
			$date = $_POST['Fecha'];
			$file = $_FILES['Archivos'];
			$url[] = "";
			if ($file['name'][0] != "") {
				for ($i=0; $i < count($file['name']); $i++) { 
					$nospacename = str_replace(' ', '-', $file['name'][$i]);
					if (move_uploaded_file($file['tmp_name'][$i], "uploads/".$nospacename)) {
						$url[$i] = "uploads/".$nospacename;
					} else {
						echo "Error al subir archivos";
						die();
					}
				}
			} else 
				echo "No archivo";
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo "Error de conexion";
				echo mysqli_connect_error();
			} else {
				$sql= "INSERT INTO contenido (Titulo, Asignacion, Id_Profesor, Id_Asignatura, Id_Seccion, Id_Cohorte, Descripcion, Fecha_limite) 
				VALUES ('$title','$asgn','$prof','$asgra','$secc','$coho','$desc','$date')";
				if (mysqli_query($key, $sql)) {
					$id = mysqli_insert_id($key);
					if ($url[0] != "") {
						$sql2= "INSERT INTO archivo_contenido (`Url`, Id_Contenido) 
							VALUES ";
						for ($i=0; $i < count($url); $i++) {
							if ($i>0) $sql2.= ","; 
							$sql2.= "('${url[$i]}', '$id')";
						}
						if (mysqli_query($key, $sql2)) {
							echo "go";
						} else{
							echo "Error de ejecución";
							echo mysqli_error($key);
						}
					} else 
						echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Reply_content':
			session_start();
			$comm= $_POST['Comentario'];
			$estu= $_SESSION["person_id"];
			$asgn= $_POST['Asignacion'];
			$file = $_FILES['Archivos'];
			$url[] = "";
			if ($file['name'][0] != "") {
				for ($i=0; $i < count($file['name']); $i++) { 
					$nospacename = str_replace(' ', '-', $file['name'][$i]);
					if (move_uploaded_file($file['tmp_name'][$i], "uploads/".$nospacename)) {
						$url[$i] = "uploads/".$nospacename;
					} else {
						echo "Error al subir archivos";
						die();
					}
				}
			} else 
				echo "No archivo";
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo "Error de conexion";
				echo mysqli_connect_error();
			} else {
				$sql= "INSERT INTO respuesta (Comentario, Id_Estudiante, Id_Asignacion) 
				VALUES ('$comm','$estu','$asgn')";
				if (mysqli_query($key, $sql)) {
					$id = mysqli_insert_id($key);
					if ($url[0] != "") {
						$sql2= "INSERT INTO archivo_respuesta (`Url`, Id_Respuesta) 
							VALUES ";
						for ($i=0; $i < count($url); $i++) {
							if ($i>0) $sql2.= ","; 
							$sql2.= "('${url[$i]}', '$id')";
						}
						if (mysqli_query($key, $sql2)) {
							echo "go";
						} else{
							echo "Error de ejecución";
							echo mysqli_error($key);
						}
					} else 
						echo "go";
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Take_replies':
			$id = $_POST['Id'];
			$key= mysqli_connect("localhost", "root", "", "id16512843_uptav");
			if ($key === false) {
				echo mysqli_connect_error();
			} else {
				$sql= "SELECT respuesta.*, estudiante.Nombre, estudiante.Apellido, GROUP_CONCAT(archivo_respuesta.url)
					FROM respuesta
					LEFT JOIN estudiante ON respuesta.Id_Estudiante = estudiante.Id
					LEFT JOIN archivo_respuesta ON respuesta.Id = archivo_respuesta.Id_Respuesta
					WHERE respuesta.Id_Asignacion = '$id'
					AND respuesta.Estatus = 'Activo'
					GROUP BY respuesta.Id";
				if ($data= mysqli_query($key, $sql)) {
					if (mysqli_num_rows($data)>0) {
						$html= "";
						while($i = mysqli_fetch_array($data)){
							$files = explode(",", $i[8]);
							$as = "";
							foreach ($files as $l) {
								$xpld = explode("/", $l);
								$as .= "<a class='rpllink' href='$l' download>${xpld[count($xpld)-1]}</a>";
							}
							$html.= "<li title='${i['Comentario']}'>${i['Nombre']} ${i['Apellido']}<br>
								${i['Fecha_enviado']}<br>
								<span>$as</span></li>";
						}
						echo $html;
						mysqli_free_result($data);
					} else{
						echo "No hay publicaciones que mostrar";
					}
				} else{
					echo "Error de ejecución";
					echo mysqli_error($key);
				}
				mysqli_close($key);
			}
			break;
		case 'Destroy':
			session_start();
			session_destroy();
			echo "go";
			break;
	}
}

?>