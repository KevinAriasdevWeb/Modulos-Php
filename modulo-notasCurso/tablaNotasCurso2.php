<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if (isset($_POST['id_curso'])) {
    $id_curso = $_POST['id_curso'];
} elseif (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
}



if (isset($id_curso)) {

	### CONSULTA EVALUACIONES, FILTRADO POR CURSO
    $sql = "SELECT * FROM tbl_educacion_evaluacion where id_curso = '$id_curso'";
    $evaluacionesConsulta = mysqli_query($connect, $sql);
	### CONSULTA NOTAS
    $sql2 = "SELECT * FROM tbl_notas ";
    $notasConsulta = mysqli_query($connect, $sql2);
	### CONSULTA MATRICULAS
    $sql3 = "SELECT * FROM tbl_matriculas where id_curso = '$id_curso'";
    $matriculasConsulta = mysqli_query($connect, $sql3);
    
    
}
?>




<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
	

		
<?php

	echo "<table>
	<tr>
		<th>COD MATRICULA</th>
		<th>ALUMNO</th>		
	";	
		 	
			foreach($evaluacionesConsulta as $ev)
			{
				echo "<th>".strtoupper($ev['nombre'])."</th>";
			}
	echo "</tr>";
	
	foreach($matriculasConsulta as $mc){
		echo "<tr>";
			echo "<td>";
			echo $mc['codigo_matricula'];
			echo "</td>";			
			echo "<td>";
			echo $mc['nombre_alumno'];
		echo "</td>";	
	
			foreach($evaluacionesConsulta as $ev)
			{
				echo "<td>";		
				$nota=0;
				foreach($notasConsulta as $nc)
				{
					if($nc['codigo_matricula']==$mc['codigo_matricula'] && $nc['id_evaluacion']==$ev['id_evaluacion'])
					{
						$nota=$nc['nota'];
					}
				}	
				echo $nota;
				echo "</td>";
			}
			
			
		echo "</tr>";		
		
	}
		
	echo "</table>";

?>	
	


</body>

</html>
