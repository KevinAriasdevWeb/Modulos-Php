<?php

ini_set("display_errors",1);
error_reporting(E_ALL);


include('database.php');

$tiempo_llamado= $_POST['llamada_registro'];
$entusiasmo_percibido= $_POST['options_entusiasmo'];
$nPreguntas_feedback= $_POST['npreguntas_registro'];
$actitud_usuario= $_POST['options_actitud'];
$cuenta_experiencia_vida= $_POST['options_experiencia'];
$percepcion_propuesta_valor= $_POST['options_propuesta'];
$percepcion_costo= $_POST['options_propuesta_costo'];
$intencion_matricula= $_POST['options_matricula'];
$id_seguimiento= $_POST['id_seguimiento_registro'];
$fecha= $_POST['fecha_registro'];


$sql=("INSERT INTO tbl_registro_llamada (tiempo_llamado,entusiasmo_percibido,nPreguntas_feedback,
Comenta_experiencia,actitud_usuario,percepcion_propuesta_valor,percepcion_costo,intencion_matricula, id_seguimiento, fecha)
VALUES('$tiempo_llamado','$entusiasmo_percibido','$nPreguntas_feedback','$actitud_usuario','$cuenta_experiencia_vida',
'$percepcion_propuesta_valor','$percepcion_costo','$intencion_matricula','$id_seguimiento','$fecha')");


$result= mysqli_query($connection,$sql);

if(!$result){
    die('Query Failed');
}else{

    header("Location: formulario-llamadas.php?estado=ok");

}








?>