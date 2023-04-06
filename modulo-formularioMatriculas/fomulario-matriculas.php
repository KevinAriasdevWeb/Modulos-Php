<?php
include('conexion.php');
ini_set('default_charset', 'utf-8');
//Consulta SQL rescatar nombres de cursos
$sql = ("SELECT * FROM tbl_centrosdeingreso");
$result = mysqli_query($connect, $sql);


//Generar Password Automatico
$opc_letras = TRUE; //  FALSE para quitar las letras

$opc_numeros = TRUE; // FALSE para quitar los números

$opc_letrasMayus = FALSE; // FALSE para quitar las letras mayúsculas

$opc_especiales = FALSE; // FALSE para quitar los caracteres especiales

$longitud = 8;

$password = "";



$letras = "abcdefghijklmnopqrstuvwxyz";

$numeros = "1234567890";

$letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

$especiales = "|@#~$%()=^*+[]{}-_";

$listado = "";



if ($opc_letras == TRUE) {

    $listado .= $letras;
}

if ($opc_numeros == TRUE) {

    $listado .= $numeros;
}

if ($opc_letrasMayus == TRUE) {

    $listado .= $letrasMayus;
}

if ($opc_especiales == TRUE) {

    $listado .= $especiales;
}



str_shuffle($listado);

for ($i = 1; $i <= $longitud; $i++) {

    $password[$i] = $listado[rand(0, strlen($listado))];

    str_shuffle($listado);
}

$password;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Formulario Matriculas</title>
    <script type="text/javascript" src="../js/validarut.js"></script>
</head>

<body>
    <?php

    ?>

    <div class="container p-4 ">

        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">
                        <form id="form1" name="form1" method="POST" action="matriculas-add.php" onSubmit="javascript:return Rut(document.form1.rut_alumno.value)" enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputusuario">Usuario</label>
                                    <input type="text" name="id_usuario" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Numero de Usuario (Numeros)" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="id_especialidad">Especialidad</label>
                                    <select name="id_especialidad" class="form-control" required>
                                        <?php
                                        //Mostrar Lista de especialidad por MYSQL
                                        while ($mostrar = $result->fetch_assoc()) {
                                            foreach ($result as $fila) {
                                        ?>
                                                <option value="<?php echo $fila['id_centroingreso'] ?>"> <?php echo $fila['nombre'] ?></option>

                                        <?php
                                            }
                                            //final del while
                                        }
                                        ?>

                                    </select>
                                   
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCurso">ID Curso</label>
                                    <input type="text" name="id_curso" maxlength="10" placeholder="Especialidad" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputIdMatricula">ID Matricula</label>
                                    <input type="text" name="id_matricula" maxlength="10" placeholder="Ej: 2022-1xxx"  class="form-control" required>
                                </div>
                               
                                <div class="form-group col-md-4">
                                    <label for="inputFechaMatricula">Fecha Matricula</label>
                                    <input type="date" name="fecha_matricula" id="fecha_matricula" placeholder="Fecha Matricula" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputrutAlumno">Rut Alumno</label>
                                    <input type="text" name="rut_alumno" id='rut_alumno' onblur='if(document.getElementById("pasaporte").checked==false){javascript:return Rut(document.form1.rut_alumno.value)}' placeholder="Rut Alumno" class="form-control" >
                                    <input type="checkbox" name="pasaporte" id='pasaporte'>Pasaporte

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputrutApoderado">Rut Apoderado</label>
                                    <input type="text" name="rut_apoderado" id='rut_apoderado'  placeholder="Rut Apoderado" class="form-control" >
                                    <input type="checkbox" name="pasaporte" id='pasaporte'>Pasaporte

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputnombreAlumno">Nombre Alumno</label>
                                    <input type="text" name="nombre_alumno" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Nombre Alumno" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputnombreApoderado">Nombre Apoderado</label>
                                    <input type="text" name="nombre_apoderado" maxlength="255" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Nombre Apoderado" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputValorCurso">Valor Curso</label>
                                    <input type="text" name="valor_curso" maxlength="10" placeholder="Valor Curso" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputValorMatricula">Valor Matricula</label>
                                    <input type="text" name="valor_matricula" maxlength="11" placeholder="Valor Matricula" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCantidadLetras">Cantidad Letras</label>
                                    <input type="text" name="cantidad_letras" maxlength="10" placeholder="Cantidad Letras" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCantidadCuotas">Cantidad Cuotas</label>
                                    <input type="text" name="cantidad_cuotas" maxlength="10" placeholder="Cantidad Cuotas" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputFormaPago">Forma de pago</label>
                                    <input type="text" name="forma_pago" maxlength="10" placeholder="Forma de pago" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputIdEmpresaSence">ID Empresa Sence</label>
                                    <input type="text" name="empresa_sence" maxlength="20" placeholder="Id Empresa Sence" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTipoContrato">ID Tipo Contrato</label>
                                    <input type="text" name="tipo_contrato" maxlength="2" placeholder="Id Tipo Contrato" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputIdPublicidad">ID publicidad</label>
                                    <input type="text" name="id_publicidad" maxlength="255" placeholder="Id Publicidad" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tipo_alumno">Tipo Alumno</label>
                                    <select required name="tipo_alumno" class="form-control">
                                        <option value="" selected>Seleccione tipo alumnno</option>
                                        <option value="1">Particular</option>
                                        <option value="2">Aval</option>
                                        <option value="3">Sence</option>
                                        <option value="4">Beca</option>
                                        <option value="5">Empresa No sence</option>
                                        <option value="6">Sence OTEC</option>
                                    </select>
                                </div>

                                <input type="hidden" name="password" value="<?php echo $password; ?>" class="form-control">

                                <?php $sesion = 1; ?>
                                <input type="hidden" name="sesion" value="<?php echo $sesion; ?>" class="form-control">

                                <div class="form-group col-md-4">
                                    <label for="inputIdAccion">ID Accion</label>
                                    <input type="text" name="id_accion" maxlength="12" placeholder="Id Accion" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputAntiguedadLaboral">Antiguedad Laboral</label>
                                    <input type="text" name="antiguedad_laboral" maxlength="10" placeholder="Antiguedad Laboral" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputfax">Estudios</label>
                                    <input type="text" name="estudios" maxlength="10" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Estudios" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTraidoPor">Traido Por</label>
                                    <input type="text" name="traido_por" maxlength="128" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 ]/,'')" placeholder="Traido Por" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputTraidoPor">Sexo</label><br>
                                    <input type="radio" name="sexo" value="hombre" /> Hombre
                                    <input type="radio" name="sexo" value="mujer" /> Mujer
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="confirma">Confirma</label>
                                    <select required name="confirma" class="form-control">
                                        <option value="" selected>Seleccione Confirma</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="customFile">Seleccione imagen Alumnno</label>
                                    <input type="file" name="imagen_alumno" id="customFile" >
                                    
                                </div>
                                <div class="form-group col-md-4 ">
                                    <label for="customFile">Seleccione imagen Matricula</label>
                                    <input type="file" name="imagen_matricula" id="customFile" >
                                    
                                </div>
                              

                                <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                                    Ingresar Matricula
                                </button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
            <?php

            if (isset($_GET['estado'])) {
                $estado = $_GET['estado'];
                if ($estado == "ok") {
            ?>
                    <script type="text/javascript">
                        swal({
                            title: 'Datos ingresados correctamente!',
                            icon: 'success',
                            timer: 5000,



                        });
                        setTimeout(function() {
                            window.location.href = "tablamatricula.php";
                        }, 1500);
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