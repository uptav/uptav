window.onload = function() {
	if ($('#switchcargo')) {
		$('#frmestu').submit(function(e) {
			e.preventDefault();
			const data = {
				codigo: $('#frmestu .codigo').val(),
				nombre: $('#frmestu .nombre').val(),
				apellido: $('#frmestu .apellido').val(),
				cedula: $('#frmestu .cedula').val(),
				trayecto: $('#frmestu #trayecto').val(),
				trimestre: $('#frmestu #trimestre').val(),
				cohorte: $('#frmestu #cohorte').val(),
				seccion: $('#frmestu #seccion').val(),
				aula: $('#frmestu #aula').val()
			};
			if ($('#frmestu')[0].hasAttribute('editing')) {
				data.id = $('#frmestu')[0].getAttribute('editing');
				var url = "Modules/edit-estudiantes.php";
			} else {
				var url = "Modules/insert-estudiantes.php";
			}
			$.post(url, data, function(respuesta) {
				alert(respuesta);
				location.reload();
			});
		});

		$('#frmvoce').submit(function(e) {  
			e.preventDefault();
			const data = {
				nombre: $('#frmvoce .nombre').val(),
				apellido: $('#frmvoce .apellido').val(),
				cedula: $('#frmvoce .cedula').val()
			};
			if ($('#frmvoce')[0].hasAttribute('editing')) {
				data.id = $('#frmvoce')[0].getAttribute('editing');
				var url = "Modules/edit-voceros.php";
			} else {
				var url = "Modules/insert-voceros.php";
			}
			$.post(url, data, function(respuesta) {
			   alert(respuesta);
			   location.reload();
			});
		});

		$('#frmprof').submit(function(e) {
			e.preventDefault();
			const data = {
				codigo: $('#frmprof .codigo').val(),
				nombre: $('#frmprof .nombre').val(),
				apellido: $('#frmprof .apellido').val(),
				cedula: $('#frmprof .cedula').val()
			};
			if ($('#frmprof')[0].hasAttribute('editing')) {
				data.id = $('#frmprof')[0].getAttribute('editing');
				var url = "Modules/edit-profesores.php";
			} else {
				var url = "Modules/insert-profesores.php";
			}
			$.post(url, data, function(respuesta) {
			   alert(respuesta);
			   location.reload();
			});
		});

		$('#frmadmi').submit(function(e) {
			e.preventDefault();
			const data = {
				nombre: $('#frmadmi .nombre').val(),
				apellido: $('#frmadmi .apellido').val(),
				cedula: $('#frmadmi .cedula').val()
			};
			if ($('#frmadmi')[0].hasAttribute('editing')) {
				data.id = $('#frmadmi')[0].getAttribute('editing');
				var url = "Modules/edit-administrador.php";
			} else {
				var url = "Modules/insert-administrador.php";
			}
			$.post(url, data, function(respuesta) {
			   alert(respuesta);
			   location.reload();
			});
		});

		let select = $('#switchcargo select');
		select.on('change', function() {
			let carg = select[0].value;
			let forms = $('.addfrm');
			for (let i of forms) {
				if (i.getAttribute('id') != carg)
					i.setAttribute('hidden','');
				else
					i.removeAttribute('hidden');
			}
		});

		$('.user .editar').on('click', function(){
			let row = this.parentElement.parentElement;
			let frm = row.querySelector('.idform').innerText;
			let idusuario = row.querySelector('.idusuario').innerText;
			let nombre = row.querySelector('.nombre').innerText;
			let apellido = row.querySelector('.apellido').innerText;
			let cedula = row.querySelector('.cedula').innerText;
			if (frm == "frmprof" || frm == "frmestu") 
				var codigo = row.querySelector('.codigo').innerText;
			if (frm == "frmestu") {
				var trayecto = row.querySelector('.idtrayecto').innerText;
				var trimestre = row.querySelector('.idtrimestre').innerText;
				var cohorte = row.querySelector('.idcohorte').innerText;
				var seccion = row.querySelector('.idseccion').innerText;
				var aula = row.querySelector('.idaula').innerText;
			}
			let editform = $('#'+frm)[0];
			if (editform.querySelector('.codigo'))
				editform.querySelector('.codigo').value = codigo;
			editform.querySelector('.nombre').value = nombre;
			editform.querySelector('.apellido').value = apellido;
			editform.querySelector('.cedula').value = cedula;
			if (frm == "frmestu") {
				editform.querySelector('#trayecto').value = trayecto;
				editform.querySelector('#trimestre').value = trimestre;
				editform.querySelector('#cohorte').value = cohorte;
				editform.querySelector('#seccion').value = seccion;
				editform.querySelector('#aula').value = aula;
			}
			$('#switchcargo h2')[0].innerText = "Editando"
			$('#switchcargo select')[0].value = frm;
			$('#switchcargo select')[0].setAttribute('disabled','');
			let forms = $('.addfrm');
			for (let i of forms) {
				if (i.getAttribute('id') != frm) {
					i.setAttribute('hidden','');
				} else {
					i.setAttribute('editing', idusuario);
					i.querySelector('input[type="submit"]').value = "Actualizar";
					i.removeAttribute('hidden');
				}
			}
		});
		$('.user .eliminar').on('click', function(){
			let row = this.parentElement.parentElement;
			let id = row.querySelector('.idusuario').innerText;
			let nombre = row.querySelector('.nombre').innerText;
			let apellido = row.querySelector('.apellido').innerText;
			let frm = row.querySelector('.idform').innerText;
			if (frm == 'frmadmi') {
				if (confirm('¿Realmente desea eliminar este administrador ('+nombre+' '+apellido+')?')) {
					const data = {
						id: id,
						tabla: 'administrador'
					};
					var url = "Modules/eliminar-usuarios.php";
					$.post(url, data, function(respuesta) {
					   alert(respuesta);
					   location.reload();
					});
				}
			}
			if (frm == 'frmprof') {
				if (confirm('¿Realmente desea eliminar este profesor ('+nombre+' '+apellido+')?')) {
					const data = {
						id: id,
						tabla: 'profesor'
					};
					var url = "Modules/eliminar-usuarios.php";
					$.post(url, data, function(respuesta) {
					   alert(respuesta);
					   location.reload();
					});
				}
			}
			if (frm == 'frmestu') {
				if (confirm('¿Realmente desea eliminar este estudiante ('+nombre+' '+apellido+')?')) {
					const data = {
						id: id,
						tabla: 'estudiante'
					};
					var url = "Modules/eliminar-usuarios.php";
					$.post(url, data, function(respuesta) {
					   alert(respuesta);
					   location.reload();
					});
				}
			}
			if (frm == 'frmvoce') {
				if (confirm('¿Realmente desea eliminar este vocero ('+nombre+' '+apellido+')?')) {
					const data = {
						id: id,
						tabla: 'vocero'
					};
					var url = "Modules/eliminar-usuarios.php";
					$.post(url, data, function(respuesta) {
					   alert(respuesta);
					   location.reload();
					});
				}
			}
		});
	}
	if ($('#frmcurso')) {
		$('#frmcurso').submit(function(e) {
			e.preventDefault();
			const data = {
				id_profesor: $('#frmcurso #profesor').val(),
				id_asignatura: $('#frmcurso #asignatura').val(),
				id_cohorte: $('#frmcurso #cohorte').val(),
				id_seccion: $('#frmcurso #seccion').val(),
				id_aula: $('#frmcurso #aula').val()
			};
			if ($('#frmcurso')[0].hasAttribute('editing')) {
				data.id = $('#frmcurso')[0].getAttribute('editing');
				var url = "Modules/edit-curso.php";
			} else {
				var url = "Modules/insert-curso.php";
			}
			$.post(url, data, function(respuesta) {
				alert(respuesta);
				location.reload();
			});
		});
		$('#asgn input').on('click', function(e){
			e.preventDefault();
			let asignatura = prompt('Ingrese nueva asignatura');
			if (asignatura != null) {
				const data = {
					nombre: asignatura
				};
				var url = "Modules/insert-asignatura.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
		$('.asgn #col2 .editar').on('click', function(){
			let row = this.parentElement.parentElement;
			let id = row.querySelector('.id').innerText;
			let profesor = row.querySelector('.idprofesor').innerText;
			let asignatura = row.querySelector('.idasignatura').innerText;
			var cohorte = row.querySelector('.idcohorte').innerText;
			var seccion = row.querySelector('.idseccion').innerText;
			var aula = row.querySelector('.idaula').innerText;
			
			$('#addcurso')[0].innerText = 'Editar';
			let editform = $('#frmcurso')[0];
			editform.setAttribute('editing', id);
			editform.querySelector('#profesor').value = profesor;
			editform.querySelector('#asignatura').value = asignatura;
			editform.querySelector('#cohorte').value = cohorte;
			editform.querySelector('#seccion').value = seccion;
			editform.querySelector('#aula').value = aula;
			editform.querySelector('input[type="submit"]').value = 'Actualizar';
		});
		$('.asgn #col2 .eliminar').on('click', function(){
			let row = this.parentElement.parentElement;
			let id = row.querySelector('.id').innerText;
			if (confirm('¿Realmente desea eliminar este elemento?')) {
				const data = {
					id: id,
					tabla: 'profesor_estudiante'
				};
				var url = "Modules/eliminar-asignatura-curso.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
		$('.asgn #col1 .editar').on('click', function(){
			let row = this.parentElement.parentElement;
			let id = row.querySelector('.id').innerText;
			let nombre = prompt('Ingrese el nuevo nombre');
			if (nombre != null) {
				const data = {
					id: id,
					nombre: nombre
				};
				var url = "Modules/edit-asignatura.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
		$('.asgn #col1 .eliminar').on('click', function(){
			let row = this.parentElement.parentElement;
			let id = row.querySelector('.id').innerText;
			if (confirm('¿Realmente desea eliminar este elemento?')) {
				const data = {
					id: id,
					tabla: 'asignatura'
				};
				var url = "Modules/eliminar-asignatura-curso.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
	}
	if ($('#tablecontainer')) {
		$('.pertable input').on('click', function(e){
			e.preventDefault();
			let tableref = this.parentElement.parentElement.querySelector('table');
			let tabla = tableref.getAttribute('id');
			let celda = tableref.querySelector('.celda').innerText;
			let nombre = prompt('Ingrese nuevo elemento');
			if (nombre != null) {
				const data = {
					nombre: nombre,
					tabla: tabla,
					celda: celda
				};
				var url = "Modules/insert-periodo.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
		$('.pertable .editar').on('click', function(){
			let tableref = this.parentElement.offsetParent;
			let id = this.parentElement.parentElement.querySelector('.id').innerText;
			let tabla = tableref.getAttribute('id');
			let celda = tableref.querySelector('.celda').innerText;
			let nombre = prompt('Ingrese nuevo nombre');
			if (nombre != null) {
				const data = {
					id: id,
					nombre: nombre,
					tabla: tabla,
					celda: celda
				};
				var url = "Modules/edit-periodo.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
		$('.pertable .eliminar').on('click', function(){
			let tableref = this.parentElement.offsetParent;
			let id = this.parentElement.parentElement.querySelector('.id').innerText;
			let tabla = tableref.getAttribute('id');
			if (confirm("¿Realmente desea eliminar este elemento?")) {
				const data = {
					id: id,
					tabla: tabla
				};
				var url = "Modules/eliminar-periodo.php";
				$.post(url, data, function(respuesta) {
					alert(respuesta);
					location.reload();
				});
			}
		});
	}
}
