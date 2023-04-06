<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if(isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar']))
{

$campo=$_POST['campo'];
$buscar=$_POST['buscar'];   
$busqueda=" AND $campo like '%$buscar%' ";
}else{
    $busqueda="";
}


$sql = "SELECT * FROM tbl_movimiento where 1=1 $busqueda";


?>

<style>
  .grafico{

    margin: auto;




}

.container{

        padding: 20px;
   
        
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/erp_elc/chartjs/chart.js"></script>
  <title>Tabla Monto</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a href="#" class="navbar-brand">Tabla Montos</a>
        <ul class="navbar-nav ml-auto">
            <form method="POST" class="form-inline my-2 my-lg-0">
            <select name="campo" class="form-control mr-sm-3 ">
                 <option value="">Seleccione Campo</option>
                 <option value="fecha_movimiento">Fecha del Movimiento</option>
                 <option value="categoria">Categoria</option>


              </select> 
              <input name="buscar" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">  
              <button name="enviar" value="1" class="btn btn-success mr-sm-3 " type="submit"> Buscar </button> 
              <button name ="mostrar" class="btn btn-success my-2 my-sm-0" type="submit"> Mostrar Todo </button>         
            </form>
         </ul>
        </ul>  
       </nav>


  <div class="container">
    <table class="table table-bordered">
      <thead class="thead-light">
        <thead>
          <tr>
           <th>Fecha del Movimiento</th>
            <th>Descripcion</th>
            <th>Ingreso</th>
            <th>Egreso</th>
          
          </tr>
        </thead>
      <tbody>

        <?php
         $total_ingreso=0;
         $total_egreso=0;
        $result = mysqli_query($connect, $sql);
        while ($mostrar = $result->fetch_assoc()) {
           
        ?>

           
          <tr>
            <th><?php echo $mostrar['fecha_movimiento']; ?></th>
            <th><?php echo $mostrar['categoria']; ?></th>
            <th><?php if ($mostrar['tipo'] == "ingreso"){ echo $mostrar['monto']; $total_ingreso+=$mostrar['monto'];} ?></th>
            <th><?php if($mostrar['tipo'] == "egreso"){echo $mostrar['monto']; $total_egreso+=$mostrar['monto'];} ?></th>
            <?php  } ?>
            <tr>
            <th></th>
            <th></th>
            <td>TOTAL INGRESO:  <?php echo $total_ingreso; ?></td>
           <td>TOTAL EGRESO: <?php echo $total_egreso; ?></td><td> RESULTADO TOTAL: <?php echo ($total_ingreso-$total_egreso);?></td><td>
            <form action='pdfPrueba.php' method="post">
            <input type='hidden' name='campo' value='<?php echo $campo; ?>' >
            <input type='hidden' name='buscar' value='<?php echo $buscar; ?>' >            
            <button class="btn btn-success my-2 my-sm-0" type="submit"> Crear PDF </button></td>
            </form>
          </tr>
          </tr>
      </tbody>
    </table>
  </div>



  <?php // inicio de grafico
?>
<div class="col-md-5 grafico">
<canvas id="myChart"  width="500" height="500">
   
</canvas>
</div>
</div>


<?php 
$data = "'".$total_ingreso."'".","."'".$total_egreso."'";

?>

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
  type: 'pie',
    data: {
        labels: ['Ingresos', 'Egresos'],
        datasets: [{
            label: '# de entradas',
            data: [<?php echo $data;?>],
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


</body>

</html>