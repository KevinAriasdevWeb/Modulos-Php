<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

#var_dump($_POST);

if (isset($_POST['id_evaluacion'])) {
    $id_evaluacion = $_POST['id_evaluacion'];
} elseif (isset($_GET['id_evaluacion'])) {
    $id_evaluacion = $_GET['id_evaluacion'];
}


if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
} elseif (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}else{$accion='null';}


   



if(isset($id_evaluacion) && $accion=='ingresar')
{


	###TRAER NOTAS PREVIAS
	$sql4 = "SELECT * FROM tbl_notas where id_evaluacion='$id_evaluacion' ";
	$notasConsulta = mysqli_query($connect, $sql4);
	$nNotas = $notasConsulta->num_rows;




foreach($_POST['notas'] as $resp)
{

		$key=array_keys($resp);
		$codigo_matricula=$key[0];
			#echo $notas;
		$nota=$resp[$codigo_matricula];
		$fecha_ingreso=date('Y-m-d');
			if($resp[$codigo_matricula]>0)
			{	
					$nota=$resp[$codigo_matricula];
				
				
							
								$sql=("INSERT INTO tbl_notas (id_evaluacion, codigo_matricula, nota, fecha_ingreso) 
								VALUES('$id_evaluacion','$codigo_matricula','$nota','$fecha_ingreso')");
			
							
				

						foreach($notasConsulta as $nc)
						{
							$id_nota=$nc['id_nota'];	
							if($nc['codigo_matricula']==$codigo_matricula)
							{
							
								$sql=("UPDATE tbl_notas
								SET
								id_evaluacion='$id_evaluacion', 
								codigo_matricula='$codigo_matricula', 
								nota='$nota', 
								fecha_ingreso='$fecha_ingreso' 
								WHERE
								id_nota='$id_nota' ");

							}
						}
						
					$result= mysqli_query($connect,$sql);
				

					if(!$result){
						die('Query Failed');
					}else{

					}


			}





	}
		$accion=null;
	   mysqli_free_result($notasConsulta);	 
}###################



if (isset($id_evaluacion)) {
    ##Se tiene que rescatar el dato de id_evaluacion
    $sql = "SELECT * FROM tbl_educacion_evaluacion where id_evaluacion='$id_evaluacion' ";
    $result = mysqli_query($connect, $sql);

		foreach($result as $campoEvaluacion)
		{
				$id_curso=$campoEvaluacion['id_curso'];
		}
	 
	###TRAER NOTAS PREVIAS
	$sql4 = "SELECT * FROM tbl_notas where id_evaluacion='$id_evaluacion' ";
	$notasConsulta = mysqli_query($connect, $sql4);		
		


    ##Consulta para traer nombres de tipo de ponderaciones. Teorico,Pruebas,Examen etc...
    $sql2 = "SELECT * FROM tbl_ponderaciones ";
    $result2 = mysqli_query($connect, $sql2);
    

    
	##Consulta para traer nombres de alumnos de tbl_matriculas
	$sql3 = "SELECT * FROM tbl_matriculas where id_curso='$id_curso'";
	$alumnos = mysqli_query($connect, $sql3);    
    
    
    
    
} else {

    if (!isset($id_evaluacion)) {
        echo "<p>NINGUNA EVALUACION HA SIDO SELECCIONADO</p>";
    } else {
        if (!isset($id_curso)) {
            echo "<p>NO HA SIDO ENCONTRADO UN CURSO PARA LA CONSULTA</p>";
        }
    }
}
	echo "<form action='notas.php' method='post'>".PHP_EOL;
	if(isset($id_evaluacion))
	{
	echo "<input type='hidden' name='id_evaluacion' value='$id_evaluacion'>".PHP_EOL;
	}
	echo "<table>".PHP_EOL;
	foreach($alumnos as $alumno)
	{
	$nombre=$alumno['nombre_alumno'];
	$codigo_matricula=$alumno['codigo_matricula'];	
	


		echo "<tr>".PHP_EOL;
			echo "<td>$nombre</td>".PHP_EOL;
			$valor_nota=0;
			foreach($notasConsulta as $nc)
			{
				if($nc['codigo_matricula']==$codigo_matricula)
				{
					$valor_nota=$nc['nota'];
				}
				
			}
			
			
			
			
			echo "<td><input type='text' name='notas[][$codigo_matricula]' value='$valor_nota' required='required' ></td>".PHP_EOL;			
			
		echo "</tr>".PHP_EOL;
	}
	echo "</table>".PHP_EOL;
	echo "<button type='submit' name='accion' value='ingresar'>ENVIAR</button>".PHP_EOL;
	echo "</form>".PHP_EOL;


?>
