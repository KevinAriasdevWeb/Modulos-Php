<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
include('conexion.php');

//SQL para rescatar datos de comuna y mostrar lista de comunas

$sql2 = ("SELECT * FROM tbl_comunas");
$result2 = mysqli_query($connect, $sql2);
if (!$result2) {
    die('Query Failed');
}


//Cuando Se le de al boton editar cliente empresa enviara un UPDATE a la base de datos con los nuevos datos
if (isset($_POST['editar-contacto'])) {



    $id_empresa = $_POST['id_empresa'];
    $id_usuario = $_POST['id_usuario'];
    $id_vendedor = $_POST['id_vendedor'];
    $codigo_empresa = $_POST['codigo_empresa'];
    $time_creacion = $_POST['time_creacion'];
    $tipo_cliente = $_POST['tipo_cliente'];
    $estado = $_POST['estado'];
    $rut = $_POST['rut'];
    $razon_social = $_POST['razon_social'];
    $nombre_fantasia = $_POST['nombre_fantasia'];
    $giro = $_POST['giro'];
    $telefono = $_POST['telefono'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];
    $sitio_web = $_POST['sitio_web'];

    $direccion = $_POST['direccion'];
    $id_comuna = $_POST['id_comuna'];
    $ciudad = $_POST['ciudad'];
    $region = $_POST['region'];
    $contacto = $_POST['contacto'];
    $telefono_contacto = $_POST['telefono_contacto'];
    $contacto_cobranza = $_POST['contacto_cobranza'];
    $mail_cobranza = $_POST['mail_cobranza'];
    $fono_cobranza = $_POST['fono_cobranza'];
    $id_comuna_laboral = $_POST['id_comuna_laboral'];
    $direccion_laboral = $_POST['direccion_laboral'];
    $celular = $_POST['celular'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];





    $sql = ("UPDATE tbl_clientes_empresas SET id_usuario='$id_usuario', id_vendedor='$id_vendedor',
    codigo_empresa='$codigo_empresa', time_creacion='$time_creacion', tipo_cliente='$tipo_cliente', estado='$estado', rut='$rut',
    razon_social='$razon_social', nombre_fantasia='$nombre_fantasia', giro='$giro', telefono='$telefono',
    fax='$fax', email='$email', sitio_web='$sitio_web', direccion='$direccion', id_comuna='$id_comuna', ciudad='$ciudad', 
    region='$region', contacto='$contacto', tel_contacto='$telefono_contacto', contacto_cobranza='$contacto_cobranza', mail_cobranza='$mail_cobranza', 
    fono_cobranza='$fono_cobranza', id_comuna_laboral='$id_comuna_laboral', direccion_laboral='$direccion_laboral', celular='$celular', fecha_nacimiento='$fecha_nacimiento'
    WHERE id_empresa = '$id_empresa' ");
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Query Failed');
    } else {

        header("Location: cliente-empresa-editar.php?Cliente=ok");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Editar Cliente Empresa</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Editar Cliente Empresa</a>
        <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav ml-auto">

            </ul>

    </nav>

    <div class="container p-4 ">

        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">

                        <?php //inicio de 
                        //Consulta SQL para buscador por id y encontrar datos de contacto a editar
                        //inicio de get recibiendo ID
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            if ($id == $id) {
                                $search_id = $id;

                                $sql = "SELECT * FROM tbl_clientes_empresas WHERE id_empresa  LIKE '%" . $search_id . "%' ";
                                $result = mysqli_query($connect, $sql);
                                if ($result) {

                                    while ($fila = $result->fetch_assoc()) {


                        ?>
                                        <form action="cliente-empresa-editar.php" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputIdUsuario">Id Usuario</label>
                                                    <input type="text" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>" placeholder="Id Usuario " class="form-control" required>
                                                    <input type="hidden" name="id_empresa" value="<?php echo $fila['id_empresa']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputIdVendedor">Id Vendedor</label>
                                                    <input type="text" name="id_vendedor" value="<?php echo $fila['id_vendedor']; ?>" placeholder="Id Vendedor" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCodigoEmpresa">Codigo Empresa</label>
                                                    <input type="text" name="codigo_empresa" value="<?php echo $fila['codigo_empresa']; ?>" placeholder="Codigo Empresa" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTimeCreacion">Time Creacion</label>
                                                    <input type="text" name="time_creacion" value="<?php echo $fila['time_creacion']; ?>" placeholder="Fecha de creacion" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTipoCliente">Tipo Cliente</label>
                                                    <select class="form-control" name="tipo_cliente" value="<?php echo $fila['tipo_cliente']; ?>" required>
                                                        <option value="A" <?php if ($fila['tipo_cliente'] == "A") {
                                                                                echo 'selected';
                                                                            } ?>>A</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEstado">Seleccione estado</label>
                                                    <select class="form-control" name="estado" value="<?php echo $fila['estado']; ?>" required>
                                                        <option value="1" <?php if ($fila['estado'] == 1) {
                                                                                echo 'selected';
                                                                            } ?>>Activado</option>
                                                        <option value="0" <?php if ($fila['estado'] == 0) {
                                                                                echo 'selected';
                                                                            } ?>>Desactivado</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputRut">Rut</label>
                                                    <input type="text" name="rut" value="<?php echo $fila['rut']; ?>" placeholder="Rut" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputRazonSocial">Razon Social</label>
                                                    <input type="text" name="razon_social" value="<?php echo $fila['razon_social']; ?>" placeholder="Razon Social" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputNombreFantasia">Nombre Fantasia</label>
                                                    <input type="text" name="nombre_fantasia" value="<?php echo $fila['nombre_fantasia']; ?>" placeholder="Nombre Fantasia" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputGiro">giro</label>
                                                    <input type="text" name="giro" value="<?php echo $fila['giro']; ?>" placeholder="giro" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTelefono">Telefono</label>
                                                    <input type="text" name="telefono" value="<?php echo $fila['telefono']; ?>" placeholder="Telefono" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputFax">Fax</label>
                                                    <input type="text" name="fax" value="<?php echo $fila['fax']; ?>" placeholder="fax" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail">Email</label>
                                                    <input type="email" name="email" value="<?php echo $fila['email']; ?>" placeholder="email" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputSitioWeb">Sitio Web</label>
                                                    <input type="text" name="sitio_web" value="<?php echo $fila['sitio_web']; ?>" placeholder="Sitio Web" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputDireccion">Direccion</label>
                                                    <input type="text" name="direccion" value="<?php echo $fila['direccion']; ?>" placeholder="Direccion" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputComuna">Seleccione Comuna</label>
                                                    <?php if ($result2) { ?>

                                                        <select name="id_comuna" class="form-control">
                                                            <option value="">Seleccione Comuna</option>
                                                            <?php
                                                            foreach ($result2 as $row) {
                                                                echo '<option value="' . $row['id_comuna'] . '" selected>' . $row['nombre'] . ' </option>';
                                                            }
                                                            ?>
                                                        </select>

                                                    <?php
                                                    }

                                                    ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCiudad">Ciudad</label>
                                                    <input type="text" name="ciudad" value="<?php echo $fila['ciudad']; ?>" placeholder="Ciudad" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputRegion">Region</label>
                                                    <input type="text" name="region" value="<?php echo $fila['region']; ?>" placeholder="Region" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputContacto">Contacto</label>
                                                    <input type="text" name="contacto" value="<?php echo $fila['contacto']; ?>" placeholder="Contacto" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTelefonoContacto">telefono contacto</label>
                                                    <input type="text" name="telefono_contacto" value="<?php echo $fila['tel_contacto']; ?>" placeholder="Telefono Contacto" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputContactoCobranza">Contacto Cobranza</label>
                                                    <input type="text" name="contacto_cobranza" value="<?php echo $fila['contacto_cobranza']; ?>" placeholder="Contacto Cobranza" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputMailCobranza">Mail Cobranza</label>
                                                    <input type="text" name="mail_cobranza" value="<?php echo $fila['mail_cobranza']; ?>" placeholder="Mail Cobranza" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputFonoCobranza">Fono Cobranza</label>
                                                    <input type="text" name="fono_cobranza" value="<?php echo $fila['fono_cobranza']; ?>" placeholder="Fono Cobranza" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputIdComunaLaboral">Seleccione Comuna Laboral</label>
                                                    <?php  ?>

                                                        <select name="id_comuna_laboral" class="form-control">
                                                            <option value="">Seleccione Comuna Laboral</option>
                                                            <?php
                                                            foreach ($result as $row) {
                                                                echo '<option value="' . $row['id_comuna_laboral'] . '" selected>' . $row['comuna'] . ' </option>';
                                                            }
                                                            ?>
                                                        </select>

                                                    <?php
                                                    

                                                    ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputDireccionLaboral">Direccion laboral</label>
                                                    <input type="text" name="direccion_laboral" value="<?php echo $fila['direccion_laboral']; ?>" placeholder="Direccion laboral" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCelular">Celular</label>
                                                    <input type="text" name="celular" value="<?php echo $fila['celular']; ?>" placeholder="Celular" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputFechaNacimiento">Fecha Nacimiento</label>
                                                    <input type="text" name="fecha_nacimiento" value="<?php echo $fila['fecha_nacimiento']; ?>" placeholder="Fecha Nacimiento" class="form-control" required>
                                                </div>

                                                <button type="submit" name="editar-contacto" class="btn btn-success btn-block text-center">
                                                    Editar Cliente Empresa
                                                </button>

                                    <?php
                                        //final del result 1
                                    }
                                }
                            }

                                    ?>
                                        </form>

                                    <?php


                                } //final de get con ID

                                    ?>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <?php
    //mensaje alert que se activa despues de ingresar o registrar una accion
    if (isset($_GET['Cliente'])) {
        $Cliente = $_GET['Cliente'];
        if ($Cliente == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Cliente Empresa Editado con exito!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "cliente-empresa-tabla.php";
                }, 4000);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }
    ?>
</body>

</html>