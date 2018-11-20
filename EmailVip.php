<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.


$email=$_GET['mail'];

if (isset($email)){


$soapclient = new nusoap_client ( 'http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl',true);
//Llamamos la función que habíamos implementado en el Web Service.
//e imprimimos lo que nos devuelve
$result = $soapclient->call('comprobar', array('x'=>$email));
if ($result=='SI'){
	echo "1";
}
}
?>

