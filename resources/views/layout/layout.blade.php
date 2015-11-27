<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>12KChocho</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/sweetalert.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/estilos.css">
	
</head>
<body>
	<section id="wrapper">
		<nav>
			<section>
				<div class="logo-menu">
					<img src="img/logo.png" alt="Logo principal en menu">
				</div>
				<div class="menu">
					<ul>
						<a href="{{ URL::to('registro') }}" target="_blank">
							<li>REGISTRO</li>
						</a>
						<a href="#descripcion">
							<li>¿POR QUÉ 12K?</li>
						</a>
						<a href="#participantes">
							<li>CORREDORES</li>
						</a>
						<a href="#top5">
							<li>TOP 5</li>
						</a>
						<a href="https://www.facebook.com/CASA-Centro-de-Ayuda-Servicio-y-Apoyo-de-Durango-AC-1630681567175232/" target="_blank">
							<li>C.A.S.A</li>
						</a>
					</ul>
				</div>
				<div class="redes">
					<ul>
						<a href="https://www.facebook.com/12-K-Chocho-623822074376506/?fref=ts" target="_blank">
							<li><i class="fa fa-facebook"></i></li>
						</a>
						<a href="https://twitter.com/CASA_12KChocho" target="_blank">
							<li><i class="fa fa-twitter"></i></li>
						</a>
					</ul>
				</div>
			</section>
			 <article></article>
		</nav>

		@yield('content')

		<footer>
			<div class="direccion">
				<p>Carlos León de la Peña No.509 Zona Centro,Durango,Dgo.</p>
			</div>
			<div class="virtua_logo">
				<img src="img/virtua_logo.png" alt="logo de virtua">
			</div>
		</footer>

	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/app.js"></script>
	<script>
		// Funcion que abrira el registro directo a la opcion de seguir corriendo
		$(".datos_top a").on("click",function(event)
		{
			event.preventDefault();
			
			var nombre_corredor = $(this).parents(".datos_top").find(".nombre-top").text();
			var nombre_id = $(this).parents(".datos_top").find(".nombre-id").val();
			console.log(nombre_id);
			localStorage.setItem("nombre-corredor",nombre_corredor);
			localStorage.setItem("nombre-id",nombre_id);
			var win = window.open("/carrera/public/registro", "Registro");
			win.focus();
			win.addEventListener('load', function(){
			win.seguirle();
			}, true);
		});
		$(".seguir-corriendo").on("click",function()
		{
			var ventana = window.open("/carrera/public/registro", "Registro");
			ventana.focus();
			ventana.addEventListener('load', function(){
			ventana.buscarNombre();
			}, true);
		});

		$(".boton-registro").on("click",function()
		{
			var wind = window.open("/carrera/public/registro", "Registro");
			wind.focus();
			wind.addEventListener('load', function(){
			wind.registrar();
			}, true);
		});
		
		// Obtener clase de mensaje 
		var perfil = localStorage.getItem("perfil");

		$(".checar-perfil").addClass(perfil);

		$(".checar-perfil a").on("click",function()
		{
			localStorage.clear();
			$(this).parents().find(".checar-perfil").removeClass("muestra-perfil");
		})


		$(".checar-perfil span").on("click",function()
		{
			$(this).parents().find(".checar-perfil").removeClass("muestra-perfil");
		})
    </script>
</body>
</html>