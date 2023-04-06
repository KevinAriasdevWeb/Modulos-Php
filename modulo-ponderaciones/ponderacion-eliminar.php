<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

include('conexion.php');
if (isset($_POST['ponderacion-eliminar'])){
    $id = $_POST['ponderacion-eliminar'];
    $eliminar = ("DELETE FROM tbl_ponderaciones  WHERE id_ponderaciones= $id");
     
     $result = mysqli_query($connect, $eliminar);
    if (!$result){
        die('Falla al eliminar');
    }else{
        header ("Location: ponderaciones.php?eliminar=ok");
    
    }
    
    
    }
    
    