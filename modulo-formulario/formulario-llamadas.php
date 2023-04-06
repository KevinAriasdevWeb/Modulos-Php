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
    
    <title>Registro Llamadas</title>
</head>
<body >


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand">Registro Llamadas</a>
    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
           
    </ul>
        
    </nav>
    

<div class="container p-5 ">

<div class="row">
    <div class="col-md-6 text-center">
       <div class="card">
        <div class="card-body">
            <form id="llamadas-form" action="registroLlamadas.php" method="POST">
                <div class="form-group">
                    <br>
                    <label >Llamada de registro</label><br>
                    <input type="text" id="llamada_registro" name="llamada_registro" placeholder="Ingrese tiempo de llamada Ej: 5 min" class="form-control" required>
                    <label >Preguntas FeedBack</label>
                    <br><input type="text" id="npreguntas_registro" name="npreguntas_registro"  placeholder="Ingrese numero de preguntas (FeedBack) " class="form-control" required>
                    <br>
                    <input type="date" class="form-control" name="fecha_registro" id="fecha_reg" maxlength="100" required=""><br>
                    <br>
                    <label class="text-danger">Entusiasmo Percibido</label><br>
                    <input type="radio" class="btn-check" name="options_entusiasmo" id="option2" autocomplete="off" value="Poco" required>
                    <label class="btn btn-secondary" for="option2">Poco</label>
                    <input type="radio" class="btn-check" name="options_entusiasmo" id="option3" autocomplete="off" value="Medio">
                    <label class="btn btn-secondary" for="option3">Medio</label>
                    <input type="radio" class="btn-check" name="options_entusiasmo" id="option4" autocomplete="off" value="Demasiado">
                    <label class="btn btn-secondary" for="option4">Demasiado</label>
              
                    <br><label class="text-danger">Actitud Percibido  </label><br>
                    <input type="radio" class="btn-check" name="options_actitud" id="option5" autocomplete="off" value="Negativa" required>
                    <label class="btn btn-secondary" for="option5">Negativa</label> 
                    <input type="radio" class="btn-check" name="options_actitud" id="option6" autocomplete="off" value="Neutro" >
                    <label class="btn btn-secondary" for="option6">Neutro</label>
                    <input type="radio" class="btn-check" name="options_actitud" id="option7" autocomplete="off" value="Positiva">
                    <label class="btn btn-secondary " for="option7">Positiva</label>
                 
                    <br><label class="text-danger">Cuenta su experiencia de vida  </label><br>
                    <input type="radio" class="btn-check" name="options_experiencia" id="option8" autocomplete="off" value="No" required>
                    <label class="btn btn-secondary" for="option8">No</label>
                    <input type="radio" class="btn-check" name="options_experiencia" id="option9" autocomplete="off" value="Comenta Poco">
                    <label class="btn btn-secondary" for="option9">Comenta Poco</label>
                    <input type="radio" class="btn-check" name="options_experiencia" id="option10" autocomplete="off" value="Explica">
                    <label class="btn btn-secondary " for="option10">Explica</label>
                    
                    <br><label class="text-danger">Percepcion de la propuesta de valor  </label><br>
                    <input type="radio" class="btn-check" name="options_propuesta" id="option11" autocomplete="off" value="Negativa" required>
                    <label class="btn btn-secondary" for="option11">Negativa</label>
                    <input type="radio" class="btn-check" name="options_propuesta" id="option12" autocomplete="off" value="Neutra">
                    <label class="btn btn-secondary" for="option12">Neutra</label>
                    <input type="radio" class="btn-check" name="options_propuesta" id="option13" autocomplete="off" value="Positiva">
                    <label class="btn btn-secondary " for="option13">Positiva</label>
                    
                    <br><label class="text-danger">Percepcion del costo</label><br>
                    <input type="radio" class="btn-check" name="options_propuesta_costo" id="option14" autocomplete="off" value="Negativa" required>
                    <label class="btn btn-secondary" for="option14">Negativa</label>
                    <input type="radio" class="btn-check" name="options_propuesta_costo" id="option15" autocomplete="off" value="Neutra" >
                    <label class="btn btn-secondary" for="option15">Neutra</label>
                    <input type="radio" class="btn-check" name="options_propuesta_costo" id="option16" autocomplete="off" value="Positiva">
                    <label class="btn btn-secondary " for="option16">Positiva</label>
                
                    <br><label class="text-danger">Intencion de matricula</label><br>
                    <input type="radio" class="btn-check" name="options_matricula" id="option17" autocomplete="off" value="No" required>
                    <label class="btn btn-secondary" for="option17">No</label>
                    <input type="radio" class="btn-check" name="options_matricula" id="option18" autocomplete="off" value="Pregunta">
                    <label class="btn btn-secondary" for="option18">Pregunta</label>
                    <input type="radio" class="btn-check" name="options_matricula" id="option19" autocomplete="off" value="Propone">
                    <label class="btn btn-secondary " for="option19">Propone</label>
                    <br>
                    <label >Id Seguimiento</label>
                    <br><input type="text" id="id_seguimiento_registro" name="id_seguimiento_registro"  placeholder="Ingrese numero de seguimiento " class="form-control" required>
                    <br>
                
                
                </div>
                
                <button type="submit" class="btn btn-primary btn-block text-center" name="enviar">
                    Registrar Llamada
                </button>
                
            </form>
        </div>
       </div>
    </div>
    
</div>

</div>

<?php


if(isset($_GET['estado'])){
    $estado = $_GET['estado'];
    if($estado == "ok"){
    ?>
    <script type="text/javascript">

        swal({
            title:'Llamada registrada con exito!',
            icon: 'success'
            
    
    
        });
    
</script>

<?php
    }
}else{
    $estado = 'null';
}
?>
</body>
</html>