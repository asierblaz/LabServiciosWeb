<?php
    require_once('lib/nusoap.php');
    require_once('lib/class.wsdlcache.php');
    //creamos el objeto de tipo soap_server
$ns="http://localhost/nusoap-0.9.5/samples";
    $server = new soap_server;
    $server->configureWSDL('ObtenerPregunta',$ns);
    $server->wsdl->schemaTargetNamespace=$ns;
    $server->wsdl->addComplexType(
    'Pregunta',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'email' => array('name' => 'email', 'type' => 'xsd:string'),
        'enunciado' => array('name' => 'enunciado', 'type' => 'xsd:string'),
        'respcorrecta' => array('name' => 'respcorrecta', 'type' => 'xsd:int')
    )
);
    //registramos la función que vamos a implementar
    $server->register('obtenerPregunta',array('x'=>'xsd:int'),array('z'=>'tns:Pregunta'),$ns);
    //implementamos la función
    function obtenerPregunta($idPregunta){
     $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);

    $consulta= "SELECT email,enunciado,respcorrecta FROM preguntas WHERE clave='$clave'";
        $query = mysqli_query($link,$sql);
        if (mysqli_num_rows($query) == 0){
            return array(
                'enunciado'=>'',
                'correcta'=>'',
                'complejidad'=>0
            );
        }
        else{
           $row = mysqli_fetch_array($query);
           return array(
                'enunciado'=>$row['pregunta'],
                'correcta'=>$row['correcta'],
                'complejidad'=>$row['complejidad']
            );
        }
        
    }
    //llamamos al método service de la clase nusoap
    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( "php://input" );
    $server->service($HTTP_RAW_POST_DATA);
?>