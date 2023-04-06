<?php

include('conexion.php');
ini_set("display_errors",1);
error_reporting(E_ALL);


if (isset($_POST['eliminar'])){
    $id = $_POST['eliminar'];
    $eliminar = ("DELETE FROM tbl_movimiento WHERE id_movimiento= $id");
     $result = mysqli_query($connect, $eliminar);
    if (!$result){
        die('Falla al eliminar');
    }else{
        header ("Location: tablamovimiento.php?eliminar=ok");
    
    }
    
    
    }
    
    
?>