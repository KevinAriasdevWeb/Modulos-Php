<?php
include("conexion.php");
ini_set('default_charset', 'utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start(['name' => 'IA']);
$timestamp_actual = strtotime('now');

##Recibiendo codigo matricula
if (isset($_POST['codigo_matricula'])) {
    $codigo_matricula = $_POST['codigo_matricula'];
} elseif (isset($_GET['codigo_matricula'])) {
    $codigo_matricula = $_GET['codigo_matricula'];
} else {

    $codigo_matricula = null;
}

##Recibiendo id clase
if (isset($_POST['id_clase'])) {
    $id_clase = $_POST['id_clase'];
} elseif (isset($_GET['id_clase'])) {
    $id_clase = $_GET['id_clase'];
} else {

    $id_clase = null;
}
##Recibiendo id_curso
if (isset($_POST['id_curso'])) {
    $id_curso = $_POST['id_curso'];
} elseif (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];
} else {

    $id_curso = null;
}
##Recibiendo id_especialidad
if (isset($_POST['id_especialidad'])) {
    $id_especialidad  = $_POST['id_especialidad'];
} elseif (isset($_GET['id_especialidad'])) {
    $id_especialidad  = $_GET['id_especialidad'];
} else {

    $id_especialidad  = null;
}

##Recibiendo estado
if (isset($_POST['estado '])) {
    $estado  = $_POST['estado '];
} elseif (isset($_GET['estado '])) {
    $estado  = $_GET['estado '];
} else {

    $estado  = 0;
}




$_SESSION['MATRICULA_IA'] = $codigo_matricula;
$_SESSION['IDCLASE_IA'] =  $id_clase;
$_SESSION['IDCURSO_IA'] = $id_curso;
$_SESSION['ESPECIALIDAD_IA'] = $id_especialidad;
$_SESSION['ESTADO_IA'] = $estado;




echo "Matricula " . $_SESSION['MATRICULA_IA'] . "<br>";
echo "ID CLASE" . $_SESSION['IDCLASE_IA']  . "<br>";
echo "CURSO" . $_SESSION['IDCURSO_IA'] . "<br>";
echo "ESPECIALIDAD" .$_SESSION['ESPECIALIDAD_IA']. "<br>";
echo "ESTADO" . $_SESSION['ESTADO_IA']. "<br>";
echo "TIEMPO" . $timestamp_actual;


if (!is_null($codigo_matricula)  & !is_null($id_curso)  & !is_null($id_especialidad)) {

    ### CONSULTA ALUMNO POR CODIGO MATRICULA, ID CLASE, ID CURSO, ESPECIALIDAD.
    $sql = "SELECT * FROM tbl_matriculas where codigo_matricula = '".$_SESSION['MATRICULA_IA']."' AND id_curso='".$_SESSION['IDCURSO_IA']."'
    AND id_especialidad='".$_SESSION['ESPECIALIDAD_IA']."'";
    $alumnoIntervencion = mysqli_query($connect, $sql);


    ##CONSULTA PARA SABER CUANTAS VECES LEVANTO LA MANO
    $sql2 = "SELECT * FROM tbl_intervencion_alumnos where codigo_matricula = '".$_SESSION['MATRICULA_IA']."'";
    $alumnoIntervencion2 = mysqli_query($connect, $sql2);
    $nIntervencion = $alumnoIntervencion2->num_rows;
}








?>


<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: 1fr;
        grid-column-gap: 0px;
        grid-row-gap: 0px;
    }

    .div1 {
        grid-area: 1 / 1 / 6 / 2;
    }

    .div2 {
        grid-area: 1 / 2 / 6 / 3;
    }





    ul.form {
        position: relative;
        background: #fff;
        width: 267px;
        margin: auto;
        padding: 0;
        list-style: none;
        overflow: hidden;

        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;

        -webkit-box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.1);
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.1);
    }

    .form li a {
        width: 225px;
        padding-left: 20px;
        height: 50px;
        line-height: 50px;
        display: block;
        overflow: hidden;
        position: relative;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 14px;
        color: #686868;

        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
    }

    .form li a:hover {
        background: #efefef;
    }

    .form li a.profile {
        border-left: 5px solid #ff2e00;
        width: 100%;
    }

    .form li a.messages {
        border-left: 5px solid #fecf54;
    }

    .form li a.settings {
        border-left: 5px solid #cf2130;
    }

    .form li a.logout {
        border-left: 5px solid #dde2d5;
    }

    .form li:first-child a:hover,
    .form li:first-child a {
        -webkit-border-radius: 5px 5px 0 0;
        -moz-border-radius: 5px 5px 0 0;
        border-radius: 5px 5px 0 0;
    }

    .form li:last-child a:hover,
    .form li:last-child a {
        -webkit-border-radius: 0 0 5px 5px;
        -moz-border-radius: 0 0 5px 5px;
        border-radius: 0 0 5px 5px;
    }

    .form li a:hover i {
        color: #ea4f35;
    }

    .form i {
        margin-right: 15px;

        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
    }

    .form button {
        font-size: 10px;
        background: #eaa728;
        padding: 3px 5px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        font-style: normal;
        color: black;
        margin-top: 12px;
        margin-right: 15px;
        line-height: 10px;
        height: 29px;
        float: right;
    }

    #icono-boton {
        margin-left: 14px;
    }

    .form li.selected a {
        background: #efefef;
        width: 100%;
    }

    #titulo_h1 {
        color: white;
    }

    @media screen and (max-width: 600px) {

        /* reglas de diseño que se aplicarán en general */


        .parent {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(2, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
        }

        .div1 {
            grid-area: 1 / 1 / 2 / 2;
        }

        .div2 {
            grid-area: 2 / 1 / 3 / 2;
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-Kjhk2TvY8MtWg/9F0T/ud0fvNdO8pRH+kbI3N0GJ7YdD8ZWV9K9zOgD7jrk8G8W2Q1m+IuO7LdG8Zn1LZ9FJg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Intervencion Alumno</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 id="titulo_h1"> Intervencion Alumno</h1> .
        </div>

    </nav>
    <div class="container p-4">
        <div class="parent">
            <div class="div1">
                <table class="table table-hover">


                    <?php

                    foreach ($alumnoIntervencion as $IA) {

                    ?>
                        <tbody>
                            <td><?php echo $IA['nombre_alumno']; ?></td>
                            <td>HA LEVANTADO LA MANO <?php
                                                        echo $nIntervencion;
                                                        ?> VECES</td>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="div2">
                <ul class="form">


                    <form action="intervencionAdd.php" method="POST">
                        <input type="hidden" name="codigo_matricula" value="<?php echo $_SESSION['MATRICULA_IA']; ?>">
                        <input type="hidden" name="id_clase" value="<?php echo $id_clase; ?>">
                        <input type="hidden" name="id_curso" value="<?php echo $_SESSION['IDCURSO_IA'] ?>">
                        <input type="hidden" name="id_especialidad" value="<?php echo $_SESSION['ESPECIALIDAD_IA']; ?>">
                        <input type="hidden" name="estado" value="<?php echo $_SESSION['ESTADO_IA']; ?>">

                        <li class=""><a class="profile"><i class="icon-envelope-alt"></i><?php echo $IA['nombre_alumno']; ?> <button name="enviar" type="submit"><i id="icono-boton" class="fa-regular fa-hand fa-2x"></i> </button></a></li>
                    </form>

                </ul>
            </div>
        </div>
    </div>


</body>

</html>


<script>

</script>