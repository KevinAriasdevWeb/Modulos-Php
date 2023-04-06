<?php
include('database.php');
ini_set("display_errors",1);
error_reporting(E_ALL);


//recibimos los datos del formulario para ser insertados en tabla tbl_registro
if(isset($_POST['nombre_registro'])){

    $nombre = $_POST['nombre_registro'];
    $telefono = $_POST['telefono_registro'];
    $correo = $_POST['correo_registro'];
    $curso = $_POST['curso_registro'];
    $fecha = $_POST['fecha_registro'];


    $consultas = $_POST['consultas'];
    $datoconsulta=implode(",",$consultas);
    
    
    $sql=("INSERT INTO tbl_registro (nombre,correo,telefono,curso_interes,consultas,fecha)
     VALUES ('$nombre','$correo','$telefono','$curso','$datoconsulta','$fecha')");
    
    $result= mysqli_query($connection,$sql);

    if(!$result){
        die('Query Failed');
    }else{

        header("Location: contacto.php?estado=ok");

    }
    

}



?>
