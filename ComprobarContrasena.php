<?php 
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soap_server
$ns="http://localhost/nusoap-0.9.5/samples";
$server = new soap_server;
$server->configureWSDL('ComprobarPass',$ns);
$server->wsdl->schemaTargetNamespace=$ns;


$server->register('ComprobarPass',
array('password'=>'xsd:string','ticket'=>'xsd:int' ),
array('resultado'=>'xsd:string'),

$ns);

//implementamos la funcion 

function ComprobarPass ($password,$ticket){
$resultado="";
$encontrado = false;

	if($ticket==1010){
$lineas = file("toppasswords.txt");

foreach ($lineas as $linea) {
	if(strstr($linea, $password)){
		$encontrado=true;
	} 
}
if ($encontrado== true){
	$resultado="INVALIDA";
}
 else { 
	$resultado= "VALIDA";
}
	return $resultado;
}
else {$resultado="SIN SERVICIO" ;
	return $resultado;
}
}

if(!isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>