<?php
ini_set("display_errors", 1);
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

<?php

	if(isset($_POST['campoSeleccionado'])){
		$campoBusqueda=$_POST['campoSeleccionado'];
	}elseif(isset($_GET['campoSeleccionado'])){
		$campoBusqueda=$_GET['campoSeleccionado'];
	}	else{$campoBusqueda=null;}
	
	if(isset($_POST['search'])){
		$patronBusqueda=$_POST['search'];
	}elseif(isset($_GET['search'])){
		$patronBusqueda=$_GET['search'];
	}	else{$patronBusqueda=null;}
	

	$campos[]=array('titulo'=>'Empresa','valor'=>'web');
	$campos[]=array('titulo'=>'Area de Curso','valor'=>'area');
	$campos[]=array('titulo'=>'Fecha inicio','valor'=>'fecha_inicio');
	$campos[]=array('titulo'=>'Fecha_expiracion','valor'=>'fecha_expiracion');
	$campos[]=array('titulo'=>'Descripcion','valor'=>'Descripcion');				
?>
 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand"> Buscador Ofertas</a>
        <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav ml-auto">
                <form action="postulacion3.php" method="POST" class="form-inline my-2 my-lg-0">
                    <select name="campoSeleccionado" class="form-control mr-sm-2" required='required'>
                        <option value="">Seleccione </option>
					<?php
						foreach($campos as $campo)
						{
							echo "
							<option value='".$campo['valor']."' ";
							
							if($campoBusqueda==$campo['valor'])
							{
								echo " selected='selected' ";
							}
							
							echo ">".$campo['titulo']."</option>";
							
						}
					
					
					?>



                    </select>
                    <input name="search" id="search" value='<?php echo $patronBusqueda; ?>' class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required='required'>
                    <button class="btn btn-success my-2 my-sm-0  mr-sm-2" value="" name="buscar" type="submit">
                        Search
                    </button>
                    <button class="btn btn-success my-2 my-sm-0  mr-sm-2" value="" name="mostrar_todo" type="button" onclick='window.location.href="postulacion3.php"'>
                        Mostrar Todo
                    </button>
                </form>
            </ul>
    </nav>

    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-13 text-center">


                <?php
                include('database.php');


                
                
                
                #if(isset($_POST['search']) != "" && isset($_POST['campoSeleccionado']) != "" && isset($_POST['buscar']) != "" ) {
				#if(!is_null($campoBusqueda) && !is_null($patronBusqueda)) 
				{
                    $paginaActual2 = $_GET['pagina_busqueda'];
                    #$search = ($_POST['search']);
                    #$campoSeleccionado = ($_POST['campoSeleccionado']);
					
					
					
					if(!is_null($campoBusqueda) && !is_null($patronBusqueda)){
                    $sql2 = "SELECT * FROM tbl_ofertas WHERE $campoBusqueda LIKE '%" . $patronBusqueda . "%' ";
                    $filtro="campoSeleccionado=$campoBusqueda&search=$patronBusqueda&";
					}
					else{
					 $sql2 = "SELECT * FROM tbl_ofertas";	
					 $filtro="";
					}

                    $result2 = mysqli_query($connection, $sql2);
                    //var_dump($result);
                    
                 
                    $salida2 = '';

                    if ($result2) {
                        $paginas2=[0];
                        $ofertas_paginas2 = 4;
                        $row_cnt2 = $result2->num_rows;
                        $paginas2 = $row_cnt2 / $ofertas_paginas2;
                        $paginas2 = ceil($paginas2);
                        if(isset($_GET['pagina_busqueda']))
							{
							$paginaActual2 = $_GET['pagina_busqueda'];}
							else{$paginaActual2 = 1;}
                        $contador2 = 0;

                     



                        $salida2 .= "   
    ";
                        //Salida de la tabla mostrando datos de la base de datos
                        
                        while ($fila2 = $result2->fetch_assoc()) {
                            $Date = date('Y-m-d');
                            
                          
                            if ($contador2 >= ($paginaActual2 * $ofertas_paginas2) && $contador2 <= ($paginaActual2 * $ofertas_paginas2) + $ofertas_paginas2) {
                                
                                $salida2 .= "
                                <form action='postulacion-add.php' method='POST' >
                                <div id='card_completa' class='card '>
                                    <div class='card-body  '>
                                                <div  id='header_card' class='row align-items-start card-header bg-dark text-white '>
                                                            <div class='col'> <h5 class='card-title'>" . $fila2['titulo'] . "</h5> </div>
                                                            <div class='col'><p class='text-end '> Fecha Incio " . $fila2['fecha_inicio'] . "</p></div>
                                                </div>

                                                <div id='body_card' class='row align-items-center card-body text-black'>
                                                        <div class='col'><p class='text-left'>" . $fila2['descripcion'] . "</p></div>
                                                        <div class='col'>  
                                                            <button class='btn btn-success my-2 my-sm-0  mr-sm-2 float-right' value='' name='postular' type='submit'>
                                                            POSTULAR
                                                            </button>
                                                            
                                                        </div>
                                                </div>
                                                <div id='footer_card'  class='row align-items-end card-footer  '>
                                                    <div class='col'>Oferta hecha por  " . $fila2['web'] . " </div>
                                                    <div class='col'>Fecha Expiracion " . $fila2['fecha_expiracion'] . "</div>
                                                    <input type='hidden' name='fecha_postulacion' value = '" . $Date . "'>
                                                    <input type='hidden' name='id_oferta' value = '" . $fila2['id'] . "'>
                                                    <input type='hidden' name='area_oferta' value = '" . $fila2['area'] . "'>

                                                </div>


                                    </div>
                                    
                                </div>
    
                                        
                                <br>
                                <br>
                                <br>

                                </form>
                                
                                ";

                                
                            }
                              $contador2++;
                    }
                    } 
                    
                    echo 'Numero de total de registros: ' . $row_cnt2;
                    echo $salida2;
                    //Paginacion con filtro no funciona bien no se mantiene cuando muestra los resultados
                        ?>
    
                        <nav aria-label='Page navigation example'>
                            <ul class='pagination'>
                                <li class='page-item <?php echo $_GET['pagina_busqueda'] <= 1 ? 'disabled' : '' ?>'>
                                    <a class='page-link' href='postulacion3.php?<?php echo $filtro;?>pagina_busqueda=<?php echo $paginaActual2 - 1  ?>'>
                                        Anterior
                                    </a>
                                </li>
                               
                                <?php for ($i = 0; $i < $paginas2; $i++) { ?>
                                    <li class='page-item <?php echo $_GET['pagina_busqueda'] == $i + 1 ? 'active' : '' ?>'>
                                        <a class='page-link' href='postulacion3.php?<?php echo $filtro;?>pagina_busqueda=<?php echo $i + 1 ?>'>
                                            <?php echo $i + 1 ?>
                                        </a>
                                    </li>
                                <?php } ?>
    
                                <li class='page-item <?php echo $_GET['pagina_busqueda'] >= $paginas2 ? 'disabled' : '' ?>'>
                                    <a class='page-link' href='postulacion3.php?<?php echo $filtro;?>pagina_busqueda=<?php echo $paginaActual2 + 1  ?>'>
                                        Siguiente
                                    </a>
                                </li>
                            </ul>
                        </nav>
    
                                    
    
                        <?php
              
                }
            

                    
                ?>



            </div>
        </div>




    </div>



    <style>
        #body_card {

            background-color: #f9f1ef;
        }

        #footer_card {

            background-color: #e87b64;
        }

        #card_completa {}

        #header_card {

            background-color: #e87b64;
        }
    </style>

    <?php
    //mensaje alert que se activa despues de ingresar o registrar una accion
    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        if ($estado == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Postulacion registrada con exito!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout(function() {
                    window.location.href = "postulacion3.php";
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
