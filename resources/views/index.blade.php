@extends('layout.layout')

@section('content')

@if(session('message'))
<div class="alert alert-info">
	{{ session('message') }}
</div>
@endif
			<article class="checar-perfil">
				<span>X</span>
				<h1>Ya hemos avanzado gracias a ti, puedes ver tu perfil en la seccion de participantes mediante el siguiente enlace</h1>
				<a href="#participantes">Vér mi perfil</a>
			</article>
		<section id="vista-registro">
		
			<section class="cont-canvas">
				<canvas id="canvas" width="900" height="400">
					Si estas viendo este mensaje, significa que necesitas utilizar la última versión de Chrome, Firefox u Opera.
				</canvas>
			</section>
			<section class="botones-canvas">
			 <!--    <div class="logo-registro">
					<img src="" alt="logo de registro">
				</div> -->
				<div class="km-recorridos">
					<figure>
						<img src="img/distancia.png" alt="imagen de distancia recorrida">
					</figure>
					<div id="numero-metros">
						{{$distancia_total}}m
					</div>
				</div>
				<div class="boton-registro">
					<a target="_blank" href="">
					   <h1>APORTA</h1>
					   <h4>Haz click aquí</h4>
					</a>
				</div>
				<div class="seguir-corriendo">
					<img src="img/trek.png" alt="durangoTrek">
				</div>
			</section>
		</section>
		<section id="descripcion">
			 <article class="inverso"></article>
			<div class="desc">
				<h1>CHOCHO</h1>
				<br>
				<p> El primer pájaro CHOCHO®  nace el 30 de abril del 2012 en una etnia llamada "Los Chocholtecas" en la sierra del estado de Oaxaca en México.</p>
				<br>
				<p>Su cuerpo, es creado con telas recicladas, botones, hilos, agujas, y sobre todo, relleno de mucho amor y esperanza por parte de familias y niños con cáncer dentro de hospitales ancológicos.</p>
				<br>
				<p>Su misión en este mundo junto a los seres humanos, "Que ninguna familia abandone los tratamientos de su niño(a) por falta de recursos economicos."</p>
				<br>
				<br>
				<p>Al crear un pajaro CHOCHO®, los niños con cáncer distraen su mente y utilizan toda su creatividad junto con toda su familia.</p>
				<br>
				<p class="letraP">CHOCHO® es una marca registrada de Fundacion Mercado Productores A.C en la ciudad de México 2012.</p>
			</div>
			<div class="logo-desc">
				<img src="img/chocho.png" alt="logo de descripcion">
			</div>
			<br>
				<a href="{{ URL::to('casa') }}"><button id="ver-desc" class="boton-ver">Ver Más</button></a>
			<br>
			 <article class="triangulo"></article>
		</section>
		<section id="top5">
			<section id="titulotop">
				<div>
					<img src="img/titulo_top.png" alt="imagen de participante top">
				</div>
			</section>
			<section id="tops">

				@foreach($tops as $key => $top)
				<section>
					<div class="div_top">
						<figure class="img_liston">
							<img src="img/liston_top.png" alt="imagen de liston top">    
						</figure>
						<figure class="cont_top">
							{!! Html::image('imagenes/'.$top->imagen,null,array('class'=>'img_top '.$top->orientacion,'alt'=>'imagen de participante top')) !!}
						</figure>
					</div>
					<div class="div_top datos_top">
						<h3 class="lugar">{{ $top->lugar}} lugar </h3>
						<h3 class="dist-recorrida">{{ $top->distancia}} m</h3>
						<h3 class="nombre-top">{{ $top->nombre.' '.$top->apellidos }}</h3>
					</div>
				</section>
				@endforeach
			
			</section>
		</section>
		<section id="participantes">
			<article class="inverso"></article>
			<div class="titulo-corredores">
				<figure>
					<img src="img/titulo_corredores.png" alt="imagen de liston de corredores">
				</figure>
			</div>
			@foreach($corredores as $key => $corredor)
			 <section>
					<div class="div_top">
						<figure class="liston_rojo">
							<img src="img/liston_rojo.png" alt="imagen de liston rojo">
						</figure>
						<figure class="cont_part">
							{!! Html::image('imagenes/'.$corredor->imagen,null,array('class'=>'img_top '.$corredor->orientacion)) !!}
						</figure>
					</div>
					<div class="div_top datos_top">
						<h3 class="dist-recorrida">{{ $corredor->distancia }} m</h3>
						<input type="hidden" class="nombre-id" value="{{ $corredor->id }}">
						<h3 class="nombre-top">{{ $corredor->nombre.' '.$corredor->apellidos }}</h3>
						<a href="" target?>¡Sigue corriendo!</a>
					</div>
			</section>
			@endforeach
			<div class="after"></div>
			<br>
			<button id="ver-part" class="boton-ver">Ver Más</button>
			<br>
			<article class="triangulo"></article>
		
		</section>
		<script>
		
		</script>
@stop