<?php
sleep(1);
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.


$clave=$_GET['clave'];

if (isset($clave)){


$soapclient = new nusoap_client ( 'http://localhost/LabServiciosWeb/ObtenerPreguntaSW.php?wsdl',true);
//Llamamos la función que habíamos implementado en el Web Service.
//e imprimimos lo que nos devuelve
$result = $soapclient->call('ObtenerPregunta', array("$clave"=>$clave));
    echo ("Estas son las preguntas con clave:  ".$clave."");

}
?>

<?php
include "ParametrosBD.php";

$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql= "SELECT imagen FROM preguntas WHERE clave='$clave'";
$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){
echo $imprimir['imagen'];
}
?>

 ?>

<center>
<br>
<table border="1"style="background-color: white; text-align: center;">
	<tr>
		<td><strong>EMAIL</strong></td>	
		<td><strong>ENUNCIADO</strong></td>	
		<td><strong>RESPUESTA CORRECTA</strong></td>
		<td><strong>Imagen</strong></td>
	</tr>
<tr>
	<td>&nbsp;&nbsp;<?php echo $result['email'] ?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $result['enunciado'] ?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $result['respcorrecta']?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo "imagen"?>&nbsp;&nbsp;</td>
	
</tr>



</table>


</center>