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
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $cargo = 4;
    $query = "INSERT INTO usuario (Cedula, Nombre, Id_Cargo, Estatus) VALUES ('$cedula', '$nombre', '$cargo', 'Activo')";
    $resul= mysqli_query($conexion,$query);
    if(!$resul){
        die('Consulta Fallida' . mysqli_error($conexion));
    }
  
    $a = mysqli_insert_id($conexion);
   
    $query = "INSERT INTO vocero (Nombre, Apellido, Cedula, Id_Usuario, Estatus) VALUES ('$nombre', '$apellido', '$cedula', '$a' ,'Activo')";
    $resul= mysqli_query($conexion,$query);
    if(!$resul){
        die('Consulta Fallida' . mysqli_error($conexion));
    }
    echo "Vocero registrado";
     
}
?>