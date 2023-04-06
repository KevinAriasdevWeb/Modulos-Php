<?php

ini_set("display_errors",1);
error_reporting(E_ALL);


include('conexion.php');
if(isset($_POST["enviar_notas"]) || isset($_POST['enviar_nota'])){
//Obtener datos del post y luego asignarlos a las variables para ser insertado en base de datos


foreach($_POST['notas_alumno'] as $resp)
{
		$id_pregunta_insertar=array_keys($resp);
		$key=$id_pregunta_insertar[1];
		$idYtipo=explode(",",$key);
		$respuesta=$resp[$key];
		
		#echo $id_pregunta;
	
		
$sql=("INSERT INTO tbl_notas (id_evaluacion, codigo_matricula, nota, fehca_ingreso) 
VALUES('$respuesta')");


#$result= mysqli_query($connect,$sql);
/**
if(!$connect->query($sql)){
    $timestamp = new DateTime();
   $data_err = " {
        \"title\": \" Select statement error \",
        \"date_time\": ".$timestamp->getTimestamp().",
        \"error\":\" ".$connect->error." \"
       } "; // Do more information
    }
       echo "<pre>".$data_err."</pre>"; 
**/
}
#if(!$result){
    #die('Query Failed');
#}else{

   # header("Location: notasAlumno.php");

#}	
var_dump($_POST['notas_alumno']);
var_dump($sql);
var_dump($respuesta);



}


