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
    $query = "INSERT INTO usuario (Cedula, Nombre, Id_Cargo, Estatus) VALUES ('$cedula', '$nombre', '$cargo', 'Activo')";
    $resul= mysqli_query($conexion,$query);
    if(!$resul){
        die('Consulta Fallida' . mysqli_error($conexion));
    }
   $a = mysqli_insert_id($conexion);
   
  $query = "INSERT INTO estudiante (Codigo, Nombre, Apellido, Cedula, Id_Trayecto, Id_Trimestre, Id_Cohorte, Id_Seccion, Id_Aula, Id_Usuario, Estatus) VALUES ('$codico', '$nombre', '$apellido', '$cedula', '$tracyeto', '$trimestre', '$cohorte', '$seccion','$aula','$a','Activo')";
  $resul= mysqli_query($conexion,$query);
  if(!$resul){
      die('Consulta Fallida' . mysqli_error($conexion));
  }
  echo "Estudiante resgistrado";
}
?>