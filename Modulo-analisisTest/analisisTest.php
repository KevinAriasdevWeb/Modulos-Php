<?php
#### ANALISIS TEST
include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');


$sql1 = ("SELECT * FROM tbl_test");
$resultado = mysqli_query($connect, $sql1);
if (!$resultado) {
    die('Falla acceso de datos');
}


echo "<table>";
foreach ($resultado as $row) {
 $id_test=$row['id_test'];
 $nombre=$row['nombre']; 
 echo "<tr><td><a href='analisisPreguntas.php?id_test=$id_test'>$nombre</a></td></tr>";
}
echo "</table>";


$mysqli->close($connect);
?>
