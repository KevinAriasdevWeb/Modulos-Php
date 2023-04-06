<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');
include('conexion.php');
$sql1 = ("SELECT * FROM tbl_empleados_cargos ");
$resultado = mysqli_query($connect, $sql1);
if (!$resultado) {
    die('Falla al ingreso de datos');
} else {
}

$sql2 = ("SELECT * FROM tbl_regiones ");
$resultado2 = mysqli_query($connect, $sql2);
if (!$resultado2) {
    die('Falla al ingreso de datos');
} else {
}

$sql3 = ("SELECT * FROM tbl_ciudades ");
$resultado3 = mysqli_query($connect, $sql3);
if (!$resultado3) {
    die('Falla al ingreso de datos');
} else {
}

$sql4 = ("SELECT * FROM tbl_comunas ");
$resultado4 = mysqli_query($connect, $sql4);
if (!$resultado4) {
    die('Falla al ingreso de datos');
} else {
}


if (isset($_POST['editar-empleados'])) {

    $id_empleado = $_POST['id_empleado'];
    echo $id_empleado;
    $estado = $_POST["estado"];
    $rut_empleado = $_POST["rut_empleado"];
    $nombres = $_POST["nombres"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $telefono_empleado = $_POST["telefono_empleado"];
    $email_empleado = $_POST["email_empleado"];
    $direccion_empleado = $_POST["direccion_empleado"];
    $id_region = $_POST["id_region"];
    $id_ciudad = $_POST["id_ciudad"];
    $id_comuna = $_POST["id_comuna"];
    $id_cargo = $_POST["id_cargo"];
    $sexo = $_POST["sexo"];
    $estado_civil = $_POST["estado_civil"];
    $nacionalidad_empleado = $_POST["nacionalidad_empleado"];
    $sueldo_base = $_POST["sueldo_base"];
    $valor_hora = $_POST["valor_hora"];
    $monto = $_POST["monto"];
    $comision = $_POST["comision"];
    $bono_colacion = $_POST["bono_colacion"];
    $bono_movilizacion = $_POST["bono_movilizacion"];
    $fecha_ingreso = $_POST["fecha_ingreso"];
    $hora_entrada = $_POST["hora_entrada"];
    $hora_salida = $_POST["hora_salida"];
    $tiempo_colacion = $_POST["tiempo_colacion"];
    $id_afp = $_POST["id_afp"];
    $id_salud = $_POST["id_salud"];
    $plan_salud = $_POST["plan_salud"];
    $plan_salud2 = $_POST["plan_salud2"];
    $apv = $_POST["apv"];
    $plan_apv = $_POST["plan_apv"];
    $cargas_familiares = $_POST["cargas_familiares"];
    $ant_medicos = $_POST["ant_medicos"];
    $contacto_urgencia = $_POST["contacto_urgencia"];
    $grupo_sanguineo = $_POST["grupo_sanguineo"];
    $numero_cuenta = $_POST["numero_cuenta"];
    $banco = $_POST["banco"];


    //Link Contratos
    $contrato = $_FILES["contrato"]["name"];
    $archivo1 = $_FILES['contrato']['tmp_name'];
    $ruta = "/var/www/html/test/empleados/link_contratos";
    $fecha = date_create();
    $fecha = date_timestamp_get($fecha);
    $ruta = $ruta . "/" . $fecha . $contrato_empleado;
    $link = "http://elc.cl/test/empleados/link_contratos/" . $fecha . $contrato_empleado;
    move_uploaded_file($archivo1, $ruta);

    //Link Certificados
    $certificado = $_FILES["certificado"]["name"];
    $archivo2 = $_FILES['certificado']['tmp_name'];
    $ruta2 = "/var/www/html/test/empleados/link_certificados";
    $fecha2 = date_create();
    $fecha2 = date_timestamp_get($fecha2);
    $ruta2 = $ruta2 . "/" . $fecha2 . $certificado_empleado;
    $link2 = "http://elc.cl/test/empleados/link_certificados/" . $fecha2 . $certificado_empleado;
    move_uploaded_file($archivo2, $ruta2);

    //Link CV
    $cv = $_FILES["cv"]["name"];
    $archivo3 = $_FILES['cv']['tmp_name'];
    $ruta3 = "/var/www/html/test/empleados/link_cv";
    $fecha3 = date_create();
    $fecha3 = date_timestamp_get($fecha3);
    $ruta3 = $ruta3 . "/" . $fecha3 . $cv_empleados;
    $link3 = "http://elc.cl/test/empleados/link_cv/" . $fecha3 . $cv_empleados;
    move_uploaded_file($archivo3, $ruta3);

    $sql6 = ("UPDATE tbl_empleados SET estado='$estado',rut='$rut_empleado',nombres='$nombres',
    paterno='$apellido_paterno',materno='$apellido_materno',fecha_nacimiento='$fecha_nacimiento',telefono='$telefono_empleado',email='$email_empleado',
    direccion='$direccion_empleado',id_region='$id_region',id_ciudad='$id_ciudad',id_comuna='$id_comuna',id_cargo='$id_cargo',sexo='$sexo',
    estado_civil='$estado_civil',nacionalidad='$nacionalidad_empleado',sueldo_base='$sueldo_base',valor_hora='$valor_hora',monto='$monto',comision='$comision',
    bono_colacion='$bono_colacion',bono_movilizacion='$bono_movilizacion',fecha_ingreso='$fecha_ingreso',hora_entrada='$hora_entrada',hora_salida='$hora_salida',tiempo_colacion='$tiempo_colacion',
    id_afp='$id_afp',id_salud='$id_salud',plan_salud='$plan_salud',plan_salud2='$plan_salud2',apv='$apv',plan_apv='$plan_apv',cargas_familiares='$cargas_familiares',
    ant_medicos='$ant_medicos',contacto_urgencia='$contacto_urgencia',grupo_sanguineo='$grupo_sanguineo',link_contrato='$link',link_cv='$link3',link_certificados='$link2',
    nro_cuenta='$numero_cuenta',banco='$banco' WHERE id_empleado = '$id_empleado'");
    $result6 = mysqli_query($connect, $sql6);

    /** 
  
 if(!$connect->query($sql1)){
 $timestamp = new DateTime();
$data_err = " {
     \"title\": \" Select statement error \",
     \"date_time\": ".$timestamp->getTimestamp().",
     \"error\":\" ".$connect->error." \"
    } "; // Do more information
 }
	echo "<pre>".$data_err."</pre>"; 
     **/
    if (!$result6) {
        die('Query Failed');
    } else {

        header("Location: empleadosEditar.php?empleado=ok");
    }
}

?>
<style>
    #Sexo {

        margin-left: 15px;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="../js/validarut.js"></script>
    <title>Editar Empleados</title>
</head>

<body>
    <div class="container p-4 ">
        <div class="row m-0 justify-content-center text-center">

            <div class="card">
                <div class="card-body">
                    <?php //inicio de 
                    //Consulta SQL para buscador por id y encontrar datos de contacto a editar
                    //inicio de get recibiendo ID
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        if ($id == $id) {
                            $search_id = $id;

                            $sql = "SELECT * FROM tbl_empleados  WHERE id_empleado  ='" . $search_id . "' ";
                            $result = mysqli_query($connect, $sql);
                            if ($result) {

                                while ($fila = $result->fetch_assoc()) {


                    ?>
                                    <form id="form1" name="form1" method="POST" action="empleadosEditar.php" onSubmit="javascript:return Rut(document.form1.rut_alumno.value)" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEstado">Estado</label>
                                                <input type="text" name="estado" value="<?php echo $fila['estado'] ?>" placeholder="Ingrese Estado" class="form-control">
                                                <input type="hidden" name="id_empleado" value="<?php echo $fila['id_empleado']; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputRut">Rut</label>
                                                <input type="text" name="rut_empleado" value="<?php echo $fila['rut'] ?>" id='rut_alumno' onblur='if(document.getElementById("pasaporte").checked==false){javascript:return Rut(document.form1.rut_alumno.value)}' placeholder="Ingrese Rut Empleado" class="form-control">
                                                <input type="checkbox" name="pasaporte" id='pasaporte'>Pasaporte
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputNombres">nombres</label>
                                                <input type="text" name="nombres" value="<?php echo $fila['nombres'] ?>" placeholder="Ingrese nombres del empleado" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputApellidoPaterno">Apellido Paterno</label>
                                                <input type="text" name="apellido_paterno" value="<?php echo $fila['paterno'] ?>" placeholder="Ingrese apellido paterno" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputApellidoMaterno">Apellido Materno</label>
                                                <input type="text" name="apellido_materno" value="<?php echo $fila['materno'] ?>" placeholder="Ingrese apellido materno" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputFechaNacimiento">Fecha nacimiento</label>
                                                <input type="date" name="fecha_nacimiento" value="<?php echo $fila['fecha_nacimiento'] ?>" placeholder="Ingrese fecha nacimiento" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputTelefono">telefono</label>
                                                <input type="text" name="telefono_empleado" value="<?php echo $fila['telefono'] ?>" placeholder="Ingrese telefono empleado" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail">Email</label>
                                                <input type="mail" name="email_empleado" value="<?php echo $fila['email'] ?>" placeholder="Ingrese correo electronico" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputDireccion">Direccion</label>
                                                <input type="text" name="direccion_empleado" value="<?php echo $fila['direccion'] ?>" placeholder="Ingrese direccion empleado" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" required>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputRegion">Region</label>
                                                <select name="id_region" class="form-control" required>
                                                    <option value="">Seleccione region</option>
                                                    <?php
                                                    foreach ($resultado2 as $row2) {
                                                        echo '<option value="' . $row2['id_region'] . '" ';


                                                        if ($fila['id_region'] == $row2['id_region']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >' . $row2['nombre_region'] . ' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCiudad">Ciudad</label>
                                                <select name="id_ciudad" class="form-control" required>
                                                    <option value="">Seleccione ciudad</option>
                                                    <?php
                                                    foreach ($resultado3 as $row3) {
                                                        echo '<option value="' . $row3['id_ciudades'] . '" ';
                                                        if ($fila['id_ciudad'] == $row3['id_ciudades']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >' . $row3['nombre_ciudad'] . ' </option>';
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputComuna">Comuna</label>
                                                <select name="id_comuna" class="form-control" required>
                                                    <option value="">Seleccione comuna</option>
                                                    <?php
                                                    foreach ($resultado4 as $row4) {
                                                        echo '<option value="' . $row4['id_comuna'] . '" ';
                                                        if ($fila['id_comuna'] == $row4['id_comuna']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >' . $row4['nombre'] . ' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputRegion">Cargo</label>
                                                <select name="id_cargo" class="form-control" required>
                                                    <option value="">Seleccione Cargo</option>
                                                    <?php
                                                    foreach ($resultado as $row) {
                                                        echo '<option value="' . $row['id'] . '" ';
                                                        if ($fila['id_cargo'] == $row['id']) {
                                                            echo ' selected ';
                                                        }
                                                        echo ' >' . $row['descripcion'] . ' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputsexo">Sexo</label><br>
                                                <input class="form-check-input" type="radio" name="sexo" id="defaultCheck2" value="<?php echo $fila['sexo'] ?>" <?php if ($fila['sexo'] == 'Hombre') echo 'checked="checked"'; ?>>
                                                <label class="form-check-label " for="defaultCheck1">Hombre</label><br>

                                                <input class="form-check-input" type="radio" name="sexo" id="defaultCheck2" value="<?php echo $fila['sexo'] ?>" <?php if ($fila['sexo'] == 'Mujer') echo 'checked="checked"'; ?>>
                                                <label class="form-check-label " for="defaultCheck1">Mujer</label><br>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEstadoCivil">Estado Civil</label><br>
                                                <input class="form-check-input" type="radio" name="estado_civil" id="defaultCheck2" value="<?php echo $fila['estado_civil'] ?>" <?php if ($fila['estado_civil'] == 'soltero') echo 'checked="checked"'; ?>>
                                                <label class="form-check-label " for="defaultCheck1">Soltero</label><br>

                                                <input class="form-check-input" type="radio" name="estado_civil" id="defaultCheck2" value="<?php echo $fila['estado_civil'] ?>" <?php if ($fila['estado_civil'] == 'casado') echo 'checked="checked"'; ?>>
                                                <label class="form-check-label " for="defaultCheck1">Casado</label><br>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputNacionalidad">nacionalidad</label>
                                                <input type="text" name="nacionalidad_empleado" value="<?php echo $fila['nacionalidad'] ?>" placeholder="Ingrese nacionalidad" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputSueldoBase">Sueldo Base</label>
                                                <input type="text" name="sueldo_base" placeholder="Ingrese sueldo base" value="<?php echo $fila['sueldo_base'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputValorHora">valor hora</label>
                                                <input type="text" name="valor_hora" placeholder="Ingrese valor hora" value="<?php echo $fila['valor_hora'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputMonto">Monto</label>
                                                <input type="text" name="monto" placeholder="Ingrese monto" value="<?php echo $fila['monto'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputComision">Comision</label>
                                                <input type="text" name="comision" placeholder="Ingrese comision" value="<?php echo $fila['comision'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputBonoColacion">bono colacion</label>
                                                <input type="text" name="bono_colacion" placeholder="Ingrese bono colacion" value="<?php echo $fila['bono_colacion'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputBonoMovilizacion">bono movilizacion</label>
                                                <input type="text" name="bono_movilizacion" placeholder="Ingrese bono movilizacion" value="<?php echo $fila['bono_movilizacion'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputFechaIngreso">Fecha Ingreso</label>
                                                <input type="date" name="fecha_ingreso" placeholder="Ingrese fecha ingreso" value="<?php echo $fila['fecha_ingreso'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputHoraEntrada">hora entrada</label>
                                                <input type="time" name="hora_entrada" placeholder="Ingrese hora entrada" value="<?php echo $fila['hora_entrada'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputHoraSalida">hora salida</label>
                                                <input type="time" name="hora_salida" placeholder="Ingrese hora salida" value="<?php echo $fila['hora_salida'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputTiempoColacion">tiempo colacion</label>
                                                <input type="text" name="tiempo_colacion" placeholder="Ingrese tiempo colacion" value="<?php echo $fila['tiempo_colacion'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputIdAfp">Id afp</label>
                                                <input type="text" name="id_afp" placeholder="Ingrese afp" value="<?php echo $fila['id_afp'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputIdSalud">Id salud</label>
                                                <input type="text" name="id_salud" placeholder="Ingrese salud" value="<?php echo $fila['id_salud'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPlanSalud">Plan salud</label>
                                                <input type="text" name="plan_salud" placeholder="Ingrese plan salud" value="<?php echo $fila['plan_salud'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPlanSalud2">Plan salud2</label>
                                                <input type="text" name="plan_salud2" placeholder="Ingrese plan salud2" value="<?php echo $fila['plan_salud2'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputAPV">APV</label>
                                                <input type="text" name="apv" placeholder="Ingrese APV" value="<?php echo $fila['apv'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPlanApv">Plan APV</label>
                                                <input type="text" name="plan_apv" placeholder="Ingrese plan apv" value="<?php echo $fila['plan_apv'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCargasFamiliares">Cargas familiares</label>
                                                <input type="text" name="cargas_familiares" placeholder="Ingrese cargas familiares" value="<?php echo $fila['cargas_familiares'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputAntMedicos">ANT medicos</label>
                                                <input type="text" name="ant_medicos" placeholder="Ingrese ant medicos" value="<?php echo $fila['ant_medicos'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputContactoUrgencia">Contacto Urgencia</label>
                                                <input type="text" name="contacto_urgencia" placeholder="Ingrese contacto urgencia" value="<?php echo $fila['contacto_urgencia'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputGrupoSanguineo">Grupo Sanguineo</label>
                                                <input type="text" name="grupo_sanguineo" placeholder="Ingrese grupo sanguineo" value="<?php echo $fila['grupo_sanguineo'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputContrato">Contrato</label>
                                                <input type="file" name="contrato" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputCv">CV</label>
                                                <input type="file" name="cv" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputContrato">Certificados</label>
                                                <input type="file" name="certificado" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputNumeroCuenta">Numero Cuenta</label>
                                                <input type="text" name="numero_cuenta" placeholder="Ingrese numero cuenta" value="<?php echo $fila['nro_cuenta'] ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputBanco">Banco</label>
                                                <input type="text" name="banco" placeholder="Ingrese nombre banco" value="<?php echo $fila['banco'] ?>" class="form-control">
                                            </div>

                                            <button name="editar-empleados" type="submit" class="btn btn-success btn-block text-center">
                                                Editar Empleado
                                            </button>
                                    </form>
                    <?php
                                }
                            }
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    if (isset($_GET['empleado'])) {
        $empleado = $_GET['empleado'];
        if ($empleado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Empleado editado correctamente!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "tablaEmpleados.php";
                }, 5000);
            </script>

    <?php
        }
    } else {
        $empleado = 'null';
    }

    ?>

</body>

</html>