<!DOCTYPE html>

<html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	

	



		<?php
include "ParametrosBD.php";


	$conexion = mysqli_connect ($servidor,$usuario,$password) or die
	("No se ha podido conectar con el servidor de Base de datos");
	
	$db = mysqli_select_db($conexion, $basededatos) or die 
	("No se ha podido conectar a la Base de datos");
	
	//recuperar las variables

	$email=$_POST['email'];
	$enunciado=$_POST['enunciado'];
	$respcorrecta=$_POST['respcorrecta'];
	$respincorrecta1=$_POST['respincorrecta1'];
	$respincorrecta2=$_POST['respincorrecta2'];
	$respincorrecta3=$_POST['respincorrecta3'];
	$complejidad=$_POST['complejidad'];
	$tema=$_POST['tema'];
	$dir="img/nofoto.gif";
if ($_POST['imagen']!= "sinimagen"){
			
	$dir="img";

$imagen=$_FILES['imagen']['name'];
$archivo= $_FILES['imagen']['tmp_name'];

	$dir=$dir."/".$imagen;
move_uploaded_file($archivo, $dir);}

$camposcorrectos=true;

$re = '/^[a-z]{3,200}[0-9]{3}@ikasle.ehu+\.eus$/i';
if (!preg_match($re, $email)) { echo 'EL servidor dice: El formato del email es incorrecto'; }
		

else if (strlen($enunciado) < 10) { 

		echo "EL servidor dice: El enunciado tinene que tener al menos 10 caracteres.";
	}
else if($respcorrecta==""){
		 echo "EL servidor dice: La respuesta correcta no puede estar vacia";
}


else if ($respincorrecta1==""||$respincorrecta2==""||$respincorrecta3=="" ){
		echo "Tienes que escribir tres respuestas incorrectas";
	}
	
else  if($tema==""){
		 echo "EL servidor dice: El tema no puede estar vacio";}

else  if ($complejidad==""){

		echo "El servidor dice que la complejidadtiene que ser un valor entre 0 y 5";}
else if( ($complejidad<0)||($complejidad>5)){ 
		echo "El servidor dice que la complejidadtiene que ser un valor entre 0 y 5";

}else {
	//sentencia sql
	$sql="INSERT INTO preguntas VALUES ('clave','$email','$enunciado','$respcorrecta','$respincorrecta1','$respincorrecta2','$respincorrecta3','$complejidad','$tema','<img  width=100px src=".$dir.">')";

	//**************************xml
							
    
$xml = simplexml_load_file('preguntas.xml');
$assessmentItem = $xml->addChild('assessmentItem');
$assessmentItem-> addAttribute('subject',$tema);
$assessmentItem-> addAttribute('author',$email);
$itemBody= $assessmentItem->addChild('itemBody');
$itemBody->addChild('p',$enunciado);
$correctResponse= $assessmentItem->addChild('correctResponse');
$correctResponse->addChild('value',$respcorrecta);
$incorrectResponses= $assessmentItem->addChild('incorrectResponses');

$incorrectResponses->addChild('value',$respincorrecta1);
$incorrectResponses->addChild('value',$respincorrecta2);
$incorrectResponses->addChild('value',$respincorrecta3);
$xml-> asXML('preguntas.xml');
	//**************************xml

	 $ejecutar=mysqli_query($conexion, $sql);
	 	 //verificacion de la ejecucioon

	 if(!$ejecutar){

	  echo"Ha ocurrido un error <br><a href='preguntas.html'>Volver</a>";
	 }
	//  else{ 

	// echo"<html> <br><html>Datos guardados correctamente en el XML Y BD<br>";

	//  } 

	


	 
	 }
	 ?>﻿


</body>
</html>
