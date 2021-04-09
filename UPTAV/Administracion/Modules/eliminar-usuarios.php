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

if(isset($_POST['id']) && ($_POST['tabla'])){
	$id = $_POST['id'];
	$tabla = $_POST['tabla'];
	$query = "UPDATE usuario SET Estatus='Inactivo' 
		WHERE Id = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
  
	$query = "UPDATE $tabla SET Estatus='Inactivo'
		WHERE Id_Usuario = '$id'";
	$resul= mysqli_query($conexion,$query);
	if(!$resul){
		die('Consulta Fallida' . mysqli_error($conexion));
	}
	echo "Usuario elimininado";
	 
}
?>