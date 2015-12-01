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
					<a target="_blank">
					   <h1>APORTA</h1>
					   <h4>Haz click aquí</h4>
					</a>
				</div>
			<div class="seguir-corriendo">
					<img src="img/adquiere.png" alt="adquiere">
				<div>	
					<img src="img/trek.png" alt="durangoTrek">
					<h2>Sucursales:</h2>
					<a href="https://www.google.com.mx/search?q=durango+trek&ie=utf-8&oe=utf-8&gws_rd=cr&ei=8-VdVqylBcr2jwPE1JuIBQ#q=durango+trek&rflfq=1&rlha=0&tbm=lcl&rlfi=hd:;si:13221632000810402194" target="_blank">	
					Barrio del calvario
					</a>
					<a href="https://www.google.com.mx/search?q=durango+trek&ie=utf-8&oe=utf-8&gws_rd=cr&ei=8-VdVqylBcr2jwPE1JuIBQ#q=durango+trek&rflfq=1&rlha=0&tbm=lcl&rlfi=hd:;si:13221632000810402194" target="_blank">	
					Felipe Pescador
					</a>
				</div>
				<div>	
					<img src="img/logos.jpg" alt="casa">
					<br>
					<br>
					<a href="https://www.google.com.mx/maps/place/C.A.S.A.+Centro+de+Ayuda+Servicio+y+Apoyo/@24.0224183,-104.6661435,17z/data=!4m7!1m4!3m3!1s0x869bc81f2f948621:0x3546e240a3f523cf!2sCalle+Carlos+Le%C3%B3n+de+la+Pena+509,+Zona+Centro,+34000+Durango,+Dgo.!3b1!3m1!1s0x869bc81f2f77a999:0xe8f14898e09cffd8" target="_blank">
						Carlos León <br> de la Peña
					</a>
				</div>
			</div>	
			</section>
		</section>
			<div class="patrocinadores">
				<div>
					<a href="http://www.dzr.mx" target="_blank">
						<img src="img/patrocinador1.png" alt="">
					</a>
				</div>
				<div>
					<a href="http://www.remaxdelarosa.com" target="_blank">
						<img src="img/patrocinador2.png" alt="">
					</a>
				</div>
				<div>
					<a href="https://www.google.com.mx/maps/search/panaderia+la+paz/@24.0282463,-104.7142123,13z/data=!3m1!4b1" target="_blank">
						<img src="img/patrocinador3.jpg" alt="">
					</a>
				</div>
				<div style="width: 25%;">
					<a href="http://www.forrajesmeraz.com.mx/" target="_blank">
						<img src="img/patrocinador4.png" alt="">
					</a>
				</div>
			</div>
		<section id="descripcion">
			 <article class="inverso"></article>
			<div class="desc">
				<h1>12K CHOCHO</h1>
				<br>
				<p> 
				12k Chocho es la primer carrera virtual en Durango y ha sido creada para apoyar con un lugar seguro y digno a las niñas, niños y mujeres con cáncer que vienen de otras ciudades o aldeas para recibir sus tratamientos oncológicos, el Albergue “Mi CASA” ha apoyado a estas familias por más de 15 meses con un lugar seguro y digno y queremos lograr un año más con tu ayuda.</p>
				<br>
				<p>Adquiere tus metros en CASA, Durango Trek o con un <a href="#virtual" class="virtual">corredor virtual</a> y regístralos en la página para que Chocho siga corriendo.</p>
				<br>
				<p>Cada metro cuenta, recuerda que “Servir y apoyar es la meta virtual”.</p>
				<br>
				<p class="letraP">CHOCHO® es una marca registrada de Fundacion Mercado Productores A.C en la ciudad de México 2012.</p>
			</div>
			<div class="logo-desc">
				<img src="img/chocho.png" alt="logo de descripcion">
			</div>
			<br>
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
							@if($top->imagen)
							{!! Html::image('imagenes/'.$top->imagen,null,array('class'=>'img_top '.$top->orientacion,'alt'=>'imagen de participante top')) !!}
							@else
							{!! Html::image('img/avatarchocho.png',null,array('class'=>'img_top sin_imagen')) !!}
							@endif
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
			 <section class="cont-part">
					<div class="div_top">
						<figure class="liston_rojo">
							<img src="img/liston_rojo.png" alt="imagen de liston rojo">
						</figure>
						<figure class="cont_part">
							@if($corredor->imagen)
							{!! Html::image('imagenes/'.$corredor->imagen,null,array('class'=>'img_top '.$corredor->orientacion)) !!}
							@else
							{!! Html::image('img/avatarchocho.png',null,array('class'=>'img_top')) !!}
							@endif
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
		
		<section class="patrocinadores_lista">
			<figure class="logo_patrocinador">
				<img src="img/patrocinador_liston.png" alt="">
			</figure>

			<div>
				<a href="http://www.dzr.mx" target="_blank">
					<img src="img/patrocinador1.png" alt="">
				</a>
			</div>
			<div>
				<a href="http://www.remaxdelarosa.com" target="_blank">
					<img src="img/patrocinador2.png" alt="">
				</a>
			</div>
			<div>
				<a href="http://www.panlapaz.com/" target="_blank">
					<img src="img/patrocinador3.jpg" alt="">
				</a>
			</div>
			<div>
				<a href="http://www.forrajesmeraz.com.mx/" target="_blank">
					<img src="img/patrocinador4.png" alt="">
				</a>
			</div>
		</section>
		
		<section class="corredor_virtual" id="virtual">
			<article class="inverso"></article>
			<figure class="liston_virtual">
				<img src="img/virtual_liston.png" alt="">
			</figure>
			<div>
				<img src="img/mono.png" alt="">
			</div>
			<div class="form-corredor">
				<label for="">¿Quien recibira los boletos?</label>
				<br>
				<input type="text" class="datos-form">
				<br>
				<label for="">¿En que correo te podemos contactar?</label>
				<br>
				<input type="text" class="datos-form">
				<br>
				<label for="">¿Cual es su dirección?</label>
				<br>
				<textarea name="" id=""></textarea>
				<br>
				<label for="">¿Cuantos boletos necesitas?</label>
				<br>
				<input type="text" class="num-boletos" maxlength="2">
				<br>

				<button id="enviar-corredor">Enviar</button>
			</div>
		</section>
@stop