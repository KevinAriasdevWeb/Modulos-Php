<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

include('conexion.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $nombre=$_POST['nombre_ponderacion']; 
    $ponderacion=$_POST['ponderacion'];
    $editar = ("UPDATE tbl_ponderaciones  SET nombre='$nombre', ponderacion='$ponderacion' WHERE id_ponderaciones= $id");
     
     $result = mysqli_query($connect, $editar);

    if (!$result){
        die('Falla al editar');
    }else{
        header ("Location: ponderaciones.php?editar=ok");
    
    }
    
    
    }
    
    