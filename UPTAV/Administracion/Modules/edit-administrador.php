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

if(isset($_POST['nombre']) && ($_POST['apellido']) && ($_POST['cedula'])){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$cargo = 1;
	$query = "UPDATE usuario SET Cedula='$cedula', Nombre='$nombre' 
		WHERE Id = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
	
	$query = "UPDATE administrador SET Nombre='$nombre', Apellido='$apellido', Cedula='$cedula'
	WHERE Id_Usuario = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}   
	echo "Aministrador actualizado";

}
?>