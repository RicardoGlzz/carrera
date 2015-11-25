@extends('layout.layout')

@section('content')

@if(session('message'))
<div class="alert alert-info">
	{{ session('message') }}
</div>
@endif
			<article class="checar-perfil">
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
					<a target="_blank" href="{{ URL::to('registro') }}">
					   <h1>APORTA</h1>
					   <h4>Haz click aquí</h4>
					</a>
				</div>
				<div class="seguir-corriendo">
					<h1>¡Que siga corriendo!</h1>
					<img src="img/mono.png" alt="mono">
				</div>
			</section>
		</section>
		<section id="descripcion">
			 <article class="inverso"></article>
			<div class="logo-desc">
				<img src="img/logo_desc.png" alt="logo de descripcion">
			</div>
			<div class="desc">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente doloribus distinctio adipisci repudiandae delectus, illum quos eum eos explicabo dolor voluptate velit nesciunt! Ex quisquam nihil harum in amet eum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde iste ipsa eaque nesciunt harum consequatur numquam aliquid nihil laudantium distinctio nobis eos hic, quibusdam repudiandae quasi impedit dolorem saepe commodi?</p>
			</div>
			<br>
				<button id="ver-desc" class="boton-ver">Ver Más</button>
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
						<h3 class="nombre-top">{{ $corredor->nombre.' '.$corredor->apellidos }}</h3>
						<a href="" target?>¡Sigue corriendo!</a>
					</div>
			</section>
			@endforeach
			<br>
			<button id="ver-part" class="boton-ver">Ver Más</button>
			<br>
			<article class="triangulo"></article>
		
		</section>
@stop