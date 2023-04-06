<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');
include('database.php');

$sql = ("SELECT * FROM tbl_centrosdeingreso");
$result = mysqli_query($connection, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Contacto</title>
</head>

<body>

    <div class="container p-4 ">

        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">

                        <form id="alert-form" action="contactoCliente.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_registro">Nombre</label>
                                    <input type="text" id="nombre_registro" name="nombre_registro" placeholder="Ingrese su nombre" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono_registro">Telefono</label>
                                    <input type="text" id="telefono_registro" name="telefono_registro" placeholder="Ingrese telefono" class="form-control" required><br>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="correo_registro">Correo</label>
                                    <input type="email" id="correo_registro" name="correo_registro" placeholder="Ingrese su correo" class="form-control" required><br>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_registro">Fecha</label>
                                    <input type="date" class="form-control" name="fecha_registro" id="fecha_reg" maxlength="100" required=""><br>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_especialidad">Curso</label>
                                    <select name="curso_registro" class="form-control" required>
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

                                <div class="form-group col-md-6">
                                <label  for="horarios"> Seleccione una o mas opciones</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="consultas[]" name="consultas[]" value="horarios">
                                        <label class="form-check-label" for="horarios"> Horarios - Fechas de inicio </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="consultas[]" name="consultas[]" value="Precios">
                                        <label class="form-check-label" for="precios"> Precios </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="consultas[]" name="consultas[]" value="contenidos">
                                        <label class="form-check-label" for="contenidos"> Contenidos </label>
                                    </div>
                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="checkbox" id="consultas[]" name="consultas[]" value="requisitos">
                                        <label class="form-check-label" for="requisitos"> Requisitos </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="consultas[]" name="consultas[]" value="ubicacion">
                                        <label class="form-check-label" for="ubicacion"> Ubicacion </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="consultas[]" name="consultas[]" value="formapago">
                                        <label class="form-check-label" for="ubicacion"> Formas de pago </label>
                                    </div>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-primary btn-block text-center" name="Enviar">
                                Enviar
                            </button>
                    </div>
                    </form>

                </div>
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
                    title: 'Registro enviado con exito!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "contacto.php";
                }, 5000);
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }
    ?>

</body>

</html>