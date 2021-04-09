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

if(isset($_POST['id_profesor']) && ($_POST['id_cohorte']) && ($_POST['id_seccion']) && ($_POST['id_aula']) && ($_POST['id_asignatura'])){
    $id = $_POST['id'];
    $profesor = $_POST['id_profesor'];
    $cohorte = $_POST['id_cohorte'];
    $seccion = $_POST['id_seccion'];
    $aula = $_POST['id_aula'];
    $asignatura = $_POST['id_asignatura'];
    $query = "UPDATE profesor_estudiante SET Id_Profesor='$profesor', Id_Cohorte='$cohorte', Id_Seccion='$seccion', Id_Aula='$aula', Id_Asignatura='$asignatura'
      WHERE Id = '$id'";
    $resul= mysqli_query($conexion,$query);
    if(!$resul){
        die('Consulta Fallida' . mysqli_error($conexion));
    }
  
  echo "Curso actualizado";
}
?>