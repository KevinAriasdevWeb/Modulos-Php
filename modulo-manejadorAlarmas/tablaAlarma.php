<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
include('database.php');

$query = "SELECT * from tbl_alarmas";

$result = mysqli_query($connection, $query);

if(!$result){
    die('Query Failed'. mysqli_error($connection));
}


$json = array();
while($row = mysqli_fetch_array($result)) {
    if(strtotime($row['hora'])>=strtotime("now") == true){
        $estado = "Activo";
    }else{
        $estado = "Desactivado";
    }

    $diasNombre=array("Dom",'Lun','Mar','Mie','Jue','Vie');
    $diasMostrar=explode(',',$row['dias_frecuencia']);



    $dia = date('w');
    $arraydias=explode(',',$row['dias_frecuencia']);
    if(in_array($dia,$arraydias)){
        $i=0;
        //la variable $diasSalida se vacia despues de cada ciclo.
        //El for muestra los dias Dom, Lun, Mar, Mie, Jue, Vie en vez de 1, 2 ,3 ,4 ,5 ;
        $diasSalida='';
        for($i = 0; $i<count($diasMostrar); $i++){

             $diasSalida.=$diasNombre[$diasMostrar[$i]]." ";
        }
    $json[] = array(
        'id' => $row['id'],
        'dias_frecuencia' =>  $diasSalida,
        'hora' => $row['hora'],
        'estado' => $estado,
        'destinatario' => $row['destinatario'],
        'descripcion' => $row['descripcion']
        
                    );
        

    }
    
    


    
}

$jsonstring = json_encode($json);
echo $jsonstring;


?>
