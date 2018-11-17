 	  	<?php 
  	  	sleep(2);

include "ParametrosBD.php";

		$emailrecibido= $_GET['mail']
?>


<?php 
$xml= simplexml_load_file('preguntas.xml');
$cont=0;
$mispreguntas=0;
foreach ($xml as $preguntas) {

$email = $preguntas['author'];

if ($email== $emailrecibido ){

$mispreguntas++;
}
 $cont++;

}
echo $cont;
echo "/";
echo $mispreguntas;
echo "<html><br></html>";
echo "<html><br></html>";



?>
