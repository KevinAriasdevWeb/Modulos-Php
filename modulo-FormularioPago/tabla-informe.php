<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
include('database.php');


$search = $_POST['search'];
//Se crea la busqueda por medio de search hacia la base de datos


if(!empty($search)){
    $query = "SELECT * FROM tbl_operacion WHERE fecha_ingreso LIKE '%$search%' ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Error'. mysqli_error($connection));
    }
    $row_cnt = $result->num_rows;
}else{

    $fechaActual = date('Y-m-d');
    $search = $fechaActual;
    $query = "SELECT * FROM tbl_operacion WHERE fecha_ingreso = '$search' ";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query Error'. mysqli_error($connection));
    }
    $row_cnt = $result->num_rows;

}
    //Se crea una variable json 
    $json = array();
    //Con el while se recorre los datos y se agregan al row para luego ser mostrados
    $confirmadas =0;
    $montos_confirmados = 0;
    $montos_pendientes= 0;
    $total=0;
    while($row = mysqli_fetch_array($result)){
       if($row['estado']==1){
        $confirmadas ++;
        $montos_confirmados+= $row['monto'];
       }
       if($row['estado']==0){
        $montos_pendientes+= $row['monto'];
       }
       $total+= $row['monto'];
     
    }
    $pendientes = $row_cnt-$confirmadas;
    
    
    $json[] = array(
        'cantidad_total_operaciones' => $row_cnt,
        'total_suma' => $total,
        'cantidad_estado1' => $confirmadas,
        'montos_estado1' => $montos_confirmados,
        'cantidad_estado0' => $pendientes,
        'montos_estado0' => $montos_pendientes
    
    );
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
    
    



    

?>