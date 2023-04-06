<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["ingresar_empleado"])){
$estado = $_POST["estado"];
$rut_empleado = $_POST["rut_empleado"];
$nombres = $_POST["nombres"];
$apellido_paterno = $_POST["apellido_paterno"];
$apellido_materno = $_POST["apellido_materno"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$telefono_empleado = $_POST["telefono_empleado"];
$email_empleado = $_POST["email_empleado"];
$direccion_empleado = $_POST["direccion_empleado"];
$id_region = $_POST["id_region"];
$id_ciudad = $_POST["id_ciudad"];
$id_comuna = $_POST["id_comuna"];
$id_cargo = $_POST["id_cargo"];
$sexo = $_POST["sexo"];
$estado_civil = $_POST["estado_civil"];
$nacionalidad_empleado = $_POST["nacionalidad_empleado"];
$sueldo_base = $_POST["sueldo_base"];
$valor_hora = $_POST["valor_hora"];
$monto = $_POST["monto"];
$comision = $_POST["comision"];
$bono_colacion = $_POST["bono_colacion"];
$bono_movilizacion = $_POST["bono_movilizacion"];
$fecha_ingreso = $_POST["fecha_ingreso"];
$hora_entrada = $_POST["hora_entrada"];
$hora_salida = $_POST["hora_salida"];
$tiempo_colacion = $_POST["tiempo_colacion"];
$id_afp = $_POST["id_afp"];
$id_salud = $_POST["id_salud"];
$plan_salud = $_POST["plan_salud"];
$plan_salud2 = $_POST["plan_salud2"];
$apv = $_POST["apv"];
$plan_apv = $_POST["plan_apv"];
$cargas_familiares = $_POST["cargas_familiares"];
$ant_medicos = $_POST["ant_medicos"];
$contacto_urgencia = $_POST["contacto_urgencia"];
$grupo_sanguineo = $_POST["grupo_sanguineo"];


$numero_cuenta = $_POST["numero_cuenta"];
$banco = $_POST["banco"];

//Link Contratos
$contrato = $_FILES["contrato"]["name"];
$archivo1=$_FILES['contrato']['tmp_name'];
$ruta="/var/www/html/test/empleados/link_contratos";
$fecha= date_create();
$fecha= date_timestamp_get($fecha);
$ruta=$ruta."/".$fecha.$contrato_empleado;
$link="http://elc.cl/test/empleados/link_contratos/".$fecha.$contrato_empleado;
move_uploaded_file($archivo1,$ruta);

//Link Certificados
$certificado = $_FILES["certificado"]["name"];
$archivo2=$_FILES['certificado']['tmp_name'];
$ruta2="/var/www/html/test/empleados/link_certificados";
$fecha2= date_create();
$fecha2= date_timestamp_get($fecha2);
$ruta2=$ruta2."/".$fecha2.$certificado_empleado;
$link2="http://elc.cl/test/empleados/link_certificados/".$fecha2.$certificado_empleado;
move_uploaded_file($archivo2,$ruta2);

//Link CV
$cv = $_FILES["cv"]["name"];
$archivo3=$_FILES['cv']['tmp_name'];
$ruta3="/var/www/html/test/empleados/link_cv";
$fecha3= date_create();
$fecha3= date_timestamp_get($fecha3);
$ruta3=$ruta3."/".$fecha3.$cv_empleados;
$link3="http://elc.cl/test/empleados/link_cv/".$fecha3.$cv_empleados;
move_uploaded_file($archivo3,$ruta3);


echo "<pre>";
var_dump($_POST);
echo "</pre>";


$agregarEmpleado = "INSERT INTO tbl_empleados (estado,rut,nombres,paterno,materno,fecha_nacimiento,telefono,email,
direccion,id_region,id_ciudad,id_comuna,id_cargo,sexo,estado_civil,nacionalidad,sueldo_base,valor_hora,monto,comision,
bono_colacion,bono_movilizacion,fecha_ingreso,hora_entrada,hora_salida,tiempo_colacion,id_afp,id_salud,plan_salud,
plan_salud2,apv,plan_apv,cargas_familiares,ant_medicos,contacto_urgencia,grupo_sanguineo,link_contrato,link_cv,
link_certificados,nro_cuenta,banco) 
VALUES ('$estado','$rut_empleado','$nombres','$apellido_paterno','$apellido_materno','$fecha_nacimiento',
'$telefono_empleado','$email_empleado','$direccion_empleado','$id_region','$id_ciudad','$id_comuna','$id_cargo',
'$sexo','$estado_civil','$nacionalidad_empleado','$sueldo_base','$valor_hora','$monto','$comision',
'$bono_colacion','$bono_movilizacion','$fecha_ingreso','$hora_entrada','$hora_salida','$tiempo_colacion','$id_afp',
'$id_salud','$plan_salud','$plan_salud2','$apv','$plan_apv','$cargas_familiares','$ant_medicos',
'$contacto_urgencia','$grupo_sanguineo','$link','$link3','$link2','$numero_cuenta','$banco')";

$result = mysqli_query($connect, $agregarEmpleado);
if (!$result){
    die('Falla al ingreso de datos');
}else{
    header ("Location: empleadosForm.php?estado=ok");

}
   


}
