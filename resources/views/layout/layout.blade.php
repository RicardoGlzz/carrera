<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>12KChocho</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
						<a href="">
							<li>REGISTRO</li>
						</a>
						<a href="">
							<li>¿POR QUÉ 12K?</li>
						</a>
						<a href="">
							<li>CORREDORES</li>
						</a>
						<a href="">
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
						<a href="">
							<li><i class="fa fa-twitter"></i></li>
						</a>
					</ul>
				</div>
			</section>
			 <article></article>
		</nav>

		@yield('content')

		<footer>
			<div>
				<img src="" alt="logo de virtua">
			</div>
		</footer>

	</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>