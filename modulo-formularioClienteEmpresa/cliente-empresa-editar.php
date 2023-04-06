<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
include('conexion.php');
ini_set('default_charset', 'utf-8');


//SQL para rescatar datos de comuna y mostrar lista de comunas
#if (isset($_POST['editar']))
 {
  #  $id_comuna2 = $_POST['id_comuna'];
    $sql2 = ("SELECT * FROM tbl_comunas");
    $result2 = mysqli_query($connect, $sql2);
    if (!$result2) {
        die('Query Failed1');
    }
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
    <script type='text/javascript' src='../js/validarut.js'> </script>
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

                                $sql = "SELECT * FROM tbl_clientes_empresas  WHERE id_empresa  ='" . $search_id . "' ";
                                $result = mysqli_query($connect, $sql);
                                if ($result) {

                                    while ($fila = $result->fetch_assoc()) {


                        ?>
                                        <form id='form1' name='form1' action="cliente-empresa-editar.php" method="POST" onsubmit='javascript:return Rut(document.form1.rut_alumno.value)'>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputIdUsuario">Id Usuario</label>
                                                    <input type="text" name="id_usuario"  maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['id_usuario']; ?>" placeholder="Id Usuario " class="form-control" >
                                                    <input type="hidden" name="id_empresa" value="<?php echo $fila['id_empresa']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputIdVendedor">Id Vendedor</label>
                                                    <input type="text" name="id_vendedor" value="<?php echo $fila['id_vendedor']; ?>" maxlength="250" placeholder="Vendedor" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCodigoEmpresa">Codigo Empresa</label>
                                                    <input type="text" name="codigo_empresa" value="<?php echo $fila['codigo_empresa']; ?>" maxlength="10" placeholder="Codigo Empresa (Numeros)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTimeCreacion">Time Creacion</label>
                                                    <input type="text" name="time_creacion" value="<?php echo $fila['time_creacion']; ?>" placeholder="Fecha de creacion" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTipoCliente">Tipo Cliente</label>
                                                    <select class="form-control" name="tipo_cliente" value="<?php echo $fila['tipo_cliente']; ?>" >
                                                        <option value="A" <?php if ($fila['tipo_cliente'] == "A") {
                                                                                echo 'selected';
                                                                            } ?>>A</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEstado">Seleccione estado</label>
                                                    <select class="form-control" name="estado" value="<?php echo $fila['estado']; ?>" >
                                                        <option value="1" <?php if ($fila['estado'] == 1) {
                                                                                echo 'selected';
                                                                            } ?>> Activado </option>
                                                        <option value="0" <?php if ($fila['estado'] == 0) {
                                                                                echo 'selected';
                                                                            } ?>>Desactivado</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputRut">Rut</label>
                                                    <input type="text" name="rut" id='rut_alumno' value="<?php echo $fila['rut']; ?>" onblur='if(document.getElementById("pasaporte").checked==false){javascript:return Rut(document.form1.rut_alumno.value)}' placeholder="Rut" class="form-control" >
                                                 
                                                 
                                                    <input type='checkbox' name='pasaporte' id='pasaporte'  class="form-check-input">
                                                    <label for="inputPasaporte">Pasaporte</label>
                                                    </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputRazonSocial">Razon Social</label>
                                                    <input type="text" name="razon_social" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')"  value="<?php echo $fila['razon_social']; ?>" placeholder="Razon Social" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputNombreFantasia">Nombre Fantasia</label>
                                                    <input type="text" name="nombre_fantasia" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" value="<?php echo $fila['nombre_fantasia']; ?>" placeholder="Nombre Fantasia" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputGiro">giro</label>
                                                    <input type="text" name="giro" maxlength="250" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" value="<?php echo $fila['giro']; ?>" placeholder="giro" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTelefono">Telefono</label>
                                                    <input type="text" name="telefono" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['telefono']; ?>" placeholder="Telefono" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputFax">Fax</label>
                                                    <input type="text" name="fax" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" value="<?php echo $fila['fax']; ?>" placeholder="fax" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail">Email</label>
                                                    <input type="email" name="email" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9@.  ]/,'')" value="<?php echo $fila['email']; ?>" placeholder="email" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputSitioWeb">Sitio Web</label>
                                                    <input type="text" name="sitio_web" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9.  ]/,'')" value="<?php echo $fila['sitio_web']; ?>" placeholder="Sitio Web" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputDireccion">Direccion</label>
                                                    <input type="text" name="direccion" maxlength="200"  placeholder="Direccion" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" value="<?php echo $fila['direccion']; ?>" placeholder="Direccion" class="form-control" >
                                                </div>

                                                <div class="form-group col-md-4">


                                                    <label for="inputComuna">Seleccione Comuna</label>
                                                    <select class="form-control" name="id_comuna" value="<?php echo $fila['id_comuna']; ?>" required>
                                                        <option value="">Seleccione Comuna</option>
                                                        <?php


                                                        while ($fila2 = $result2->fetch_assoc()) {
                                                            foreach ($result2 as $fila2) {
                                                        ?>

                                                                <?php

                                                                echo '<option value="' . $fila2['id_comuna'] . '" ';


                                                                if ($fila['id_comuna'] == $fila2['id_comuna']) {
                                                                    echo ' selected ';
                                                                }
                                                                echo ' >' . $fila2['nombre'] . ' </option>';
                                                                ?>
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>



                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCiudad">Ciudad</label>
                                                    <input type="text" name="ciudad" onkeypress="return soloLetras(event)"  maxlength="50" value="<?php echo $fila['ciudad']; ?>" placeholder="Ciudad" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputRegion">Region</label>
                                                    <input type="text" name="region" onkeypress="return soloLetras(event)" maxlength="50" value="<?php echo $fila['region']; ?>" placeholder="Region" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputContacto">Contacto</label>
                                                    <input type="text" name="contacto" maxlength="255" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['contacto']; ?>" placeholder="Contacto" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputTelefonoContacto">telefono contacto</label>
                                                    <input type="text" name="telefono_contacto" maxlength="50" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['tel_contacto']; ?>" placeholder="Telefono Contacto" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputContactoCobranza">Contacto Cobranza</label>
                                                    <input type="text" name="contacto_cobranza" maxlength="100" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['contacto_cobranza']; ?>" placeholder="Contacto Cobranza" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputMailCobranza">Mail Cobranza</label>
                                                    <input type="text" name="mail_cobranza" maxlength="100" oninput="this.value = this.value.replace(/[^a-zA-Z0-9@.  ]/,'')" value="<?php echo $fila['mail_cobranza']; ?>" placeholder="Mail Cobranza" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputFonoCobranza">Fono Cobranza</label>
                                                    <input type="text" name="fono_cobranza" maxlength="50" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['fono_cobranza']; ?>" placeholder="Fono Cobranza" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputIdComunaLaboral">Seleccione Comuna Laboral</label>
                                                    <select name="id_comuna_laboral" class="form-control">
                                                        <option value="">Seleccione Comuna Laboral</option>
                                                        <?php
                                                        foreach ($result2 as $fila2) {
                                                    
                                                            echo '<option value="' . $fila2['id_comuna'] . '" ';


                                                            if ($fila2['id_comuna'] == $fila['id_comuna_laboral']) {
                                                                echo ' selected ';
                                                            }
                                                            echo ' >' . $fila2['nombre'] . ' </option>';

                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputDireccionLaboral">Direccion laboral</label>
                                                    <input type="text" name="direccion_laboral" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" value="<?php echo $fila['direccion_laboral']; ?>" placeholder="Direccion laboral" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCelular">Celular</label>
                                                    <input type="text" name="celular"  maxlength="13" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $fila['celular']; ?>" placeholder="Celular" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputFechaNacimiento">Fecha Nacimiento</label>
                                                    <input type="date" name="fecha_nacimiento" value="<?php echo $fila['fecha_nacimiento']; ?>" placeholder="Fecha Nacimiento" class="form-control" >
                                                </div>

                                                <button type="submit" name="editar-contacto" class="btn btn-success btn-block text-center">
                                                    Editar Cliente Empresa
                                                </button>


                                        </form>
                            <?php
                                        //final del result 1
                                    }
                                }
                            }

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
                    timer: 2000,



                });
                setTimeout(function() {
                    window.location.href = "cliente-empresa-tabla.php";
                }, 2000);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }
    ?>


<script>
  function soloLetras(e) {
    var key = e.keyCode || e.which,
      tecla = String.fromCharCode(key).toLowerCase(),
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
      especiales = [8, 37, 39, 46],
      tecla_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        tecla_especial = true;
        break;
      }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
      return false;
    }
  }
</script>
</body>

</html>
