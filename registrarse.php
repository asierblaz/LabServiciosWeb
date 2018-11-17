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
		<span class="right"><a href="registrarse.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
	</nav>


    <section class="main" id="s1">

	<div>
 <div style="text-align:left;"><strong>FORMULARIO DE REGISTRO</strong> </div> <br>
	<fieldset>

<form id="registro" name="registro" method="POST" enctype="multipart/form-data" action="registrarse.php" style="background-color: white; text-align: left;">
	Email*:<input type="text" name="email" id="email" class="entrada" placeholder="email123@ikasle.ehu.eus" required pattern="[a-z]{3,200}[0-9]{3}@ikasle.ehu+\.eus$"><br>
	Nombre y Apellidos*: <input type="text" name="nombre" id="nombre" class="entrada"required><br>
	Contraseña*: <input type="password" name="password" minlength="8"id="password" class="entrada"required><br>
	Repita su contraseña: <input type="password" name="repassword" minlength="8" id="repassword" class="entrada"required><br>
	
	<br>
	
	
	Foto de perfil: <input id="imagen" type="file" name="imagen" onchange="mostrarImagen()"><br> <br>
	
<center>	<img id="argazki" name="imagen"width="100" height="100"> </center> <br>
<center> <input type="submit" id="enviar" value="Registrarse"></center> 
</form>   </fieldset>



<?php
if (isset($_POST['email'])){
include "ParametrosBD.php";

	$conexion = mysqli_connect ($servidor,$usuario,$password) or die
	("No se ha podido conectar con el servidor de Base de datos");
	
	$db = mysqli_select_db($conexion, $basededatos) or die 
	("No se ha podido conectar a la Base de datos");
	
	//recuperar las variables
	$email=$_POST['email'];
	$nombre=$_POST['nombre'];
	$password=$_POST['password'];
	
	
		$dir="img";

	$imagen=$_FILES['imagen']['name'];
	$archivo= $_FILES['imagen']['tmp_name'];

	$dir=$dir."/".$imagen;
	move_uploaded_file($archivo, $dir);






	//sentencia sql
	
	$sql="INSERT INTO usuarios VALUES ('$email','$nombre','$password','<img  width=100px src=".$dir.">')";




	 $ejecutar=mysqli_query($conexion, $sql);
	
	 //verificacion de la ejecucioon

	 if(!$ejecutar){

						echo '<script type="text/javascript">alert("Ha ocurrido un error, puede que los datos no sean correctos");</script>';

	 }else{ 
	 echo"Registro realizado correctamente <br><a href='login.php'>¿Quieres iniciar sesion? </a>";

	 } 
	 
	 }
	 ?>﻿

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
	$("#registro").submit(function(){


var expresionnombre = new RegExp(/\w+\s+\w+/)

	if(expresionnombre.test($("#nombre").val())==false){
			alert("Tienes que escribir al menos un Nombre y un Apellido");
			return false;
		}

	if($("#password").val()!=$("#repassword").val()){
				
				alert("Las contraseñas tienen que ser iguales.");
				return false;
			}
})




	</script>

			
			

</body>
</html>
