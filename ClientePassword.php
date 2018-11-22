<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.


$password=$_GET['password'];
$ticket= 1010;

if (isset($password)){


$soapclient = new nusoap_client ( 'http://localhost/LabServiciosWeb/ComprobarContrasena.php?wsdl',true);
//Llamamos la función que habíamos implementado en el Web Service.
//e imprimimos lo que nos devuelve
$result = $soapclient->call('ComprobarPass', array("password"=>$password,"ticket"=>$ticket));
if($result=="VALIDA"){
	echo"1";
}
if($result=="SIN SERVICIO")
echo "2";
}


?>

