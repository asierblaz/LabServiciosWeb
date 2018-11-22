<!DOCTYPE html>
<html>
  <head>

<?php  

include "ParametrosBD.php";


  		$conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
?>


</style>
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
<h3>Estas son las preguntas almacenadas en el XML</h3><br>



<center>

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
foreach ($xml as $preguntas) {
$email = $preguntas['author'];
$enunciado =$xml->assessmentItem[$cont]->itemBody->p;

 $respcorrecta=$xml->assessmentItem[$cont]->correctResponse->value;



 ?>
<tr>
	<td>&nbsp;&nbsp;<?php echo $cont+1;?>&nbsp;&nbsp;</td>
	<td><br>&nbsp;&nbsp;<?php echo $email;?>&nbsp;&nbsp;<br></td>
	<td>&nbsp;&nbsp;<?php echo $enunciado; ?>&nbsp;&nbsp;</td>
	<td>&nbsp;&nbsp;<?php echo $respcorrecta; ?>&nbsp;&nbsp;</td>
		
</tr>



 <?php  
 $cont++;
}
?>

</table>




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
