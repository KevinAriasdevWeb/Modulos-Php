<?php
include('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('default_charset', 'utf-8');

if (isset($_POST['codigo_matricula'])) {
    $codigo_matricula = $_POST['codigo_matricula'];
} elseif (isset($_GET['codigo_matricula'])) {
    $codigo_matricula = $_GET['codigo_matricula'];
} else {
    $codigo_matricula = '';
}


##CONSULTA TBL_DIPLOMAS
$sql = "SELECT * FROM tbl_diplomas where codigo_matricula = '$codigo_matricula'";
$ConsultaDiploma = mysqli_query($connect, $sql);
$nConsultaDiploma = $ConsultaDiploma->num_rows;

$estado_diploma = 0;
foreach ($ConsultaDiploma as $estadoDiploma) {
    $fecha = $estadoDiploma['fecha'];
    $fecha2 = $estadoDiploma['fecha2'];
    $cod_matricula = $estadoDiploma['codigo_matricula'];
    $estado_diploma = $estadoDiploma['estado'];
    $curso = $estadoDiploma['id_curso'];
}

?>
<style>
    #titulo_h1 {

        color: white;

    }

    .hh-grayBox {
        background-color: #F8F8F8;
        margin-bottom: 20px;
        padding: 35px;
        margin-top: 20px;
        width: 100%;
        margin-left: 100px;
    }

    .pt45 {
        padding-top: 45px;
    }

    .order-tracking {
        text-align: center;
        width: 20%;
        position: relative;
        display: block;
    }

    .order-tracking .is-complete {
        display: block;
        position: relative;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        border: 0px solid #AFAFAF;
        background-color: #f7be16;
        margin: 0 auto;
        transition: background 0.25s linear;
        -webkit-transition: background 0.25s linear;
        z-index: 2;
    }

    .order-tracking .is-complete:after {
        display: block;
        position: absolute;
        content: '';
        height: 14px;
        width: 7px;
        top: -2px;
        bottom: 0;
        left: 5px;
        margin: auto 0;
        border: 0px solid #AFAFAF;
        border-width: 0px 2px 2px 0;
        transform: rotate(45deg);
        opacity: 0;
    }

    .order-tracking.completed .is-complete {
        border-color: #27aa80;
        border-width: 0px;
        background-color: #27aa80;
    }

    .order-tracking.completed .is-complete:after {
        border-color: #fff;
        border-width: 0px 3px 3px 0;
        width: 7px;
        left: 11px;
        opacity: 1;
    }

    .order-tracking p {
        color: #A4A4A4;
        font-size: 16px;
        margin-top: 8px;
        margin-bottom: 0;
        line-height: 20px;
    }

    .order-tracking p span {
        font-size: 14px;
    }

    .order-tracking.completed p {
        color: #000;
    }

    .order-tracking::before {
        content: '';
        display: block;
        height: 3px;
        width: calc(100% - 40px);
        background-color: #f7be16;
        top: 13px;
        position: absolute;
        left: calc(-50% + 20px);
        z-index: 0;
    }

    .order-tracking:first-child:before {
        display: none;
    }

    .order-tracking.completed:before {
        background-color: #27aa80;
    }



    .flex-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: white;
        animation: colorSlide 15s cubic-bezier(0.075, 0.82, 0.165, 1) infinite;
    }

    .flex-container .text-center {
        text-align: center;
    }

    .flex-container .text-center h1,
    .flex-container .text-center h3 {
        margin: 10px;
        cursor: default;
    }

    .flex-container .text-center h1 .fade-in,
    .flex-container .text-center h3 .fade-in {
        animation: fadeIn 2s ease infinite;
    }

    .flex-container .text-center h1 {
        font-size: 8em;
        transition: font-size 200ms ease-in-out;
        border-bottom: 1px dashed white;
    }

    .flex-container .text-center h1 span#digit1 {
        animation-delay: 200ms;
    }

    .flex-container .text-center h1 span#digit2 {
        animation-delay: 300ms;
    }

    .flex-container .text-center h1 span#digit3 {
        animation-delay: 400ms;
    }

    .flex-container .text-center button {
        border: 1px solid white;
        background: transparent;
        outline: none;
        padding: 10px 20px;
        font-size: 1.1rem;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
        transition: background-color 200ms ease-in;
        margin: 20px 0;
    }

    .flex-container .text-center button:hover {
        background-color: white;
        color: #555;
        cursor: pointer;
    }

    @keyframes colorSlide {
        0% {
            background-color: #152a68;
        }

        25% {
            background-color: royalblue;
        }

        50% {
            background-color: seagreen;
        }

        75% {
            background-color: tomato;
        }

        100% {
            background-color: #152a68;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seguimiento Diplomas</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <?php  if ($nConsultaDiploma > 0) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 id="titulo_h1" class="text-center">SEGUIMIENTO DIPLOMAS </h1>.
        </div>

    </nav>
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 hh-grayBox pt45 pb20">
                <div class="row justify-content-between">
                    <?php
                   

                        if ($estado_diploma == 1) { ?>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Solicitud Creada<br><span><?php echo $fecha; ?></span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Impreso<br><span>Pendiente</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Enviado A Notaria<br><span>Pendiente</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Disponible para retiro<br><span>Pendiente</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Entregado<br><span>Pendiente</span></p>
                            </div>
                        <?php } ?>

                        <?php if ($estado_diploma == 2) { ?>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Solicitud Creada<br><span><?php echo $fecha; ?></span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Impreso<br><span>Listo</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Enviado A Notaria<br><span>Pendiente</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Disponible para retiro<br><span>Pendiente</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Entregado<br><span>Pendiente</span></p>
                            </div>
                        <?php } ?>

                        <?php if ($estado_diploma == 3) { ?>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Solicitud Creada<br><span><?php echo $fecha; ?></span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Impreso<br><span>Listo</span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Enviado A Notaria<br><span>Listo</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Disponible para retiro<br><span>Pendiente</span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Entregado<br><span>Pendiente</span></p>
                            </div>
                        <?php } ?>

                        <?php if ($estado_diploma == 4) { ?>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Solicitud Creada<br><span><?php echo $fecha; ?></span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Impreso<br><span></span>Listo</p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Enviado A Notaria<br><span>Listo</span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Disponible para retiro<br>Listo<span></span></p>
                            </div>
                            <div class="order-tracking">
                                <span class="is-complete"></span>
                                <p>Entregado<br><span>Pendiente</span></p>
                            </div>
                        <?php } ?>

                        <?php if ($estado_diploma == 5) { ?>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Solicitud Creada<br><span><?php echo $fecha; ?></span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Impreso<br><span></span>Listo</p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Enviado A Notaria<br><span>Listo</span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Disponible para retiro<br><span>Listo</span></p>
                            </div>
                            <div class="order-tracking completed">
                                <span class="is-complete"></span>
                                <p>Entregado<br><span> <?php echo $fecha2; ?></span></p>
                            </div>
                        <?php } ?>


                </div>
            </div>
        </div>
    </div>
    <!-- partial -->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
</body>

</html>

<?php

                    } else {
?>

    <div class="flex-container">
        <div class="text-center">
            <!-- <h1>
                <span class="fade-in" id="digit1">4</span>
                <span class="fade-in" id="digit2">0</span>
                <span class="fade-in" id="digit3">4</span>
                
            </h1>
             -->
            <h3 class="fadeIn">NO EXISTE DIPLOMA PARA ESTE ALUMNO</h3>

        </div>
    </div>

<?php
                    }
?>