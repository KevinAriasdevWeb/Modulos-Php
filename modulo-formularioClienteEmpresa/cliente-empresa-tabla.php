<?php

include('conexion.php');

if (isset($_POST['enviar']) && !empty($_POST['campo']) && !empty($_POST['buscar'])) {

  $campo = $_POST['campo'];
  $buscar = $_POST['buscar'];
  $busqueda = " AND $campo like '%$buscar%' ";
}
$sql2 = ("SELECT * FROM tbl_comunas");
$result2 = mysqli_query($connect, $sql2);
if (!$result2) {
    die('Query Failed1');
}

$sql = "SELECT * FROM tbl_clientes_empresas where 1=1 $busqueda";

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
  <title>Tabla Contacto</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand">Tabla Clientes Empresas</a>
    <ul class="navbar-nav ml-auto">
      <a href="http://elc.cl/test2/formclienteempresa/formulariocliente-empresa.php" class="btn btn-success mr-sm-3">Crear Cliente Empresa</a>
      <form method="POST" class="form-inline my-2 my-lg-0">
        <select name="campo" class="form-control mr-sm-3 ">
          <option value="">Seleccione Campo</option>
          <option value="rut">Rut</option>
          <option value="razon_social">Razon Social</option>
          <option value="nombre_fantasia">Nombre Fantasia</option>
          <option value="telefono">Telefono </option>
          <option value="email">Email</option>
          <option value="direccion">Direccion</option>
          <option value="comuna">Comuna</option>
          <option value="ciudad">Ciudad</option>
          <option value="direccion_laboral">Direccion Laboral</option>
          <option value="celular">Celular Alumno</option>
          <option value="fecha_nacimiento">Fecha Nacimiento</option>
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
          <th scope="col">RUT</th>
          <th scope="col">RAZON SOCIAL</th>
          <th scope="col">TELEFONO</th>
          <th scope="col">EMAIL</th>
          <th scope="col">DIRECCION</th>
          <th scope="col">COMUNA</th>
          <th scope="col">CIUDAD</th>
          <th scope="col">DIRECCION LABORAL</th>
          <th scope="col">FECHA NACIMIENTO</th>
          <th scope="col">WHATSAPP</th>
          <th scope="col"></th>
          <th scope="col"></th>

        </tr>
      </thead>





      <?php
      $result = mysqli_query($connect, $sql);
      while ($mostrar = $result->fetch_assoc()) {

        $telefono = $mostrar['telefono'];
        //Limpiamos con trim los espacios
        trim($telefono);
        //limpiamos los caracteres y caracteres especiales solo quedaran numeros
        $telefono = preg_replace('/[^0-9]/', '', $telefono);


        //Preguntamos si el largo del numero es igual a 11 y no es necesario agregar 569 sino pregunta si tiene los dos primero
        // numero 56 y agrega 56 + el telefono sino pregunta si los 3 primeros numeros son iguale a 569 y el largo es 
        //= 8 agrega el 569.

        if (strlen($telefono) == 11) {
          $telefono;
        } elseif (substr($telefono, 0, -2) != 56 && strlen($telefono) == 9) {
          $telefono = "56" . $telefono;
        } elseif (substr($telefono, 0, -2) != 569 && strlen($telefono) == 8) {
          $telefono = "569" . $telefono;
        }

      ?>

        <tbody>
          <tr>
            <th><?php echo $mostrar['rut']; ?></th>
            <td><?php echo $mostrar['razon_social']; ?></td>
            <td><?php echo $mostrar['telefono']; ?></td>
            <td><?php echo $mostrar['email']; ?></td>
            <td><?php echo $mostrar['direccion']; ?></td>
            <td> <?php 
                    foreach ($result2 as $fila2) {

                      if ($mostrar['id_comuna'] == $fila2['id_comuna']) {
                        echo   $fila2['nombre'] ;
                      }
                     
                    }
                  
                  ?>
            </td>
            <td><?php echo $mostrar['ciudad']; ?></td>
            <td><?php echo $mostrar['direccion_laboral']; ?></td>
            <td><?php echo $mostrar['fecha_nacimiento']; ?></td>

            <td><a href="https://web.whatsapp.com/send/?phone=<?php echo  $telefono ?>" target="_blank"><?php echo $telefono ?></a> </td>
            <form method="POST" action="cliente-empresa-editar.php?id=<?php echo $mostrar['id_empresa']; ?>">
              <td><input type="hidden" name="id_comuna" value="<?php echo $mostrar['id_comuna']; ?>">
                <input type="hidden" name="id_comuna_laboral" value="<?php echo $mostrar['id_comuna_laboral']; ?>">
                <button name="editar" class="btn btn-success my-2 my-sm-0" type="submit"> Editar </button>
              </td>
            </form>
            <form method="POST" action="cliente-empresa-eliminar.php">
              <td><button value="<?php echo $mostrar['id_empresa']; ?>" name="eliminar" class="btn btn-success my-2 my-sm-0" type="submit"> Eliminar </button> </td>
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
          title: 'Cliente eliminado correctamente!',
          icon: 'success',
          timer: 5000,



        });
        setTimeout(function() {
          window.location.href = "cliente-empresa-tabla.php";
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