<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Postulacion</title>
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand"> Buscador Ofertas</a>
    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <form action="postulacion2.php" method="POST" class="form-inline my-2 my-lg-0">
            <select name="campoSeleccionado" class="form-control mr-sm-2" >
                <option selected value="">Seleccione </option>
                <option value="titulo">Titulo Oferta</option>
                <option value="web">Empresa</option>
                <option value="area">Area de curso</option> 
                <option value="fecha_inicio">Fecha inicio</option> 
                <option value="fecha_expiracion">Fecha expiracion</option> 
                <option value="Descripcion">Descripcion de oferta</option>
            </select>
              <input name="search" id="search" value="" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" >
              <button class="btn btn-success my-2 my-sm-0  mr-sm-2" value="" name="buscar" type="submit">
                Search
            </button>
            </form>
        </ul>
    </nav>

    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-13 text-center">
                            
                
<?php
include('database.php');

if(empty(($_POST['search']))){

//Consulta SQL
$sql = "SELECT * FROM tbl_ofertas LIMIT 10, 5";
$result= mysqli_query($connection,$sql);
//var_dump($result);




$salida='';

if($result){
    $paginas=[0];
    $ofertas_paginas = 5;
    $row_cnt = $result->num_rows;
    $paginas = $row_cnt/$ofertas_paginas;
    $paginas = ceil($paginas);
	$paginaActual=$_GET['pagina'];
	$contador=0;

    if(isset($_GET['pagina'])){

        $paginaActual =$_GET['pagina'];

    }else{

        $paginaActual=1;
    }




    $salida.="
       
            
    ";
//Salida de la tabla mostrando datos de la base de datos
    while($fila = $result->fetch_assoc()){
		$contador++;
        $Date = date('Y-m-d');  
        
        if ($contador>=($paginaActual*$ofertas_paginas) && $contador<=($paginaActual*$ofertas_paginas)+$ofertas_paginas)
        {
        $salida.="
        <form action='postulacion-add.php' method='POST' >
    <div id='card_completa' class='card '>
        <div class='card-body  '>
                    <div  id='header_card' class='row align-items-start card-header bg-dark text-white '>
                                <div class='col'> <h5 class='card-title'>".$fila['titulo']."</h5> </div>
                                <div class='col'><p class='text-end '> Fecha Incio ".$fila['fecha_inicio']."</p></div>
                    </div>

                    <div id='body_card' class='row align-items-center card-body text-black'>
                            <div class='col'><p class='text-left'>".$fila['descripcion']."</p></div>
                            <div class='col'>  
                                <button class='btn btn-success my-2 my-sm-0  mr-sm-2 float-right' value='' name='postular' type='submit'>
                                POSTULAR
                                </button>
                                
                            </div>
                    </div>
                    <div id='footer_card'  class='row align-items-end card-footer  bg-dark text-white'>
                        <div class='col'>Oferta hecha por  ".$fila['web']." </div>
                        <div class='col'>Fecha Expiracion ".$fila['fecha_expiracion']."</div>
                        <input type='hidden' name='fecha_postulacion' value = '". $Date ."'>
                        <input type='hidden' name='id_oferta' value = '".$fila['id']."'>
                        <input type='hidden' name='area_oferta' value = '".$fila['area']."'>

                    </div>


         </div>
         
    </div>
    
            
    <br>
    <br>
    <br>

    </form>
     
    ";
	}
    }


    ?>
    <nav aria-label='Page navigation example'>
    <ul class='pagination'>
        <li class='page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>'>
            <a class='page-link' href='postulacion2.php?pagina=<?php echo $paginaActual-1  ?>'  > 
            Anterior
        </a>
        </li>

        <?php  for($i=0;$i<$paginas;$i++){?>
        <li class='page-item <?php echo $_GET['pagina']==$i+1 ? 'active':'' ?>' > 
            <a class='page-link' href='postulacion2.php?pagina=<?php echo $i+1?>'>
                <?php echo $i+1 ?>
            </a>
        </li>
        <?php }?>
      
        <li class='page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>'>
            <a class='page-link' href='postulacion2.php?pagina=<?php echo $paginaActual+1  ?>'>
            Siguiente
        </a>
        </li>
    </ul>
    </nav>
   
 
    <?php


}else{
$salida.="No hay datos:(";

}

echo $salida;

//Mostrar busqueda por filtro
}elseif(isset($_POST['search']) != "" && isset($_POST['campoSeleccionado']) != "" && isset($_POST['buscar']) != ""){


        $search = ($_POST['search']);
        $campoSeleccionado = ($_POST['campoSeleccionado']);
        $sql2 = "SELECT * FROM tbl_ofertas WHERE $campoSeleccionado LIKE '%".$search."%' ";

        $result2= mysqli_query($connection,$sql2);
        //var_dump($result);


        $salida2='';

if($result2){

    $row_cnt = $result2->num_rows;


    $salida2.="   
    ";
//Salida de la tabla mostrando datos de la base de datos
    while($fila2 = $result2->fetch_assoc()){
        $Date = date('Y-m-d');  
        
        
        $salida2.="
        <form action='postulacion-add.php' method='POST' >
    <div class='card'>
        <div class='card-body'>
                    <div class='row align-items-start card-header'>
                                <div class='col'> <h5 class='card-title'>".$fila2['titulo']."</h5> </div>
                                <div class='col'><p class='text-end '> Fecha Incio ".$fila2['fecha_inicio']."</p></div>
                    </div>

                    <div class='row align-items-center card-body'>
                            <div class='col '><p class='text-left'>".$fila2['descripcion']."</p></div>
                            <div class='col'>  
                                <button class='btn btn-success my-2 my-sm-0  mr-sm-2 float-right' value='' name='postular' type='submit'>
                                POSTULAR
                                </button>
                                
                            </div>
                    </div>
                    <div class='row align-items-end card-footer'>
                        <div class='col-auto'>Oferta hecha por  ".$fila2['web']." </div>
                        <div class='col-auto''>Fecha Expiracion ".$fila2['fecha_expiracion']."</div>
                        <input type='hidden' name='fecha_postulacion' value = '". $Date ."'>
                        <input type='hidden' name='id_oferta' value = '".$fila2['id']."'>
                        <input type='hidden' name='area_oferta' value = '".$fila2['area']."'>

                    </div>


         </div>
    </div>
    </form>
        ";

    }
    echo 'Numero de total de registros: ' .$row_cnt;
 
    
}else{
$salida2.="No hay datos:(";

}

echo $salida2;


}


?>


 




            </div>
         </div>
           

 
         
</div>



<style>

#body_card{

background-color:  #f9f1ef ;
}

#footer_card{

background-color:   #e87b64   ;
}

#card_completa{

    

}

#header_card{

    background-color:   #e87b64   ;
}


</style>

<?php
//mensaje alert que se activa despues de ingresar o registrar una accion
if(isset($_GET['estado'])){
    $estado = $_GET['estado'];
    if($estado == "ok"){
    ?>
    <script type="text/javascript">

        swal({
            title:'Postulacion registrada con exito!',
            icon: 'success',
            timer: 5000,
           
    
    
        });
        setTimeout( function() { window.location.href = "postulacion2.php"; }, 5000 );
</script>

<?php
    }
}else{
    $estado = 'null';
}
?>
</body>
</html>
