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
   body{
  background-color: #f1f6ff;
}
#news-slider{
    margin-top: 80px;
}
.post-slide{
    background: #fff;
    margin: 20px 15px 20px;
    border-radius: 15px;
    padding-top: 1px;
    box-shadow: 0px 14px 22px -9px #bbcbd8;
}
.post-slide .post-img{
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    margin: -12px 15px 8px 15px;
    margin-left: -10px;
}
.post-slide .post-img img{
    width: 100%;
    height: auto;
    transform: scale(1,1);
    transition:transform 0.2s linear;
}
.post-slide:hover .post-img img{
    transform: scale(1.1,1.1);
}
.post-slide .over-layer{
    width:100%;
    height:100%;
    position: absolute;
    top:0;
    left:0;
    opacity:0;
    background: linear-gradient(-45deg, rgba(6,190,244,0.75) 0%, rgba(45,112,253,0.6) 100%);
    transition:all 0.50s linear;
}
.post-slide:hover .over-layer{
    opacity:1;
    text-decoration:none;
}
.post-slide .over-layer i{
    position: relative;
    top:45%;
    text-align:center;
    display: block;
    color:#fff;
    font-size:25px;
}
.post-slide .post-content{
    background:#fff;
    padding: 2px 20px 40px;
    border-radius: 15px;
}
.post-slide .post-title a{
    font-size:15px;
    font-weight:bold;
    color:#333;
    display: inline-block;
    text-transform:uppercase;
    transition: all 0.3s ease 0s;
}
.post-slide .post-title a:hover{
    text-decoration: none;
    color:#3498db;
}
.post-slide .post-description{
    line-height:24px;
    color:#808080;
    margin-bottom:25px;
}
.post-slide .post-date{
    color:#a9a9a9;
    font-size: 14px;
}
.post-slide .post-date i{
    font-size:20px;
    margin-right:8px;
    color: #CFDACE;
}
.post-slide .read-more{
    padding: 7px 20px;
    float: right;
    font-size: 12px;
    background: #2196F3;
    color: #ffffff;
    box-shadow: 0px 10px 20px -10px #1376c5;
    border-radius: 25px;
    text-transform: uppercase;
}
.post-slide .read-more:hover{
    background: #3498db;
    text-decoration:none;
    color:#fff;
}
.owl-controls .owl-buttons{
    text-align:center;
    margin-top:20px;
}
.owl-controls .owl-buttons .owl-prev{
    background: #fff;
    position: absolute;
    top:-13%;
    left:15px;
    padding: 0 18px 0 15px;
    border-radius: 50px;
    box-shadow: 3px 14px 25px -10px #92b4d0;
    transition: background 0.5s ease 0s;
}
.owl-controls .owl-buttons .owl-next{
    background: #fff;
    position: absolute;
    top:-13%;
    right: 15px;
    padding: 0 15px 0 18px;
    border-radius: 50px;
    box-shadow: -3px 14px 25px -10px #92b4d0;
    transition: background 0.5s ease 0s;
}
.owl-controls .owl-buttons .owl-prev:after,
.owl-controls .owl-buttons .owl-next:after{
    content:"\f104";
    font-family: FontAwesome;
    color: #333;
    font-size:30px;
}
.owl-controls .owl-buttons .owl-next:after{
    content:"\f105";
}
@media only screen and (max-width:1280px) {
    .post-slide .post-content{
        padding: 0px 15px 25px 15px;
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
    <title>Noticias</title>


</head>








<body>
<!-- partial:index.partial.html -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div id="news-slider" class="owl-carousel">
        
      <?php foreach ($noticias as $noticiasDia) { ?>
           
        <div class="post-slide">
          <div class="post-img">
            <img src="https://images.unsplash.com/photo-1596265371388-43edbaadab94?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=301&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=80&w=501" alt="">
            <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
          </div>
          <div class="post-content">
            <h3 class="post-title">
              <a href="#"><?php echo $noticiasDia['titulo']; ?></a>
            </h3>
            <p class="post-description"> <?php echo $noticiasDia['descripcion']; ?></p>
            <span class="post-date"><i class="fa fa-clock-o"></i> <?php echo $noticiasDia['fecha_activacion']; ?></span>
            <a href="#" class="read-more">read more</a>
          </div>
        </div>
        <?php
        }
        ?>
        
        
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script><script  src="./script.js"></script>




</body>

</html>

<script>
$(document).ready(function() {
    $("#news-slider").owlCarousel({
        items : 3,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["",""],
        pagination:true,
        autoPlay:true
    });
});
</script>