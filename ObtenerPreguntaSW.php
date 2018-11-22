<?php 
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');

//creamos el objeto de tipo soap_server
$ns="http://localhost/nusoap-0.9.5/samples";
$server = new soap_server;
$server->configureWSDL('ObtenerPregunta',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

//creamos un array para imprimir los datos

$server->wsdl->addComplexType(  'PreguntaObtenida', 
                                'complexType', 
                                'struct', 
                                'all', 
                                '',
                                array('email'              => array('name' => 'email','type' => 'xsd:string'),'imagen'              => array('name' => 'imagen','type' => 'xsd:string'),
                                      'enunciado'              => array('name' => 'enunciado','type' => 'xsd:string'),
                                      'respcorrecta'     => array('name' => 'respcorrecta','type' => 'xsd:string'))
);
// Parametros de Salida
$server->register('ObtenerPregunta',
array('clave'=>'xsd:int' ),
 array('resultado' => 'tns:PreguntaObtenida'),

$ns);

//implementamos la funcion 





function ObtenerPregunta ($clave){
	include "ParametrosBD.php";

	$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$consulta= "SELECT email,imagen,enunciado,respcorrecta FROM preguntas WHERE clave='$clave'";
$resultado=mysqli_query($conexion,$consulta);

$fila= mysqli_num_rows($resultado);

if($fila==0){
return array(
                'email'=>"",
                'imagen'=>"",
                'enunciado'=>"",
                'respcorrecta'=>""
            );
} else{

	$imprimir= mysqli_fetch_array($resultado);
	return array(
                'email'=>$imprimir['email'],
                'imagen'=>$imprimir['imagen'],
                'enunciado'=>$imprimir['enunciado'],
                'respcorrecta'=>$imprimir['respcorrecta']
            );
}


}

if(!isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>