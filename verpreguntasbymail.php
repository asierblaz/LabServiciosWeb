<!DOCTYPE html>
<html>



  <head>


  	  	<?php 
  	  
sleep(2);
include "ParametrosBD.php";

		$emailrecibido= $_GET['mail']
?>

<table border="1"style="background-color: white; text-align: center;">
	<tr>
		<td><strong>Nº</strong></td>
		<td><strong>EMAIL</strong></td>	
		<td><strong>ENUNCIADO</strong></td>	
		<td><strong>RESPUESTA CORRECTA</strong></td>
	</tr>


<?php 
$xml= simplexml_load_file('preguntas.xml');
$cont=0;
$mispreguntas=0;

echo "Estas son las preguntas guardadas por<html>&nbsp;</html>";
	echo $emailrecibido;
	echo "<html><br><br></html>";

foreach ($xml as $preguntas) {
$email = $preguntas['author'];
$enunciado =$xml->assessmentItem[$cont]->itemBody->p;
$respcorrecta=$xml->assessmentItem[$cont]->correctResponse->value;
if($email==$emailrecibido){
$mispreguntas++;
}

 ?>
<tr>

<?php if($email==$emailrecibido){ ?>	<td><br>&nbsp;&nbsp;<?php echo $mispreguntas;?>&nbsp;&nbsp;<br></td> <?php } ?>
<?php if($email==$emailrecibido){ ?>	<td><br>&nbsp;&nbsp;<?php echo $email;?>&nbsp;&nbsp;<br></td> <?php } ?>
<?php if($email==$emailrecibido){ ?>	<td>&nbsp;&nbsp;<?php echo $enunciado; ?>&nbsp;&nbsp;</td> <?php } ?>
<?php   if($email==$emailrecibido){ ?>	<td>&nbsp;&nbsp;<?php echo $respcorrecta; ?>&nbsp;&nbsp;</td><?php } ?>
		
</tr>



 <?php  
 $cont++;
}
?>
</table>
</html>
