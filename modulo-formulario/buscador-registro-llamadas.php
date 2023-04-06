<?php
ini_set("display_errors",1);
error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <title>Buscador Llamadas</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand"> Buscador Llamadas</a>
    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <form action="buscador-registro-llamadas.php" method="POST" class="form-inline my-2 my-lg-0">
            <select name="campoSeleccionado" class="form-control mr-sm-2" >
                <option selected value="">Seleccione registro </option>
                <option value="tiempo_llamado">Tiempo Llamada</option>
                <option value="entusiasmo_percibido">Entusiasmo Percibido</option>
                <option value="Npreguntas_feedback">Cantidad preguntas</option>
                <option value="Comenta_experiencia">Experiencia Usuario</option>
                <option value="actitud_usuario">Actitud</option>
                <option value="percepcion_propuesta_valor">Propuesta Valor</option>
                <option value="percepcion_costo">Propuesta Costo</option>
                <option value="intencion_matricula">Matricula</option>
                <option value="id_seguimiento">Id Seguimiento</option>
                <option value="fecha">Fecha</option>
            </select>
              <input name="search" id="search" value="" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" >
              <button class="btn btn-success my-2 my-sm-0  mr-sm-2" value="" name="buscar" type="submit">
                Search
            </button>
            <button name="mostrar_todo" value="" class="btn btn-success my-2 my-sm-0  mr-sm-2" type="submit">
                Mostrar todo
            </button>

            </form>
    </ul>
        
    </nav>

 
<?php
include('database.php');
//var_dump($_POST);
if(isset($_POST['search']) != "" && isset($_POST['campoSeleccionado']) != "" && isset($_POST['buscar']) != ""){


$search = ($_POST['search']);
$campoSeleccionado = ($_POST['campoSeleccionado']);
$sql = "SELECT tiempo_llamado,entusiasmo_percibido, Npreguntas_feedback, Comenta_experiencia, actitud_usuario,
percepcion_propuesta_valor, percepcion_costo, intencion_matricula, id_seguimiento, fecha FROM tbl_registro_llamada WHERE $campoSeleccionado LIKE '%".$search."%' ";



$result= mysqli_query($connection,$sql);
//var_dump($result);
$salida='';


if($result){

    $row_cnt = $result->num_rows;


    $salida.="<table class='table'>
    <thead>
    <tr>
    <td>Tiempo Llamada</td>
    <td>Entusiasmo Percibido</td>
    <td>Cantidad preguntas</td>
    <td>Experiencia Usuario</td>
    <td>Actitud</td>
    <td>Propuesta Valor</td>
    <td>Propuesta Costo</td>
    <td>Matricula</td>
    <td>Id seguimiento</td>
    <td>Fecha</td>
    </thead>
    <tbody>";

    while($fila = $result->fetch_assoc()){
        $salida.="<tr >
        <td >".$fila['tiempo_llamado']."</td>
        <td >".$fila['entusiasmo_percibido']."</td>
        <td >".$fila['Npreguntas_feedback']."</td>
        <td >".$fila['Comenta_experiencia']."</td>
        <td >".$fila['actitud_usuario']."</td>
        <td >".$fila['percepcion_propuesta_valor']."</td>
        <td >".$fila['percepcion_costo']."</td>
        <td >".$fila['intencion_matricula']."</td>
        <td >".$fila['id_seguimiento']."</td>
        <td >".$fila['fecha']."</td>
        </tr>";

    }
    $salida.="</tbody></table>";
    echo 'Numero de total de registros: ' .$row_cnt;




}else{
$salida.="No hay datos:(";

}

echo $salida;
}

if(isset($_POST['mostrar_todo'])){


$sql2="SELECT * FROM tbl_registro_llamada";
    

$salida2='';

$result2= mysqli_query($connection,$sql2);

    if($result2){
        $row_cnt2 = $result2->num_rows;

        $salida2.="<table class='table'>
        <thead>
        <tr>
        <td>Tiempo Llamada</td>
        <td>Entusiasmo Percibido</td>
        <td>Cantidad preguntas</td>
        <td>Experiencia Usuario</td>
        <td>Actitud</td>
        <td>Propuesta Valor</td>
        <td>Propuesta Costo</td>
        <td>Matricula</td>
        <td>Id seguimiento</td>
        <td>Fecha</td>
        </thead>
        <tbody>";
    
        while($fila2 = $result2->fetch_assoc()){
            $salida2.="<tr >
            <td >".$fila2['tiempo_llamado']."</td>
            <td >".$fila2['entusiasmo_percibido']."</td>
            <td >".$fila2['Npreguntas_feedback']."</td>
            <td >".$fila2['Comenta_experiencia']."</td>
            <td >".$fila2['actitud_usuario']."</td>
            <td >".$fila2['percepcion_propuesta_valor']."</td>
            <td >".$fila2['percepcion_costo']."</td>
            <td >".$fila2['intencion_matricula']."</td>
            <td >".$fila2['id_seguimiento']."</td>
            <td >".$fila2['fecha']."</td>
            </tr>";
    
        }
        $salida2.="</tbody></table>";
        echo 'Numero de total de registros: ' .$row_cnt2;
    }
    echo $salida2;
    
   
}




?>

</body>
</html>