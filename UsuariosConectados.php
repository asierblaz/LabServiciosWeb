	  	<?php 
  	  

include "ParametrosBD.php";

		$emailrecibido= $_GET['mail']
?>


<?php 
$xml= simplexml_load_file('contador.xml');
	echo $xml->value;

?>
