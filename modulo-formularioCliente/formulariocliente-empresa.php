<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);


$sql1= ("SELECT * FROM tbl_comunas ");
$resultado = mysqli_query($connect, $sql1);
if (!$resultado){
    die('Falla al ingreso de datos');
}else{

}

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
    <title>Formulario Cliente-Empresa</title>
</head>
<body>


<?php





?>




<div class="container p-4 ">

<div class="row m-0 justify-content-center">
    <div class="col p-5 text-center">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="insertar.php">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="inputusuario">Usuario</label>
                            <input type="text" name="id_usuario"  onkeypress="return event.charCode >= 48 && event.charCode <= 57"  placeholder="Numero de Usuario (Numeros)" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputvendedor">Vendedor</label>
                            <input type="text" name="id_vendedor" placeholder="Vendedor" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputcodigoempresa"> Codigo Empresa</label>
                            <input type="text" name="codigo_empresa" placeholder="Codigo Empresa (Numeros)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" >
                        </div>
                       <?php $fecha = date_create();
                        $fecha =  date_timestamp_get($fecha);
                         ?>
                         <input type="hidden" name="time_creacion" value="<?php echo $fecha?>" class="form-control" >
                        <div class="form-group col-md-4">
                        <label for="inputtiempocreacion">Tipo Cliente</label>
                           <select name="tipo_cliente" class="form-control">
                           <option value="" selected>Tipo Cliente</option>
                                        <option value="A">A</option>
                           </select>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                                    <select name="estado" class="form-control" >
                                    <option value="" selected>Seleccione Estado</option>
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputrut">Rut</label>
                            <input type="text" name="rut" placeholder="Rut" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputrazonsocial">Razon Social</label>
                            <input type="text" name="razon_social"  placeholder="Razon Social" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputnombrefantasia">Nombre Fantasia</label>
                        <input type="text" name="nombre_fantasia" placeholder="Nombre Fantasia" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputgiro">Giro</label>
                        <input type="text" name="giro"  placeholder="Giro" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputtelefono">Telefono</label>
                        <input type="text" name="telefono"  placeholder="Telefono" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputfax">Fax</label>
                        <input type="text" name="fax"  placeholder="Fax" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputcontacto_otic1">Email</label>
                        <input type="text" name="email"  placeholder="Email" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputSitioweb">Sitio Web</label>
                        <input type="text" name="sitio_web"  placeholder="Sitio Web" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputcontacto_otic3">Direccion</label>
                        <input type="text" name="direccion"   placeholder="Direccion" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="comuna">Comuna</label>
                        <select name="id_comuna" class="form-control">
                              <option value="">Seleccione Comuna</option>
                              <?php
                                  foreach ($resultado as $row){
                                    echo '<option value="' .$row['id_comuna']. '">' . $row['nombre'] .' </option>';
                                  }
                                ?>
                        </select> 
                        </div>
                        <div class="form-group col-md-4">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad"  placeholder="Ciudad" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="region">Region</label>
                        <input type="text" name="region"  placeholder="Region" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="contactos">Contacto</label>
                        <input type="text" name="contacto"  placeholder="Contacto" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="telcontactos">Telefono Contacto</label>
                        <input type="text" name="tel_contacto"  placeholder="Telefono Contacto" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="contactosconbranza">Contacto Cobranza</label>
                        <input type="text" name="contacto_cobranza"  placeholder="Contacto Cobranza" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="mailcobranza">Mail Cobranza</label>
                        <input type="text" name="mail_cobranza"  placeholder="Mail Cobranza" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="fonocobranza">Fono Cobranza</label>
                        <input type="text" name="fono_cobranza"  placeholder="Fono Cobranza" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="comunalaboral">Comuna Laboral</label>
                        <select name="id_comuna" class="form-control">
                              <option value="">Seleccione Comuna</option>
                              <?php
                                  foreach ($resultado as $row){
                                    echo '<option value="' .$row['id_comuna']. '">' . $row['nombre'] .' </option>';
                                  }
                                ?>
                        </select> 
                        </div>
                        <div class="form-group col-md-4">
                        <label for="direccionlaboral">Direccion Laboral</label>
                        <input type="text" name="direccion_laboral"  placeholder="Direccion Laboral" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="celular">Celular</label>
                        <input type="text" name="celular"  placeholder="Celular" class="form-control" >
                        </div>
                        <div class="form-group col-md-4">
                        <label for="FechaNacimiento">Fecha Nacimiento</label>
                        <input type="date" name="fecha_nacimiento"  class="form-control" >
                        </div>
                        <button name="enviar" type="submit" class="btn btn-success btn-block text-center">
                            Ingresar 
                        </button>
                </form>
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
            title:'Datos ingresados correctamente!',
            icon: 'success',
            timer: 5000,
           
    
    
        });
        setTimeout( function() { window.location.href = "cliente-empresa-tabla.php"; }, 1500 );

</script>

<?php
    }
}else{
    $estado = 'null';
}

 ?>
    
</body>
</html>