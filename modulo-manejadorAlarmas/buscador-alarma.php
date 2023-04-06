<?php
include('database.php');

$search = $_POST['search'];
//Se crea la busqueda por medio de search hacia la base de datos
if(!empty($search)){
$query = "SELECT * FROM tbl_alarmas WHERE hora LIKE '$search%' OR  descripcion LIKE '$search%'";
$result = mysqli_query($connection, $query);
if(!$result){
    die('Query Error'. mysqli_error($connection));
}

//Se crea una variable json 
$json = array();
//Con el while se recorre los datos y se agregan al row para luego ser mostrados
while($row = mysqli_fetch_array($result)){

    $dia = date('w');
    $arraydias=explode(',',$row['dias_frecuencia']);
    if(in_array($dia,$arraydias)){
    $json[] = array(
        'hora' => $row['hora'],
        'descripcion' => $row['descripcion']

    );
    }
    $jsonstring = json_encode($json);
  echo $jsonstring;
}
}

?>