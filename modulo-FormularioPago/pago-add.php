<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);


include('database.php');

if(isset($_POST['tipo_operacion'])){
    $operacion = $_POST['tipo_operacion'];
    $nombre_empresa = $_POST['nombre_empresa'];
    $rut_empresa = $_POST['rut_empresa'];
    $fecha_pago = $_POST['fecha_pago'];
    $banco = $_POST['nombre_banco'];
    $tipo_cuenta = $_POST['tipo_cuenta'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $monto = $_POST['monto'];
    $id_usuario = $_POST['id_usuario'];
    $descripcion = $_POST['descripcion'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $estado = "0";
    $codigo_matricula = "2022-1";


    $query ="INSERT INTO tbl_operacion(operacion, nombre_empresa, rut_empresa, 
    fecha_pago, banco, tipo_cuenta, num_cuenta, monto, descripcion, codigo_matricula,
    usuario_creador, fecha_ingreso, estado) VALUES ('$operacion','$nombre_empresa','$rut_empresa',
    '$fecha_pago','$banco','$tipo_cuenta','$numero_cuenta','$monto','$descripcion','$codigo_matricula',
    '$id_usuario','$fecha_ingreso','$estado')";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query Failed');
    }else{

        header("Location: formulario-pago.php?estado=ok");

    }
}


?>