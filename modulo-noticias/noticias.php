<?php
ini_set('default_charset', 'utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conexion.php");
$fecha = date('Y-m-d');



##CONSULTA NOTICIAS

$sql = "SELECT * FROM tbl_noticias where fecha_activacion <= '$fecha'";
$noticias = mysqli_query($connect, $sql);


?>


<style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lexend+Deca:wght@200;300;400;500;600;700;800&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --Inter: "Inter", sans-serif;
        --Lexend: "Lexend Deca", sans-serif;

        --purple-light: #8257e6;
        --white: #fefbfb;
        --white200: #c4c4c4;
        --gray200: #282830;
        --dark: #13131f;
    }

    html {
        font-size: 62.5%;
        scroll-behavior: smooth;
    }

    body {
        /*background-color: var(--dark);*/
        display: flex;
        align-items: center;
        justify-content: center;
    }

    a {
        text-decoration: none;
    }

    /* SCROLLBAR */
    ::-webkit-scrollbar {
        width: 1rem;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray200);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--purple-light);
    }


    /* ALL IMGS BUTTON */
    .img-btn {
        width: 8rem;
        min-height: 2.5rem;
        position: absolute;
        top: 1rem;
        left: 1rem;
        border: none;
        text-align: center;
        border-radius: 0.3rem;
        color: var(--white);
        font-family: var(--Lexend);
        font-size: 1.4rem;
        background: var(--purple-light);
    }

    /* IMAGE HOVER EFFECT */
    .scroll-img {
        transition: all 0.3s ease;
        filter: brightness(0.6);
    }

    .scroll-img:hover {
        filter: brightness(1);
    }

    /* SCROLL IMAGES CONTAINER */
    .scroll-imgs-container {
        margin-top: 5rem;
        max-height: 60rem;

        display: flex;
        flex-wrap: wrap;
        gap: 1.6rem 0;
        flex: 0 1 700px;
    }

    /* PAIN IMG */
    .scroll-img {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 20rem;
        min-height: 15.1rem;
        background: url("https://i.imgur.com/PGeufpt.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }




    .scroll-img-item {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        position: relative;
        border-style: solid;
    }

    .scroll-img-item:nth-child(5) .img-btn {
        top: 1.6rem;
    }

    .scroll-img-texts {
        display: flex;
        width: 100%;
        height: 100%;
        flex-wrap: wrap;
        flex-direction: column;
        justify-content: space-between;
        padding: 0.5rem 1.5rem 0.5rem 1.5rem;
        align-items: flex-start;
        overflow: auto;
        background: #fff1c9;
    }

    .scroll-img-title {
        color: black;
        font-family: var(--Lexend);
        font-size: 1.3rem;
        line-height: 2rem;
    }

    .scroll-img-text {
        font-family: var(--Inter);
        color: black;
        font-size: 1.1rem;
        line-height: 1.6rem;
        text-align: justify;
        overflow: auto;
        height: 150px;
    }

    .scroll-img-date {
        font-family: var(--Inter);
        font-weight: 600;
        color: black;
        line-height: 2rem;
    }



    .scroll-btn:hover {
        transform: scale(0.9);
    }

    .scroll-btn a {
        font-family: var(--Inter);
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--white);
    }

    /* MEDIAS */
    @media (max-width: 500px) {
        .scroll-imgs-container {
            padding-right: 0.5rem;
            row-gap: 3rem;
        }

        .scroll-img-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .scroll-img {
            max-width: 100%;
        }

        .scroll-img-item:nth-child(5) .img-btn {
            top: 1rem;
        }
    }

    #titulo_noticia {
        font-size: 20px;
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
    <title>Noticias</title>


</head>

<body>
  

  
    <!-- partial:index.partial.html -->
    <div class="scroll-imgs-container">
        <?php foreach ($noticias as $noticiasDia) { ?>
            <div class="scroll-img-item">

                <div class="scroll-img">

                </div>


                <button class="img-btn"><?php echo $noticiasDia['fecha_activacion']; ?></button>

                <div class="scroll-img-texts">

                    <p id="titulo_noticia" class="scroll-img-title"><?php echo $noticiasDia['titulo']; ?></p>
                    <p class="scroll-img-text"><?php echo $noticiasDia['descripcion']; ?></p>

                </div>


            </div>
        <?php
        }
        ?>

    </div>
    <!-- partial -->

</body>

</html>