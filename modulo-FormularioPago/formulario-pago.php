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
    <title>Formulario de operaciones</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand"> Datos de la operacion</a>
        <ul class="navbar-nav ml-auto">
            <ul class="navbar-nav ml-auto">

            </ul>

    </nav>

    <div class="container p-4 ">

        <div class="row m-0 justify-content-center">
            <div class="col p-5 text-center">
                <div class="card">
                    <div class="card-body">
                        <form id="pago-form">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputOperacion">Tipo Operacion</label>
                                    <input type="text" id="tipo_operacion" placeholder="Ej: Transferencia" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputnomre_empresa">Nombre Empresa</label>
                                    <input type="text" id="nombre_empresa" placeholder="Nombre Empresa" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputrut_empresa">Rut Empresa</label>
                                    <input type="text" id="rut_empresa" placeholder="Rut Empresa" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputfecha_pago">Fecha Pago</label>
                                    <input type="date" id="fecha_pago" placeholder="Fecha pago" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control" id="nombre_banco" required>
                                        <option value="" selected>Seleccione Banco</option>
                                        <option value="BANCO DE CHILE">BANCO DE CHILE</option>
                                        <option value="SCOTIABANK ">SCOTIABANK </option>
                                        <option value="BANCO DE CREDITO E INVERSIONES">BANCO DE CREDITO E INVERSIONES </option>
                                        <option value="BANCO BICE">BANCO BICE</option>
                                        <option value="HSBC BANK">HSBC BANK</option>
                                        <option value="BANCO SANTANDER CHILE">BANCO SANTANDER-CHILE </option>
                                        <option value="ITAÚ CORPBANCA">ITAÚ CORPBANCA </option>
                                        <option value="BANCO SECURITY ">BANCO SECURITY </option>
                                        <option value="BANCO FALABELLA">BANCO FALABELLA </option>
                                        <option value="BANCO RIPLEY">BANCO RIPLEY </option>
                                        <option value="BANCO ESTADO">BANCO ESTADO </option>
                                        <option value="BANCO EDWARDS CITI">BANCO EDWARDS CITI </option>
                                        <option value="BANCO CREDICHILE">BANCO CREDICHILE </option>
                                        <option value="BANCA ETICA LATINOAMERICANA">BANCA ETICA LATINOAMERICANA </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <select id="tipo_cuenta" class="form-control" required>
                                    <option value="" selected>Seleccione tipo de cuenta</option>
                                        <option value="vista">Cuenta vista</option>
                                        <option value="rut">Cuenta Rut</option>
                                        <option value="corriente">Cuenta Corriente</option>
                                        <option value="Chequera Electronica">Chequera Electronica</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputnumero_cuenta">Numero de Cuenta</label>
                                    <input type="text" id="numero_cuenta" placeholder="Numero Cuenta" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputmonto">Monto de pago</label>
                                    <input type="text" id="monto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Monto" class="form-control" required>
                                    <?php $fechaActual = date('Y-m-d'); ?>
                                </div>

                                <input type="hidden" id="fecha_ingreso" value="<?php echo $fechaActual ?>" class="form-control">
                                <div class="form-group col-md-6">
                                <label for="inputid_usario">Usuario</label>
                                    <input type="text" id="id_usuario" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Usuario Creador" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputdescripcion">Ingrese Descripcion</label>
                                    <textarea id="descripcion" class="form-control" placeholder="ingrese una descripcion breve" required>

                                     </textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-block text-center">
                                    Ingresar Operacion
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="pagos.js"> </script>
</body>

</html>