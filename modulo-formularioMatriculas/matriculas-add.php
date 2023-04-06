<?php
include('conexion.php');

ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');
if(isset($_POST["enviar"])){


    $id_usuario = $_POST['id_usuario'];
    $id_especialidad = $_POST['id_especialidad'];
    $id_curso = $_POST['id_curso'];
    $codigo_matricula = $_POST['id_matricula'];
    $fecha_matricula = $_POST['fecha_matricula'];
    $rut_alumno = $_POST['rut_alumno'];
    $rut_apoderado = $_POST['rut_apoderado'];
    $nombre_alumno = $_POST['nombre_alumno'];
    $nombre_apoderado = $_POST['nombre_apoderado'];
    $valor_curso = $_POST['valor_curso'];
    $valor_matricula = $_POST['valor_matricula'];
    $cantidad_letras = $_POST['cantidad_letras'];
    $cantidad_cuotas = $_POST['cantidad_cuotas'];
    $forma_pago = $_POST['forma_pago'];
    $empresa_sence = $_POST['empresa_sence'];
    $tipo_contrato = $_POST['tipo_contrato'];
    $id_publicidad = $_POST['id_publicidad'];
    $tipo_alumno = $_POST['tipo_alumno'];
    $password = $_POST['password'];
    $sesion = $_POST['sesion'];
    $id_accion = $_POST['id_accion'];
    $antiguedad_laboral = $_POST['antiguedad_laboral'];
    $estudios = $_POST['estudios'];
    $traido_por = $_POST['traido_por'];
    $sexo = $_POST['sexo'];
    $confirma = $_POST['confirma'];


    $imagen_alumno = $_FILES["imagen_alumno"]["name"];
    $archivo1=$_FILES['imagen_alumno']['tmp_name'];
    $ruta="/var/www/html/test/formularioMatriculas/imagenes";
    $fecha= date_create();
    $fecha= date_timestamp_get($fecha);
    $ruta=$ruta."/".$fecha.$imagen_alumno;
    $link="http://elc.cl/test/formularioMatriculas/imagenes/".$fecha2.$imagen_alumno;
    move_uploaded_file($archivo1,$ruta);


    $imagen_matricula = $_FILES["imagen_matricula"]["name"];
    $archivo2=$_FILES['imagen_matricula']['tmp_name'];
    $ruta2="/var/www/html/test/formularioMatriculas/imagenes";
    $fecha2= date_create();
    $fecha2= date_timestamp_get($fecha2);
    $ruta2=$ruta2."/".$fecha2.$imagen_matricula;
    $link2="http://elc.cl/test/formularioMatriculas/imagenes/".$fecha2.$imagen_matricula;
    move_uploaded_file($archivo2,$ruta2);
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";




$sql1 = ("INSERT INTO tbl_matriculas(time_creacion,usuario_creacion,id_especialidad,id_curso,
codigo_matricula,fecha_matricula,time_matricula,rut_alumno,rut_apoderado,nombre_alumno,nombre_apoderado,
valor_curso,valor_matricula,cantidad_letras,cantidad_cuotas,id_formapago,id_empresa_sence,
id_tipocontrato,id_publicidad,id_tipo_alumno,password,sesion,id_accion,antiguedad_laboral,
estudios,link_imagen_alumno,link_scan_matricula,traido_por,sexo,confirma) VALUES ('$fecha','$id_usuario','$id_especialidad','$id_curso',
'$codigo_matricula','$fecha_matricula','$fecha','$rut_alumno','$rut_apoderado','$nombre_alumno','$nombre_apoderado','$valor_curso',
'$valor_matricula','$cantidad_letras','$cantidad_cuotas','$forma_pago','$empresa_sence','$tipo_contrato','$id_publicidad',
'$tipo_alumno','$password','$sesion','$id_accion','$antiguedad_laboral','$estudios','$link','$link2',
'$traido_por','$sexo','$confirma')");

$resultado = mysqli_query($connect, $sql1);
 
 
/** 
  
 if(!$connect->query($sql1)){
 $timestamp = new DateTime();
$data_err = " {
     \"title\": \" Select statement error \",
     \"date_time\": ".$timestamp->getTimestamp().",
     \"error\":\" ".$connect->error." \"
    } "; // Do more information
 }
	echo "<pre>".$data_err."</pre>"; 
**/
  
  
if (!$resultado){
    die('Falla al ingreso de datos');
}else{
    header ("Location:fomulario-matriculas.php?estado=ok");

}
   


}




?>
