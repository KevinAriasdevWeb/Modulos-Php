<?php

include('conexion.php');
ini_set("display_errors",1);
error_reporting(E_ALL);


if (isset($_POST['eliminar'])){
    $id = $_POST['eliminar'];
    $eliminar = ("DELETE FROM tbl_diplomas WHERE id_diploma= $id");
     $result = mysqli_query($connect, $eliminar);
    if (!$result){
        die('Falla al eliminar');
    }else{
        header ("Location: diplomasTabla.php?eliminar=ok");
    
    }
    
    
    }
    
    
?>