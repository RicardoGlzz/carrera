<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro Master</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/sweetalert.css">
</head>
<body class="cont-registro">
<section class="registro-wrap">
	<div class="franja">
		<figure>
			<img src="img/logo.png" alt="">
		</figure>
	</div>
	<section class="contenedor">
		<section class="progreso">
			<section>
				<div class="paso-1"><p>1</p></div>
				Datos de Master 
			</section>
			<section>
				<div class="paso-2"><p>2</p></div>
				Imagen de Master
			</section>
		</section>


		<section class="form form-0">
			<h1>Cuenta de Master</h1>
			<section class="registrar">
				<div class="img-registro">
					<img src="img/logo_desc.png" alt="">
				</div>
				<div class="btn-agrega">
					Agregar codigos
				</div>
				<div class="btn-registro">
					Registrar
				</div>
			</section>
			<section class="correr">
				<div class="btn-registro seguir-btn">
					Seguir corriendo
				</div>
				<div>
					<img src="img/mono.png" alt="">
				</div>
			</section>
		</section>

		{!! Form::open(array('url' => 'registromaster','id'=>'formulario','files' => true)) !!}

		<section class="form form-1">
			<h1>Datos para registro Master</h1>
			<br>
				{!! Form::label('', 'Nombre') !!}
				<br>
				{!! Form::text('nombre', null, array('placeholder'=>'Nombre','id'=>'nombre')) !!}
				<br>
				{!! Form::label('', 'Metros') !!}
				<br>
				{!! Form::text('metros', null, array('placeholder'=>'Metros','id'=>'metros')) !!}
				<br>
				{!! Form::label('', 'Contraseña') !!}
				<br>
				{!! Form::password('password', null, array('id'=>'password')) !!}
				<br>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<br>
				<input type="button" value="Anterior" id="anterior">
				<input type="button" value="Siguiente" id="siguiente">
		</section>

		<section class="form form-2">
			<h1>Finalmente, sube tu foto para perfil</h1>
			<div class="foto-cont">
			<div class="foto" id="preview">
				<figure>
					<img src="img/avatar.jpg" alt="preview de imagen">
				</figure>
			</div>
			<div class="archivo-style">
			<div class ="boton-archivo">
			<input type="file" name="imagen" id="archivo"/>
			<p style="margin-top:-27px">Sube tu foto</p>
			</div>
			<!-- Animacion de carga -->
			<div class="spinner">
			  <div class="bounce1"></div>
			  <div class="bounce2"></div>
			  <div class="bounce3"></div>
			</div>

			<div type="button" value="Enviar" name="submit-trabajo" class="btn-guardar first" id="submit-trabajo">Enviar</div>
			</div>
		</div>
		</section>
	{!! Form::close() !!}
		<section class="form form-3">
			<h1>El registro ha sido realizado, para ver el estado sigue el siguiente enlace</h1>
			<a href="{{ URL::to('/') }}">Ir al sitio</a>
		</section>

		<section class="form lista-part">
			<h1>Selecciona el nombre</h1>
			<!-- Buscador de nombres -->
				<h2>Buscar:</h2>
			    <input type="text" class="text-input" id="filtrar" value="" />
				<div class="lista">
					@foreach($corredores as $corredor)
					<input type="hidden" class="" value="{{$corredor->id}}">
					<h3 class="elemento-lista-registrado" data-idseguir="{{$corredor->id}}">{{$corredor->apellidos.' '.$corredor->nombre}}</h3>
					@endforeach
				</div>
			<button class="regreso-main">Regresar</button>
			<button class="siguiente-main">Siguiente</button>
		</section>

		<section class="form folio-apart">
			{!! Form::open(array('url' => 'registroSeguir','id'=>'formularioSeguir','files' => true)) !!}
			<h1>Agregar más distancia para:</h1>
			<input type="hidden" id="mas_distancia" name="mas_distancia">
			<h2 class="persona_a_correr"></h2>
			<label for="">Folio</label>
			<br>
			<input type="text" placeholder="Folio" name="folio-seguir">
			<br>
			<label for="">Código</label>
			<br>
			<input type="text" placeholder="Código" name="codigo-seguir">
			<br>
			{!! Form::close() !!}
			<div class="contenedor-botones">
				<button type="button" class="regresar-lista">Regresar</button>
				<button type="button" class="terminar-correr">Siguiente</button>
			</div>
		</section>

	</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="js/sweetalert.min.js"></script>

<script>
// Buscador
$("#filtrar").keyup(function()
{
	var filtro = $(this).val();
	$(".lista h3").each(function()
	{
        // crea una expresion regular para comparar con lo del input
        if ($(this).text().search(new RegExp(filtro, "i")) < 0) 
            {
            	$(this).hide();
            }
            else 
            {
            	$(this).show();
            }
        });
});

// Fin de buscador
$(document).on("click",".btn-registro",function()
{
	$(".progreso").css("left","0");
	$(".form-0").css("left","100%");
	$(".form-1").addClass("animar-form");
	$(".form-1").css("display","block");
})
$(document).on("click","#anterior",function()
{   
	$(".progreso").css("left","100%");
	$(".form-0").css("left","0");
	$(".form-1").removeClass("animar-form");
	$(".form-1").css("display","none");
})

$("#siguiente").on("click",function()
{
	var nombre = $('[name="nombre"]').val(),
		metros = $('[name="metros"]').val(),
		password = $('[name="password"]').val();
		

	function validar() {

		var mensaje = "";

		if ((nombre=="")||(nombre==null)||(metros=="")||(metros==null)||(password=="")||(password==null)){
			mensaje += "*Faltan datos<br>";
		}

		if(mensaje=="") {
			return true;
		}

		else {
			swal({
				title: "Error en los datos",
				type: "error",
				text: mensaje,
				html: true
			});
			return false;
		}
	}


	// $.post('checkMaster', {"password":$('[name="password"]').val(),"_token":"{{ csrf_token() }}"}, function(data) {
	// 	if(validar())
	// 	{
	// 		if(data=="NO")
	// 		{
	// 			swal("Contraseña incorrecta","","error");
	// 		}
	// 		else
	// 		{
				$(".progreso .paso-1").addClass("color-progreso");
				$(".form-1").css("left","100%");
				$(".form-1").removeClass("animar-form");
				$(".form-1").css("display","block");
				$(".form-2").css("display","block");
		// 	}	
		// }
	// });
});

$(document).on("click","#submit-trabajo",function()
{
	$(".spinner").css("opacity","1");
	$(".progreso .paso-2").addClass("color-progreso");
	$(".form-2").css("left","100%");
	$(".form-2").removeClass("animar-form");
	$(".form-3").css("display","block");

	$.ajax({
		type: "POST",
		url: 'registromaster',
		data: new FormData($('#formulario')[0]),
		cache:false,
		contentType: false,
		processData: false,
		async: false,
			success:function(data){
				$(".spinner").css("opacity","0");
				console.log("success");
				console.log(data);
			},
			error: function(data){
				console.log("error");
				console.log(data);
			}
	});
})
// Seguir corriendo
$(document).on("click",".seguir-btn",function()
{
	$(".form-0").css("left","100%");
	$(".progreso").css("left","100%");
	$(".lista-part").addClass("animar-form");
	$(".lista-part").css("display","block");
	$(".form-1").css("display","none");
})

// preview de imagen de registro
$("#archivo").change(function()
{
	var reader = new FileReader();

	reader.onload = function(e)
	{
		$('#preview img').attr('src',e.target.result);
		$('#preview').css({"background":"white"});
	}
	reader.readAsDataURL(this.files[0]);
});
$("#preview").click(function()
{
	$("#archivo").click();
});
// Opciones de seguir corriendo
$(".regreso-main").on("click",function()
{
	$(".form-0").css("left","0");
	$(".progreso").css("left","100%");
	$(".lista-part").removeClass("animar-form");
	$(".lista-part").css("display","none");
	$(".form-1").css("display","none");
})

$(document).on("click",".lista-part .lista h3",function()
{
	$(".lista-part .lista h3").removeClass("lista-activo");
	$(this).addClass("lista-activo");
});

$(".regresar-lista").on("click",function()
{
	$(".form-0").css("left","100%");
	$(".progreso").css("left","100%");
	$(".lista-part").addClass("animar-form");
	$(".lista-part").css("display","block");
	$(".form-1").css("display","none");
	$(".folio-apart").css("display","none");
})

$(document).on("click",".siguiente-main",function()
{
	$(".persona_a_correr").text($(".lista-activo").text());
	$(".folio-apart").addClass("animar-form");
	$(".lista-part").css("display","none");
	$(".form-1").css("display","none");
	$(".folio-apart").css("display","block");
	var distancia_add = $(".lista-activo").attr("data-idseguir");
	// Guardar en arreglo el ultimo valor que es el nombre para enviar al formulario
	arreglo = distancia_add.split(/\s+/);
	elemento = $(arreglo).get(-1);
	$("#mas_distancia").val(distancia_add);
});

// Se guarda en localstorage la clase que se usara cuando se redirecciona al sitio y se muestra el mensaje
$(".form-3 a").on("click",function()
{	
	localStorage.setItem("perfil", "muestra-perfil");
})
// Funcion que se ejecuta al dar click de 'seguir corriendo en los perfiles de corredores'
function seguirle()
{
	
	$(".folio-apart").addClass("animar-form");
	$(".lista-part").css("display","none");
	$(".form-1").css("display","none");
	$(".folio-apart").css("display","block");
	agrega = localStorage.getItem("nombre-corredor");
	id = localStorage.getItem("nombre-id");
	$("#mas_distancia").val(id);
	$(".persona_a_correr").text(agrega);
}
function buscarNombre()
{
	$(".form-0").css("left","100%");
	$(".progreso").css("left","100%");
	$(".lista-part").addClass("animar-form");
	$(".lista-part").css("display","block");
	$(".form-1").css("display","none");
}
function registrar()
{
	$(".progreso").css("left","0");
	$(".form-0").css("left","100%");
	$(".form-1").addClass("animar-form");
	$(".form-1").css("display","block");
}

$(document).on("click",".terminar-correr",function()
{
	localStorage.clear();
	$.post('checkFolio', {"folio":$('[name="folio-seguir"]').val(),"codigo":$('[name="codigo-seguir"]').val(),"_token":"{{ csrf_token() }}"}, function(data) {

		if(data=="NO"||data=="NO CON CLAVE FALSE")
		{
			swal("Error con el folio o código","","error");
		}
		else if(data=="USADO")
		{
			swal("Código ya utilizado","","error");
		}
		else
		{
			swal("OKa","","error");
			$.ajax({
				type: "POST",
				url: 'registroSeguir',
				data: new FormData($('#formularioSeguir')[0]),
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
			swal("OK","","success");
		}
		
	});
});

</script>
</body>
</html>