<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>12KChocho</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/sweetalert.css">
	<link rel="stylesheet" href="css/estilos.css">
	
	<script>
	 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	 ga('create', 'UA-70983709-1', 'auto');
	 ga('send', 'pageview');
</script>
</head>
<body>
	<section id="wrapper">
		<nav>
			<section>
				<a href="{{ URL::to('/') }}">
					<div class="logo-menu">
						<img src="img/logo.png" alt="Logo principal en menu">
					</div>
				</a>
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
						<a href="{{ URL::to('casa') }}">
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
		$(document).on("click",".datos_top a",function(event)
		{
			event.preventDefault();
			
			var nombre_corredor = $(this).parents(".datos_top").find(".nombre-top").text();
			var nombre_id = $(this).parents(".datos_top").find(".nombre-id").val();
			console.log(nombre_id);
			localStorage.setItem("nombre-corredor",nombre_corredor);
			localStorage.setItem("nombre-id",nombre_id);
			var win = window.open("registro", "Registro");
			win.focus();
			win.addEventListener('load', function(){
			win.seguirle();
			}, true);
		});
		// $(".seguir-corriendo").on("click",function()
		// {
		// 	var ventana = window.open("/carrera/public/registro", "Registro");
		// 	ventana.focus();
		// 	ventana.addEventListener('load', function(){
		// 	ventana.buscarNombre();
		// 	}, true);
		// });

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
			localStorage.clear();
			$(this).parents().find(".checar-perfil").removeClass("muestra-perfil");
		})


		// AJAX para traer con el paginador a los corredores

		var pagina = 1;
		$(document).on("click","#ver-part",function()
		{
			pagina++;		

					$.ajax({
					type:'GET',
					url: '?page='+ pagina,
					url: 'corredores?page='+ pagina,
					dataType: 'json'
				}).done(function(data){
					$.each(data, function(ind, v)
					{
						var nombre;
							// console.log(v.nombre);
							// console.log(v.distancia);
							// console.log(data.data);
							if(v.tipo=='persona') nombre = v.nombre+' '+v.apellidos;
							else nombre = v.nombre;
							var contenedor = 
							"<section class='cont-part'>"+
							"<div class='div_top'>"+
							"<figure class='liston_rojo'>"+
							"<img src='img/liston_rojo.png' alt='imagen de liston rojo'>"+
							"</figure>"+
							"<figure class='cont_part'>"+
							"<img src='"+v.imagen+"' />"+
							"</figure>"+
							"</div>"+
							"<div class='div_top datos_top'>"+
							"<h3 class='dist-recorrida'> "+v.distancia+"m</h3>"+
							"<input type='hidden' class='nombre-id' value='"+v.id+"'>"+
							"<h3 class='nombre-top'>"+nombre+"</h3>"+
							"<a href='' target?>¡Sigue corriendo!</a>"+
							"</div>"+
							"</section>";
							// console.log(contenedor);
							$(contenedor).insertBefore(".after");	
						});
			}).error(function (data) {
				console.log(data);
			}); 	
		})

		// Correo para corredores virtuales
		$(document).on("click","#enviar-corredor",function()
		{
			validar = true;
			var boletos = $(".num-boletos").val();
			var num_boleto = parseInt(boletos);
			
			if(!$("#form-virtual input").val())
			{
				validar = false;
				swal("Completa todos los campos","","error");
				document.getElementById("form-virtual").reset();
				return false;			
			}
			if(!$("#form-virtual textarea").val())
			{
				validar = false;
				swal("Completa todos los campos","","error");
				document.getElementById("form-virtual").reset();
				return false;			
			}
			if(num_boleto < 10)
			{
				validar = false;
				swal("El minimo de boletos es de 10","","error");
				document.getElementById("form-virtual").reset();	
				return false;	
			}
			if(validar == true) 
			{
				$.ajax({
				type: "POST",
				url: 'virtual',
				data: new FormData($('#form-virtual')[0]),
				cache:false,
				contentType: false,
				processData: false,
				async: false,
					success:function(data){
						console.log("success");
						console.log(data);
					},
					error: function(data){
						console.log("error");
						console.log(data);
					}
				});
			}
			
		})

		@if(session('message'))
		setTimeout(function(){
			swal('{{ session('message') }}');
		}, 500);
		@endif
    </script>
</body>
</html>