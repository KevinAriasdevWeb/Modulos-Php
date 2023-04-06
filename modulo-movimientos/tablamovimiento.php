<?php

include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar'])) {

  $campo = $_POST['campo'];
  $buscar = $_POST['buscar'];

  if (!empty($_POST['campo'])) {
    $busqueda = " AND $campo like '%$buscar%' ";
  }
} else {
  $busqueda = "";
}

if (isset($_POST['enviar']) && !empty($_POST["buscafechadesde"]) && !empty($_POST["buscafechahasta"])) {
  $fecha_desde = $_POST["buscafechadesde"];
  $fecha_hasta = $_POST["buscafechahasta"];
  if (!empty($_POST["buscafechadesde"])) {
    $busqueda .= " AND fecha_movimiento BETWEEN '" . $fecha_desde . "' AND '" . $fecha_hasta . "' ";
  }
  if ($_POST["orden"] == '1') {
    $busqueda .= " ORDER BY fecha_movimiento ASC ";
  }

  if ($_POST["orden"] == '2') {
    $busqueda .= " ORDER BY fecha_movimiento DESC ";
  }
} elseif(isset($_POST['enviar']) && !empty($_POST["buscafechadesde"])){
  $fecha_desde = $_POST["buscafechadesde"];
  if (!empty($_POST["buscafechadesde"])) {
    $busqueda .= " AND fecha_movimiento  = '" . $fecha_desde . "' ";
  }
  if ($_POST["orden"] == '1') {
    $busqueda .= " ORDER BY fecha_movimiento ASC ";
  }

  if ($_POST["orden"] == '2') {
    $busqueda .= " ORDER BY fecha_movimiento DESC ";
  }
}elseif(isset($_POST['enviar']) && !empty($_POST["buscafechahasta"])){
  
  $fecha_hasta = $_POST["buscafechahasta"];
  if (!empty($_POST["buscafechahasta"])) {
    $busqueda .= " AND fecha_movimiento  = '" . $fecha_hasta . "' ";
  }
  if ($_POST["orden"] == '1') {
    $busqueda .= " ORDER BY fecha_movimiento ASC ";
  }

  if ($_POST["orden"] == '2') {
    $busqueda .= " ORDER BY fecha_movimiento DESC ";
  }
  
}
else{
  $_POST['buscafechadesde'] = '';
  $_POST['buscafechahasta'] = '';
}



$sql = "SELECT * FROM tbl_movimiento where 1=1 $busqueda";


$sql2 = "SELECT * FROM tbl_medio_pago";
$result2 = mysqli_query($connect, $sql2);
if (!$result2) {
  die('Falla en conectarse');
}
$sql3 = "SELECT * FROM tbl_movimientos_categorias";
$result3 = mysqli_query($connect, $sql3);
if (!$result3) {
  die('Falla en conectarse');
}


?>

<style>
#texto{

  color: white;
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
  <title>Tabla Movimiento</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <form method="POST" class="form-inline my-2 my-lg-0">
          <table class="table-responsive">
            <thead>
              <tr >
                <th>
                  <p id="texto"> Buscar </p>
                  <input name="buscar" id="search" class="form-control mr-sm-3" type="search" placeholder="Buscar" aria-label="Search">
                </th>
                <th>
                  <p  id="texto"> Campo </p>
                  <select name="campo" class="form-control mr-sm-3 ">
                    <option value="">Seleccione Campo</option>
                    <option value="tipo">Tipo</option>
                    <option value="fecha_movimiento">Fecha Movimiento</option>
                    <option value="categoria">categoria</option>
                    <option value="medio_pago">Metodo de pago</option>
                  </select>
                </th>
                <th>
                  <p  id="texto">Desde </p>
                  <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mr-sm-3 "value="<?php echo $_POST["buscafechadesde"]; ?>">
                </th>
                <th>
                  <p  id="texto">Hasta </p>
                  <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mr-sm-3 " value="<?php echo $_POST["buscafechahasta"]; ?>">
                </th>
                <th>
                  <p  id="texto"> Selecciona el orden</p>
                  <select name="orden" class="form-control mr-sm-3 ">
                    <option value="">Seleccione el orden</option>
                    <option value="1">Antiguas</option>
                    <option value="2">Recientes</option>
                  </select>
                </th>
                <th>
                  <button name="enviar" type="submit"   class="btn btn-success mr-sm-1" style="margin-top: 29px;">buscar</button>
                </th>
                <th>
                  <button name="mostrar" type="submit"   class="btn btn-success mr-sm-1 "  style="margin-top: 29px;" >ver todo</button>
                </th>
              </tr>
            </thead>
          </table>
        </form>
  </nav>


    <?php //inicio de la segunda tabla
    ?>
    <table class="table">
      <thead class="thead-light">
        <thead>
          <tr>
            <th>Creador Id</th>
            <th>Fecha Movimiento</th>
            <th>Fecha Ingreso</th>
            <th>Monto</th>
            <th>Tipo</th>
            <th>Medio de Pago</th>
            <th>Categoria</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
      <tbody>

        <?php
        $result = mysqli_query($connect, $sql);
        while ($mostrar = $result->fetch_assoc()) {
        ?>


          <tr>
            <th><?php echo $mostrar['id_creador']; ?></th>
            <td><?php echo $mostrar['fecha_movimiento']; ?></td>
            <td><?php echo $mostrar['fecha_ingreso']; ?></td>
            <td><?php echo $mostrar['monto']; ?></td>
            <td><?php if ($mostrar['tipo'] == "ingreso") {
                  echo "ingreso";
                }
                if ($mostrar['tipo'] == "egreso") {
                  echo "egreso";
                } ?></td>
            <td>
              <?php

              foreach ($result2 as $mostrar2) {

                if ($mostrar['medio_pago'] == $mostrar2['nombre']) {
                  echo   $mostrar2['nombre'];
                }
              }
              ?>
            </td>
            <td>
              <?php

              foreach ($result3 as $mostrar3) {

                if ($mostrar['categoria'] == $mostrar3['categoria']) {
                  echo   $mostrar3['categoria'];
                }
              }
              ?>
            </td>


            <form method="POST" action="editarmovimiento.php?id=<?php echo $mostrar['id_movimiento']; ?>">
              <td><button name="editar" class="btn btn-success my-2 my-sm-0" type="submit"> Editar </button> </td>
            </form>
            <form method="POST" action="eliminarmovimiento.php">
              <td><button value="<?php echo $mostrar['id_movimiento']; ?>" name="eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button> </td>
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
          title: 'Movimiento eliminado correctamente!',
          icon: 'success',
          timer: 5000,



        });
        setTimeout(function() {
          window.location.href = "tablamovimiento.php";
        }, 2000);
      </script>

  <?php
    }
  } else {
    $eliminar = 'null';
  }

  ?>


</body>

</html>