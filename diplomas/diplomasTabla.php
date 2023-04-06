<?php
include('conexion.php');
ini_set('default_charset', 'utf-8');

if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar'])) {

    if($_POST['buscar'] == 'IMPRESO' || $_POST['buscar'] == 'impreso'){
        $buscar = 2;
    }elseif($_POST['buscar'] == 'SOLICITUD CREADA' || $_POST['buscar'] == 'solicitud creada'){
        $buscar = 1;
    }elseif($_POST['buscar'] == 'ENVIADO A NOTARIA' || $_POST['buscar'] == 'enviado a notaria'){
        $buscar = 3;
    }elseif($_POST['buscar'] == 'DISPONIBLE PARA RETIRO' || $_POST['buscar'] == 'disponible para retiro'){
        $buscar = 4;
    }
    elseif($_POST['buscar'] == 'ENTREGADO' || $_POST['buscar'] == 'entregado'){
        $buscar = 5;
    }else{
        $buscar = $_POST['buscar'];
    }

  $campo = $_POST['campo'];
 
  $busqueda = " AND $campo LIKE '%$buscar%' ";
}

##CONSULTA PARA TRAER LOS DATOS A LA TABLA

$sql = "SELECT * FROM tbl_diplomas where 1=1 $busqueda";

?>

<style>
  .table {
    margin-left: 0px;
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
  <title>Tabla Diplomas</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand">LISTA DIPLOMAS</a>
    <ul class="navbar-nav ml-auto">
      <a href="http://elc.cl/test/diplomas/diplomasForm.php" class="btn btn-success mr-sm-3" target="_blank">Crear Solicitud </a>
      <form method="POST" class="form-inline my-2 my-lg-0">
        <select name="campo" class="form-control mr-sm-3 ">
          <option value="">Seleccione Campo</option>
          <option value="codigo_matricula">Codigo Matricula</option>
          <option value="id_curso">Id curso</option>
          <option value="fecha">Fecha</option>
          <option value="estado">estado solicitud</option>
        </select>
        <input name="buscar" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
        <button name="enviar" value="1" class="btn btn-success mr-sm-3 " type="submit"> Buscar </button>
        <button name="mostrar" class="btn btn-success my-2 my-sm-0" type="submit"> Mostrar Todo </button>
      </form>
    </ul>
  </nav>

  <div class="row m-0 justify-content-center">

    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">ID MATRICULA</th>
          <th scope="col">ID CURSO</th>
          <th scope="col">FECHA INICIO</th>
          <th scope="col">FECHA TERMINO</th>
          <th scope="col">ESTADO</th>
          <th scope="col">EDITAR</th>
          <th scope="col">ELIMINAR</th>
        </tr>
      </thead>

      <?php
      $ConsultaDiplomas = mysqli_query($connect, $sql);
      while ($diplomas = $ConsultaDiplomas->fetch_assoc()) {
      ?>

        <tbody>
          <tr>
            <th><?php echo $diplomas['codigo_matricula']; ?></th>
            <td><?php echo $diplomas['id_curso']; ?></td>
            <td><?php echo $diplomas['fecha']; ?></td>
            <td><?php echo $diplomas['fecha2']; ?></td>
            <td><?php 
            if($diplomas['estado']==1){echo"SOLICITUD CREADA";}
            if($diplomas['estado']==2){echo"IMPRESO";} 
            if($diplomas['estado']==3){echo"ENVIADO A NOTARIA";}
            if($diplomas['estado']==4){echo"DISPONIBLE PARA RETIRO";}
            if($diplomas['estado']==5){echo"ENTREGADO";}?></td>
            <form method="POST" action="diplomasEditar.php">
              <td>
                <button name="editar" value="<?php echo $diplomas['id_diploma'];?>" class="btn btn-success my-2 my-sm-0" type="submit"> Editar </button>
              </td>
            </form>
            <form method="POST" action="diplomasEliminar.php">
              <td><button value="<?php echo $diplomas['id_diploma']; ?>" name="eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button> </td>
            </form>
          </tr>

        <?php
      }
        ?>


        </tbody>
    </table>
  </div>




  <?php

  if (isset($_GET['eliminar'])) {
    $eliminar = $_GET['eliminar'];
    if ($eliminar == "ok") {
  ?>
      <script type="text/javascript">
        swal({
          title: 'diploma eliminado correctamente!',
          icon: 'success',
          timer: 5000,



        });
        setTimeout(function() {
          window.location.href = "diplomasTabla.php";
        }, 1000);
      </script>

  <?php
    }
  } else {
    $eliminar = 'null';
  }

  ?>
</body>

</html>