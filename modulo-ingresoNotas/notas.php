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

if (isset($_POST['id_curso'])) {
	$id_curso_2 = $_POST['id_curso'];
} elseif (isset($_GET['id_curso'])) {
	$id_curso_2 = $_GET['id_curso'];
}



if (isset($_POST['accion'])) {
	$accion = $_POST['accion'];
} elseif (isset($_GET['accion'])) {
	$accion = $_GET['accion'];
} else {
	$accion = 'null';
}






if (isset($id_evaluacion) && $accion == 'ingresar') {


	###TRAER NOTAS PREVIAS
	$sql4 = "SELECT * FROM tbl_notas where id_evaluacion='$id_evaluacion' ";
	$notasConsulta = mysqli_query($connect, $sql4);
	$nNotas = $notasConsulta->num_rows;




	foreach ($_POST['notas'] as $resp) {

		$key = array_keys($resp);
		$codigo_matricula = $key[0];
		#echo $notas;
		$nota = $resp[$codigo_matricula];
		$fecha_ingreso = date('Y-m-d');
		if ($resp[$codigo_matricula] > 0) {
			$nota = $resp[$codigo_matricula];



			$sql = ("INSERT INTO tbl_notas (id_evaluacion, codigo_matricula, nota, fecha_ingreso) 
								VALUES('$id_evaluacion','$codigo_matricula','$nota','$fecha_ingreso')");




			foreach ($notasConsulta as $nc) {
				$id_nota = $nc['id_nota'];
				if ($nc['codigo_matricula'] == $codigo_matricula) {

					$sql = ("UPDATE tbl_notas
								SET
								id_evaluacion='$id_evaluacion', 
								codigo_matricula='$codigo_matricula', 
								nota='$nota', 
								fecha_ingreso='$fecha_ingreso' 
								WHERE
								id_nota='$id_nota' ");
				}
			}

			$result = mysqli_query($connect, $sql);


			if (!$result) {
				die('Query Failed');
			} else {
				header ("Location: tablaNotasCurso.php?id_curso=".$id_curso_2."&estado=ok");
			}
		}
	}
	$accion = null;
	mysqli_free_result($notasConsulta);
} ###################



if (isset($id_evaluacion)) {
	##Se tiene que rescatar el dato de id_evaluacion
	$sql = "SELECT * FROM tbl_educacion_evaluacion where id_evaluacion='$id_evaluacion' ";
	$result = mysqli_query($connect, $sql);

	foreach ($result as $campoEvaluacion) {
		$id_curso = $campoEvaluacion['id_curso'];
		$nombreEvaluacion = $campoEvaluacion['nombre'];
		$ponderacion = $campoEvaluacion['ponderacion'];
		$fecha_evaluacion = $campoEvaluacion['fecha_evaluacion'];
		$tipo = $campoEvaluacion['tipo'];
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


?>
<style>
	#tabla_largo {
		width: 433px;
	}

	#card_completa{

	margin-left: 17px;
	}
	
</style>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<title>Notas Alumno</title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a href="#" class="navbar-brand">Notas Alumno</a>
		<ul class="navbar-nav ml-auto">
			<form method="POST" class="form-inline my-2 my-lg-0">
			</form>
		</ul>
	</nav>

	<div class="container p-4 ">

		<div class="col p-5 text-center">
			<?php
		
			?>
				<div class="card">
					<div class="card-body">

						<div id='card_completa' class='card '>
							<div class='card-body  '>
								<?php ##Aqui va el titulo 
								?>
								<div id='header_card' class='row align-items-center card-header bg-dark text-white '>
									<div class='col'>
										<h5 class='card-title'>Curso: <?php echo $nombreEvaluacion; ?></h5>
									</div>
								</div>
								<?php ##Aqui va el contenido en el centro 
								?>
								<div id='body_card' class='row align-items-start card-body text-black'>
									<div class='col'>
										<p class='text-end text-justify '>Tipo Evaluacion: <?php foreach ($result2 as $fila2) {
																								if ($tipo == $fila2['id_ponderaciones']) {
																									echo $fila2['nombre'];
																								}
																							};  ?><br><br>
											Ponderacion: <?php echo $ponderacion; ?> <br><br>

											Fecha evaluacion: <?php echo $fecha_evaluacion; ?>
										</p>

									</div>
								</div>
								<div id='footer_card' class='row align-items-end card-footer  '>
									<?php ##Aqui va el footer 
									?>
									<div class='col'> </div>
									<div class='col'> </div>
								</div>
							</div>

						</div>
					<?php
				
					?>

					<br>
					<br>
					<br>

					<?php
					##Incio Form 
					?>

					<div class="form-row">

						<div class="form-check">


							<?php
							echo "<form action='notas.php' method='post'>" . PHP_EOL;
							if (isset($id_evaluacion)) {
								echo "<input type='hidden' name='id_evaluacion' value='$id_evaluacion'>" . PHP_EOL;
							}
							echo "<table table class='table table-hover table-bordered'>" . PHP_EOL;
							echo " <thead class='thead-dark'>" . PHP_EOL;
							echo " <tr>
					<th id='tabla_largo' scope='col'>#</th>
					<th id='tabla_largo' scope='col'>Alumno</th>
					<th id='tabla_largo' scope='col'>Nota</th>
					<th id='tabla_largo' scope='col'>Estatus</th>
					</tr>
			        </thead>" . PHP_EOL;
							$contador = 1;
							foreach ($alumnos as $alumno) {
								$nombre = $alumno['nombre_alumno'];
								$codigo_matricula = $alumno['codigo_matricula'];



								echo "<tr>" . PHP_EOL;
								echo "<td>$contador</td>" . PHP_EOL;
								echo "<td>$nombre</td>" . PHP_EOL;
								$valor_nota = 0;
								$contador++;
								foreach ($notasConsulta as $nc) {
									if ($nc['codigo_matricula'] == $codigo_matricula) {
										$valor_nota = $nc['nota'];
									}
								}



								if ($valor_nota <= 4) {
								echo "<td><input type='text' name='notas[][$codigo_matricula] 'class='text-center bg-danger' value='$valor_nota' required='required' ></td>" . PHP_EOL;
								echo "<td style='color:red;'>REPROBADO</td>" . PHP_EOL;
							   }
							   if ($valor_nota > 4) {
								echo "<td><input type='text' name='notas[][$codigo_matricula] 'class='text-center bg-success' value='$valor_nota' required='required' ></td>" . PHP_EOL;
								echo "<td style='color:green;'>APROBADO</td>" . PHP_EOL;   
							}
								echo "</tr>" . PHP_EOL;
							}
							echo "</table>" . PHP_EOL;
							echo "<button type='submit' name='accion' value='ingresar' class='btn btn-success btn-block text-center'>ENVIAR</button>" . PHP_EOL;
							echo "<input type='hidden' name='id_curso' value='$id_curso_2' ></form>" . PHP_EOL;
					
							?>

						</div>

					</div>

					</div>

				</div>
		</div>

	</div>

	


</body>

</html>