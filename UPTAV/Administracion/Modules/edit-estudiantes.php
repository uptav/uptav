<?php

$HOST = "localhost";
$NBDD = "id16512843_uptav";
$Usuario = "id16512843_root";
$contraseña = "lqdd8Dn?j)GnRp]c";   

$conexion= mysqli_connect($HOST,$Usuario,$contraseña,$NBDD);

if(mysqli_connect_errno($conexion)){
   echo "Error Al conectar con el servidor"; 
   exit();
}

if(isset($_POST['codigo']) && ($_POST['nombre']) && ($_POST['apellido']) && ($_POST['cedula']) && ($_POST['trayecto']) && ($_POST['trimestre']) && ($_POST['cohorte']) && ($_POST['seccion']) && ($_POST['aula'])){
	$id = $_POST['id'];
	$codico = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$tracyeto = $_POST['trayecto'];
	$trimestre = $_POST['trimestre'];
	$cohorte = $_POST['cohorte'];
	$seccion = $_POST['seccion'];
	$aula = $_POST['aula'];
	$cargo = 3;
	$query = "UPDATE usuario SET Cedula='$cedula', Nombre='$nombre' 
		WHERE Id = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
	$query = "UPDATE estudiante SET Codigo='$codico', Nombre='$nombre', Apellido='$apellido', Cedula='$cedula', Id_Trayecto='$tracyeto', Id_Trimestre='$trimestre', Id_Cohorte='$cohorte', Id_Seccion='$seccion', Id_Aula='$aula'
		WHERE Id_Usuario = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
	echo "Estudiante actualizado";
}
?>