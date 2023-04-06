<?php
include('database.php');




if(isset($_POST['postular'])){


    $id_oferta = $_POST['id_oferta'];
    $contador = 0;
    ++ $contador;
    $codigo_matricula = "2022-".$contador."";
    $fecha_postulacion = $_POST['fecha_postulacion'];



    $sql=("INSERT INTO tbl_postulaciones (id_oferta, codigo_matricula, fecha_postulacion)
     VALUES ('$id_oferta','$codigo_matricula','$fecha_postulacion')");
    
    $result= mysqli_query($connection,$sql);

    if(!$result){
        die('Query Failed');
    }else{

        header("Location: postulacion.php?estado=ok");

    }





}



















?>