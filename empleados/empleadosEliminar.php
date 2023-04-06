<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

include('conexion.php');
if (isset($_POST['eliminar'])){
    $id = $_POST['eliminar'];
    $eliminar = ("DELETE FROM tbl_empleados  WHERE id_empleado= $id");
     
     $result = mysqli_query($connect, $eliminar);
    if (!$result){
        die('Falla al eliminar');
    }else{
        header ("Location: tablaEmpleados.php?eliminar=ok");
    
    }
    
    
    }
    
    
?>