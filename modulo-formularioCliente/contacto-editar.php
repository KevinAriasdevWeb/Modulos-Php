<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
include('conexion.php');
if (isset($_POST['editar-contacto'])) {

  

    $id_contacto = $_POST['id_contacto'];
    $nombre_encargado = $_POST['nombre_encargado'];
    $rut_encargado = $_POST['rut_encargado'];
    $empresa = $_POST['empresa'];
    $Web = $_POST['Web'];
    $cargo_contacto = $_POST['cargo_contacto'];
    $mail_contacto = $_POST['mail_contacto'];
    $telefono_empresa = $_POST['telefono_empresa'];
    $telefono_encargado = $_POST['telefono_encargado'];
    $giro = $_POST['giro'];
    $razon_social = $_POST['razon_social'];
    $tipo_entrada = $_POST['tipo_entrada'];
    $switch_otic = $_POST['switch_otic'];
    $contacto_otic1 = $_POST['contacto_otic1'];
    $contacto_otic2 = $_POST['contacto_otic2'];
    $contacto_otic3 = $_POST['contacto_otic3'];
    $nombre_otic = $_POST['nombre_otic'];
    $autoriza_option = $_POST['autoriza_option'];
    $curso_interes = $_POST['curso_interes'];
    $cursos_contratados = $_POST['cursos_contratados'];



    $sql = ("UPDATE tbl_contactos SET nombre_encargado='$nombre_encargado', rut_encargado='$rut_encargado',
    empresa='$empresa', web='$Web', cargo='$cargo_contacto', mail='$mail_contacto', telefono_empresa='$telefono_empresa',
    telefono_encargado='$telefono_encargado', giro='$giro', razon_social='$razon_social', tipo_entrada='$tipo_entrada',
    switch_otic='$switch_otic', contacto_otic1='$contacto_otic1', contacto_otic2='$contacto_otic2', contacto_otic3='$contacto_otic3',
    nombre_otic='$nombre_otic', autoriza='$autoriza_option', cursos_interes='$curso_interes', cursos_contratados='$cursos_contratados'
    WHERE id_contacto = '$id_contacto' ");
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Query Failed');
    } else {

        header("Location: contacto-editar.php?contacto=ok");
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Editar Contacto</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Editar Contacto</a>
        <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav ml-auto">
    
            </ul>

    </nav>

    <div class="container p-4 ">

        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">
                       
                            <?php //inicio de 
                            //Consulta SQL para buscador por id y encontrar datos de contacto a editar





//inicio de get recibiendo ID
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                if($id == $id){
                                    $search_id = $id;

                                    $sql = "SELECT * FROM tbl_contactos WHERE id_contacto LIKE '%" . $search_id . "%' ";
                                    $result = mysqli_query($connect, $sql);
                                    if ($result) {
    
                                        while ($fila = $result->fetch_assoc()) {
    
    
                                ?>
                                 <form  action="contacto-editar.php" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputNombre_Encargado">Nombre Encargado</label>
                                                    <input type="text" name="nombre_encargado" value="<?php echo $fila['nombre_encargado']; ?>" placeholder="Nombre Encargado " class="form-control" required>
                                                    <input type="hidden" name="id_contacto" value="<?php echo $fila['id_contacto']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputRut_encargado">Rut Encargado</label>
                                                    <input type="text" name="rut_encargado" value="<?php echo $fila['rut_encargado']; ?>" placeholder="Rut Encargado" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmpresa">Empresa</label>
                                                    <input type="text" name="empresa" value="<?php echo $fila['empresa']; ?>" placeholder="Empresa" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputWeb">Web</label>
                                                    <input type="text" name="Web" value="<?php echo $fila['web']; ?>" placeholder="Pagina Web" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputCargo">Cargo</label>
                                                    <input type="text" name="cargo_contacto" value="<?php echo $fila['cargo']; ?>" placeholder="Cargo" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputMail">Mail</label>
                                                    <input type="text" name="mail_contacto" value="<?php echo $fila['mail']; ?>" placeholder="Email @" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputTelefono_Empresa">Telefono Empresa</label>
                                                    <input type="text" name="telefono_empresa" value="<?php echo $fila['telefono_empresa']; ?>" placeholder="Telefono empresa" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputTelefono_Encargado">Telefono Empresa</label>
                                                    <input type="text" name="telefono_encargado" value="<?php echo $fila['telefono_encargado']; ?>" placeholder="Telefono encargado" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputGiro">Giro</label>
                                                    <input type="text" name="giro" value="<?php echo $fila['giro']; ?>" placeholder="Giro" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputRazon_Social">Razon Social</label>
                                                    <input type="text" name="razon_social" value="<?php echo $fila['razon_social']; ?>" placeholder="Razon Social" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputTipo_Entrada">Tipo Entrada</label>
                                                    <input type="text" name="tipo_entrada" value="<?php echo $fila['tipo_entrada']; ?>" placeholder="Tipo Entrada" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputTipo_Entrada">Seleccione Switch otic</label>
                                                    <select class="form-control" name="switch_otic" value="<?php echo $fila['switch_otic']; ?>" required>
                                                        <option value="1" <?php if ($fila['switch_otic'] == 1) {
                                                                                echo 'selected';
                                                                            } ?>>Si</option>
                                                        <option value="0" <?php if ($fila['switch_otic'] == 0) {
                                                                                echo 'selected';
                                                                            } ?>>No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputContacto_otic1">Contacto Otic1</label>
                                                    <input type="text" name="contacto_otic1" value="<?php echo $fila['contacto_otic1']; ?>" placeholder="Contacto Otic 1" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputContacto_otic2">Contacto Otic2</label>
                                                    <input type="text" name="contacto_otic2" value="<?php echo $fila['contacto_otic2']; ?>" placeholder="Contacto Otic 2" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputContacto_otic3">Contacto Otic3</label>
                                                    <input type="text" name="contacto_otic3" value="<?php echo $fila['contacto_otic3']; ?>" placeholder="Contacto Otic 3" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputNombre_otic">Nombre Otic</label>
                                                    <input type="text" name="nombre_otic" value="<?php echo $fila['nombre_otic']; ?>" placeholder="Nombre Otic" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputAutoriza_option">Seleccione Autoriza</label>
                                                    <select class="form-control" name="autoriza_option" value="<?php echo $fila['autoriza']; ?>" required>
                                                        <option value="1" <?php if ($fila['autoriza'] == 1) {
                                                                                echo 'selected';
                                                                            } ?>>Si</option>
                                                        <option value="0" <?php if ($fila['autoriza'] == 0) {
                                                                                echo 'selected';
                                                                            } ?>>No</option>
    
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputCursos_interes">Cursos Interes</label>
                                                    <input type="text" name="curso_interes" value="<?php echo $fila['cursos_interes']; ?>" placeholder="Cursos Interes" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputCursos_contratados">Cursos Contratados</label>
                                                    <input type="text" name="cursos_contratados" value="<?php echo $fila['cursos_contratados']; ?>" placeholder="Cursos Contratados" class="form-control" required>
                                                </div>
    
                                                <button type="submit" name="editar-contacto" class="btn btn-success btn-block text-center">
                                                    Editar Contacto
                                                </button>
    
                                    <?php
                                            //final del result 1
                                        }
                                    }
                                }
    
                                    ?>
                            </form>

                            <?php
                               
                               
                                }//final de get con ID

                                ?>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <?php
    //mensaje alert que se activa despues de ingresar o registrar una accion
    if (isset($_GET['contacto'])) {
        $contacto = $_GET['contacto'];
        if ($contacto == "ok") {
    ?>
            <script type="text/javascript">
                swal({
                    title: 'Contacto Editado con exito!',
                    icon: 'success',
                    timer: 5000,



                });
                setTimeout( function() { window.location.href = "tablacontacto.php"; }, 4000 );
            </script>

    <?php
        }
    } else {
        $estado = 'null';
    }
    ?>
</body>

</html>