<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />


	<style type="text/css">
		
		.entrada{
			width: 500px;
		}
		#complejidad{
			width: 50px;
		}
	</style>		   
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
 <div style="text-align:left;"><strong>DATOS DE LAS PREGUNTAS</strong> </div> <br>
	<fieldset>

<form id="fpreguntas" name="fpreguntas" method="POST" enctype="multipart/form-data" action="InsertarPreguntaConFoto.php?mail=<?php echo $email; ?>" style="background-color: white; text-align: left;">
	
	Email*:<input type="text" name="email" id="email" class="entrada" placeholder="email123@ikasle.ehu.eus" required pattern="[a-z]{3,200}[0-9]{3}@ikasle.ehu+\.eus$" value="<?php echo $email; ?>" readonly><br>
	Enunciado de la pregunta*: <input type="text" name="enunciado" id="enunciado" class="entrada"required minlength="10"><br>
	Respuesta Correcta*: <input type="text" name="respcorrecta" id="respcorrecta" class="entrada"required><br>
	Respuesta Incorrecta*: <input type="text" name="respincorrecta1" id="respincorrecta1" class="entrada"required><br>
	Respuesta Incorrecta*: <input type="text" name="respincorrecta2" id="respincorrecta2" class="entrada"required><br>
	Respuesta Incorrecta*: <input type="text" name="respincorrecta3" id="respincorrecta3" class="entrada"required><br>
	<br>
	<hr>
	<br>
	Complejidad(0..5)*: <input type="number" name="complejidad" id="complejidad" min="0" max="5" class="entrada "required><br>
	Tema(subject)*: <input type="text" name="tema" id="tema" class="entrada"required><br>
	Imagen: <input id="imagen" type="file" name="imagen" onchange="mostrarImagen()"><br> <br>
	
<center>	<img id="argazki" name="imagen"width="200"> </center> <br>
<center> <input type="submit" id="enviar" value="Enviar Solicitud"></center> 
</form>   </fieldset>

	</div>

	

    </section>
		<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>

//mostrar foto

function mostrarImagen(){


				
	 var preview=$("#argazki")[0];
	 var archivo = $("#imagen")[0].files[0];

	 var leer = new FileReader();

	 if(archivo){
	 	leer.readAsDataURL(archivo);
	 	leer.onloadend=function(){
	 		preview.src=leer.result;

	 	};	 }
} 





	</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	$("#logout").click(function() {
		alert("Gracias por jugar a quiz.");
		$(location).attr('href', 'logout.php');
	});
	
	
</script>
			
			

</body>
</html>
