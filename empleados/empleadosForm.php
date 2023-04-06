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
    <title>Formulario Empleados</title>
</head>

<body>
    <div class="container p-4 ">
        <div class="row m-0 justify-content-center text-center">

            <div class="card">
                <div class="card-body">
                <form id="form1" name="form1" method="POST" action="empleadosAdd.php" onSubmit="javascript:return Rut(document.form1.rut_alumno.value)" enctype="multipart/form-data">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEstado">Estado</label>
                                <input type="text" name="estado" placeholder="Ingrese Estado" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputRut">Rut</label>
                                <input type="text" name="rut_empleado" id='rut_alumno' onblur='if(document.getElementById("pasaporte").checked==false){javascript:return Rut(document.form1.rut_alumno.value)}' placeholder="Ingrese Rut Empleado" class="form-control">
                                <input type="checkbox" name="pasaporte" id='pasaporte'>Pasaporte
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputNombres">nombres</label>
                                <input type="text" name="nombres" placeholder="Ingrese nombres del empleado"oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')"class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputApellidoPaterno">Apellido Paterno</label>
                                <input type="text" name="apellido_paterno" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Ingrese apellido paterno" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputApellidoMaterno">Apellido Materno</label>
                                <input type="text" name="apellido_materno" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Ingrese apellido materno" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputFechaNacimiento">Fecha nacimiento</label>
                                <input type="date" name="fecha_nacimiento" placeholder="Ingrese fecha nacimiento" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputTelefono">telefono</label>
                                <input type="text" name="telefono_empleado" placeholder="Ingrese telefono empleado" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail">Email</label>
                                <input type="mail" name="email_empleado" placeholder="Ingrese correo electronico" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputDireccion">Direccion</label>
                                <input type="text" name="direccion_empleado" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Ingrese direccion empleado" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputRegion">Region</label>
                                <select name="id_region" class="form-control" required>
                                    <option value="">Seleccione region</option>
                                    <?php
                                    foreach ($resultado2 as $row2) {
                                        echo '<option value="' . $row2['id_region'] . '">' . $row2['nombre_region'] . ' </option>';
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
                                        echo '<option value="' . $row3['id_ciudades'] . '">' . $row3['nombre_ciudad'] . ' </option>';
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
                                        echo '<option value="' . $row4['id_comuna'] . '">' . $row4['nombre'] . ' </option>';
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
                                        echo '<option value="' . $row['id'] . '">' . $row['descripcion'] . ' </option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputsexo">Sexo</label><br>
                                <input class="form-check-input" type="radio" name="sexo" id="defaultCheck2" value="Hombre">
                                <label class="form-check-label " for="defaultCheck1">Hombre</label><br>

                                <input class="form-check-input" type="radio" name="sexo" id="defaultCheck2" value="Mujer">
                                <label class="form-check-label " for="defaultCheck1">Mujer</label><br>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEstadoCivil">Estado Civil</label><br>
                                <input class="form-check-input" type="radio" name="estado_civil" id="defaultCheck2" value="soltero">
                                <label class="form-check-label " for="defaultCheck1">Soltero</label><br>

                                <input class="form-check-input" type="radio" name="estado_civil" id="defaultCheck2" value="casado">
                                <label class="form-check-label " for="defaultCheck1">Casado</label><br>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputNacionalidad">nacionalidad</label>
                                <input type="text" name="nacionalidad_empleado" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Ingrese nacionalidad" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputSueldoBase">Sueldo Base</label>
                                <input type="text" name="sueldo_base" placeholder="Ingrese sueldo base" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputValorHora">valor hora</label>
                                <input type="text" name="valor_hora" placeholder="Ingrese valor hora" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputMonto">Monto</label>
                                <input type="text" name="monto" placeholder="Ingrese monto" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputComision">Comision</label>
                                <input type="text" name="comision" placeholder="Ingrese comision" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBonoColacion">bono colacion</label>
                                <input type="text" name="bono_colacion" placeholder="Ingrese bono colacion" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBonoMovilizacion">bono movilizacion</label>
                                <input type="text" name="bono_movilizacion" placeholder="Ingrese bono movilizacion" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputFechaIngreso">Fecha Ingreso</label>
                                <input type="date" name="fecha_ingreso" placeholder="Ingrese fecha ingreso" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputHoraEntrada">hora entrada</label>
                                <input type="time" name="hora_entrada" placeholder="Ingrese hora entrada" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputHoraSalida">hora salida</label>
                                <input type="time" name="hora_salida" placeholder="Ingrese hora salida" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputTiempoColacion">tiempo colacion</label>
                                <input type="text" name="tiempo_colacion" placeholder="Ingrese tiempo colacion" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputIdAfp">Id afp</label>
                                <input type="text" name="id_afp" placeholder="Ingrese afp" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputIdSalud">Id salud</label>
                                <input type="text" name="id_salud" placeholder="Ingrese salud" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPlanSalud">Plan salud</label>
                                <input type="text" name="plan_salud" placeholder="Ingrese plan salud" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPlanSalud2">Plan salud2</label>
                                <input type="text" name="plan_salud2" placeholder="Ingrese plan salud2" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAPV">APV</label>
                                <input type="text" name="apv" placeholder="Ingrese APV" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPlanApv">Plan APV</label>
                                <input type="text" name="plan_apv" placeholder="Ingrese plan apv" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputCargasFamiliares">Cargas familiares</label>
                                <input type="text" name="cargas_familiares" placeholder="Ingrese cargas familiares" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAntMedicos">ANT medicos</label>
                                <input type="text" name="ant_medicos" placeholder="Ingrese ant medicos" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputContactoUrgencia">Contacto Urgencia</label>
                                <input type="text" name="contacto_urgencia" placeholder="Ingrese contacto urgencia" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputGrupoSanguineo">Grupo Sanguineo</label>
                                <input type="text" name="grupo_sanguineo" placeholder="Ingrese grupo sanguineo" class="form-control">
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
                                <input type="text" name="numero_cuenta" placeholder="Ingrese numero cuenta" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputBanco">Banco</label>
                                <input type="text" name="banco" placeholder="Ingrese nombre banco" class="form-control">
                            </div>

                            <button name="ingresar_empleado" type="submit" class="btn btn-success btn-block text-center">
                                Ingresar
                            </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php

    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Empleado ingresado correctamente!',
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