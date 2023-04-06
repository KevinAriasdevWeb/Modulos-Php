<?php

include ('conexion.php');
ini_set("display_errors", 1);
error_reporting(E_ALL);

if(isset($_POST["enviar"])){
$id_usuario = $_POST["id_usuario"];
$id_vendedor = $_POST["id_vendedor"];
$codigo_empresa = $_POST["codigo_empresa"];
$time_creacion = $_POST["time_creacion"];
$tipo_cliente = $_POST["tipo_cliente"];
$estado = $_POST["estado"];
$rut = $_POST["rut"];
$razon_social = $_POST["razon_social"];
$nombre_fantasia = $_POST["nombre_fantasia"];
$giro = $_POST["giro"];
$telefono = $_POST["telefono"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$sitio_web = $_POST["sitio_web"];
$direccion = $_POST["direccion"];
$id_comuna = $_POST["id_comuna"];
$ciudad = $_POST["ciudad"];
$region = $_POST["region"];
$contacto = $_POST["contacto"];
$tel_contacto = $_POST["tel_contacto"];
$contacto_cobranza = $_POST["contacto_cobranza"];
$mail_cobranza = $_POST["mail_cobranza"];
$fono_cobranza = $_POST["fono_cobranza"];
$id_comuna_laboral = $_POST["id_comuna_laboral"];
$direccion_laboral = $_POST["direccion_laboral"];
$celular = $_POST["celular"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];


$insertar = "INSERT INTO tbl_clientes_empresas (id_usuario, id_vendedor, codigo_empresa, time_creacion, tipo_cliente, estado, rut,
razon_social, nombre_fantasia, giro, telefono, fax, email, sitio_web, direccion, id_comuna, ciudad, region, contacto,
tel_contacto, contacto_cobranza, mail_cobranza, fono_cobranza, id_comuna_laboral, direccion_laboral, celular, fecha_nacimiento) 
VALUES ('$id_usuario', '$id_vendedor', '$codigo_empresa', '$time_creacion', '$tipo_cliente','$estado', '$rut', '$razon_social', 
'$nombre_fantasia', '$giro', '$telefono', '$fax', '$email',  '$sitio_web', '$direccion','$id_comuna', '$ciudad', '$region',
 '$contacto', '$tel_contacto', '$contacto_cobranza', '$mail_cobranza','$fono_cobranza', '$id_comuna_laboral', '$direccion_laboral',
 '$celular', '$fecha_nacimiento')";

$resultado = mysqli_query($connect, $insertar);
if (!$resultado){
    die('Falla al ingreso de datos');
}else{
    header ("Location: formulariocliente-empresa.php?estado=ok");

}
   


}



?>
