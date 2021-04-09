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

if(isset($_POST['celda'])){
	$id = $_POST['id'];
	$celda = $_POST['celda'];
	$nombre = $_POST['nombre'];
	$tabla = $_POST['tabla'];
	$query = "UPDATE $tabla SET $celda= '$nombre'
		WHERE Id = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
	echo "Elemento editado";
	 
}
?>