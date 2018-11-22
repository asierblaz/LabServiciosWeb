<!DOCTYPE html>

<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Inicio</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><input type="button" id="logout" name="logout" value="Logout"></span>
      	<?php 
include "ParametrosBD.php";

		$email= $_GET['mail'];
 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql= "SELECT imagen,nombre FROM usuarios WHERE email='$email'";
$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){

echo $imprimir['nombre'];
?> &nbsp;&nbsp;

<?php
echo $imprimir['imagen'];
}
?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
   
<nav class='main' id='n1' role='navigation'>
	
<?php
				
				echo"
				<span><a href='layout.php?mail=$email'>Inicio</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='preguntas.php?mail=$email'>Insertar Pregunta</a></spam>";
				?>
				<?php
				
				echo"
				<span><a href='VerPreguntasConFoto.php?mail=$email'>Ver Preguntas</a></spam>";
				?>
				<?php
				
				echo"
				<span><a href='VerPreguntasXML.php?mail=$email'>Ver Preguntas XML</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='GestionPreguntas.php?mail=$email'>Gestionar Preguntas</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='ObtenerPregunta.php?mail=$email'>ObtenerPregunta</a></spam>";
				?>
<?php
				
				echo"
				<span><a href='creditos.php?mail=$email'>Creditos</a></spam>";
				?>
				
			
			
	</nav>
    <section class="main" id="s1">
    
	<div>





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
		$dir="img";

	$imagen=$_FILES['imagen']['name'];
	$archivo= $_FILES['imagen']['tmp_name'];

	$dir=$dir."/".$imagen;
	move_uploaded_file($archivo, $dir);

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
	 }else{ 

	 echo"<html> <br><html>Datos guardados correctamente en el XML<br><a href='VerPreguntasXML.php?mail=$email'>Ver las preguntas almacenadas en el XML</a>";
	 echo"<html><br> <br><hrml>Datos guardados correctamente en la bd<br><a href='VerPreguntasConFoto.php?mail=$email'>Ver las preguntas almacenadas en la BD</a>";
	  echo"<html><br> <br><html>¿Quieres insertar otra pregunta? <br><a href='preguntas.php?mail=$email'>Insertar pregunta</a>";


	 } 
	 
	 }
	 ?>﻿

	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	$("#logout").click(function() {
		alert("Gracias por jugar a quiz.");
		$(location).attr('href', 'logout.php');
	});
	
	
</script>
    </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
