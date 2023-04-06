<?php
#### ANALISIS PREGUNTAS
include('conexion.php');

ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if (isset($_POST['id_test'])) {
	$id_test = $_POST['id_test'];
} elseif (isset($_GET['id_test'])) {
	$id_test = $_GET['id_test'];
}

if (isset($_POST['codigo_matricula'])) {
	$codigo_matricula = $_POST['codigo_matricula'];
} elseif (isset($_GET['codigo_matricula'])) {
	$codigo_matricula = $_GET['codigo_matricula'];
}


$nRespuestas = 0; ############# INICIALIZA CONTADOR RESPUESTAS

if (isset($id_test) && isset($codigo_matricula)) {
	$sql1 = ("SELECT * FROM tbl_test where id_test='$id_test' ");
	$resultado = mysqli_query($connect, $sql1);
	if (!$resultado) {
		die('Falla al ingreso de datos');
	} else {

		foreach ($resultado as $row) {
			$id_test = $row['id_test'];
			$nombre = $row['nombre'];
			$preguntas = $row['preguntas'];
		}

		$sql2 = ("SELECT * FROM tbl_preguntas_tests where id_pregunta_test in($preguntas) ");
		$listaPreguntas = mysqli_query($connect, $sql2);

		$sql3 = ("SELECT * FROM tbl_respuestas_test where id_pregunta in($preguntas) and codigo_matricula='$codigo_matricula' and id_test='$id_test' ");
		$listaRespuestas = mysqli_query($connect, $sql3);


		$nRespuestas = $listaRespuestas->num_rows;
	}
} else {
	if (!isset($id_test)) {
		echo "<p>NINGUN TEST HA SIDO SELECCIONADO</p>";
	} else {
		if (!isset($codigo_matricula)) {
			echo "<p>NO HA SIDO ENCONTRADO UN CODIGO DE ALUMNO PARA LA CONSULTA</p>";
		} else if ($nRespuestas == 0) {
			echo "<p>UD NO HA CONTESTADO ESTE TEST</p>";
		}
	}
} ###### FIN ISSET ID_TEST

#echo $nombre;

if ($nRespuestas > 0) {

	$correctas = 0;
	$incorrectas = 0;
	$nPreguntas = 0; #### INICIALIZA CONTADORES PARA EVALUAR


	foreach ($listaPreguntas as $pregunta) {
		$id_preguntas = $pregunta['id_pregunta_test'];
		$correcta = $pregunta['correcta'];



		foreach ($listaRespuestas as $respuesta) {
			if ($respuesta['id_pregunta'] == $pregunta['id_pregunta_test']) {
				$nPreguntas++;
				if ($respuesta['respuesta'] == $pregunta['correcta']) {
					$correctas++;
				} else {
					$incorrectas++;
				}
			}
		} ##### FIN CICLO RESUMEN

	}
	$data_array[] = "'$correctas','$incorrectas'";
	$labels_array[] = "'correctas','incorrectas'";

?>

	<style>
		#tabla1 {}

		#tabla2 {
			display: inline-table;
			width: 546;
			margin-left: 15;
		}

		#tabla3 {
			height: 200px;
			width: auto;
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
		<script src="/erp_elc/chartjs/chart.js"></script>
		<title>Analisis Preguntas</title>
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a href="#" class="navbar-brand">Analisis Preguntas</a>
			<ul class="navbar-nav ml-auto">

			</ul>
		</nav>


	<?php


	$porcentajeCorrectas = $correctas * 100 / $nPreguntas;
	$porcentajeIncorrectas = $incorrectas * 100 / $nPreguntas;
	if ($porcentajeCorrectas < 60) {
		$status = 'REPROBADO';
	} else {
		$status = 'APROBADO';
	}

	echo "
	<div class='container p-2'>
	<h1 class='text-center text-info'>";
	foreach ($resultado as $row) {
		echo $row['nombre'];
	}
	echo "</h1>
	<div class='row align-items-start'>
	<div class='col'>
		<table class='table table-hover ' border='0'>
			<thead class='thead-dark text-center'>
			<tr>
			<th scope='col'>CORRECTAS</th>
			<th scope='col'>INCORRECTAS</th>
			</tr>
			</thead>
			<tr>
			<td class='text-center'>$correctas</td>
			<td class='text-center'>$incorrectas</td>
			</tr>
			<tr>
			<td class='text-center'>$porcentajeCorrectas%</td>
			<td class='text-center'>$porcentajeIncorrectas%</td>
			</tr>			
			<tr>
			";
	if ($status == 'APROBADO') {
		echo "
			<td colspan='2' class='text-center bg-success'>$status</td>
			";
	}
	if ($status == 'REPROBADO') {
		echo "
			<td colspan='2' class='text-center bg-danger'>$status</td>
			";
	}
	echo "
			</tr>
		</table>
		
		</div>
		";


	echo "
	
	<div id='tabla3' class='col'>
	<canvas id='myChart' >
	</canvas>
	</div>
	
	";

	echo "

	<div id='tabla2'>
	<table class='table table-hover' border='0'>
		<thead class='thead-dark text-center'>
		<tr>
		<th  scope='col' colspan='2'>DETALLE</th>
		</tr>
		</thead>
	";


	foreach ($listaPreguntas as $pregunta) {
		$id_preguntas = $pregunta['id_pregunta_test'];
		$preguntaTexto = $pregunta['pregunta'];
		$alternativa1 = $pregunta['alternativa1'];
		$alternativa2 = $pregunta['alternativa2'];
		$alternativa3 = $pregunta['alternativa3'];
		$alternativa4 = $pregunta['alternativa4'];
		$correcta = $pregunta['correcta'];




		echo "<tr>" . PHP_EOL;
		echo "<td>$preguntaTexto</td>" . PHP_EOL;
		echo "<td>";
		foreach ($listaRespuestas as $respuesta) {
			if ($respuesta['id_pregunta'] == $pregunta['id_pregunta_test']) {
				if ($respuesta['respuesta'] == $pregunta['correcta']) {
					echo "correcto";
				} else {
					echo "incorrecto";
				}
			}
		}
		echo "</td>";
		echo "</tr>" . PHP_EOL;
	} #### FIN FOREACH DETALLE



	echo "</table>
	
	</div>
	
	</div>
	";

	$data = implode(",", $data_array);
	$labels = implode(",", $labels_array);
} ########## FIN LISTAPREGUNTAS


mysqli_close($connect);
	?>



	</body>

	</html>

	<script>
		const ctx = document.getElementById('myChart').getContext('2d');
		const myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: [<?php echo $labels; ?>],
				datasets: [{
					label: '# de entradas',
					data: [<?php echo $data; ?>],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>