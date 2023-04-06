<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$nombre = $_POST["nombre"];
$categoria = $_POST["categoria"];
$descripcion = $_POST["descripcion"];
$stock = $_POST["stock"];



#var_dump($_POST);

$sql = "INSERT INTO tbl_inventario (nombre,categoria,descripcion,stock) 
VALUES ('$nombre','$categoria','$descripcion','$stock')";

$inventarioAdd = mysqli_query($connect, $sql);
if (!$inventarioAdd){
    die('Falla al ingreso de datos');
}else{
    header ("Location: inventarioForm.php?estado=ok");

}
   


}
