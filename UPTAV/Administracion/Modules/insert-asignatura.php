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

if(isset($_POST['nombre'])){
	$nombre = $_POST['nombre'];
	$query = "INSERT INTO asignatura (Nombre) VALUES ('$nombre')";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
	echo "Asignatura registrada";
	 
}
?>