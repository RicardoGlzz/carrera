<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/estilos.css">
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
                Ingresa tus datos 
            </section>
            <section>
                <div class="paso-2"><p>2</p></div>
                Selección de perfil 
            </section>
        </section>


        <section class="form form-0">
        	<section class="registrar">
        		<div class="img-registro">
        			<img src="img/logo_desc.png" alt="">
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

        <section class="form form-1">
        	<h1>Completa los datos para registrate</h1>
        	<br>
        	<form action="">
        		<label for="">Nombre</label>
        		<br>
        		<input type="text" placeholder="Nombre" id="nombre">
        		<br>
        		<label for="">Apellidos</label>
        		<br>
        		<input type="text" placeholder="Apellidos" id="apellidos">
        		<br>
        		<label for="">Correo</label>
        		<br>
        		<input type="email" placeholder="Correo" id="correo">
        		<br>
        		<br>
        		<label for="">¿Es una persona o un grupo?</label>
        		<br>
        		<br>
        		<input type="radio" name="tipo" checked> Persona
        		<input type="radio" name="tipo"> Grupo
        		<br>
        		<br>
        		<label for="">Folio</label>
        		<br>
        		<input maxlength="3" type="text" placeholder="Folio" name="folio" id="folio">
        		<br>
        		<label for="">Codigo</label>
        		<br>
        		<input maxlength="6" type="text" placeholder="Codigo" name="codigo" id="codigo">
        		<br>
        		<br>
                <input type="button" value="Anterior" id="anterior">
				<input type="button" value="Siguiente" id="siguiente">
        	</form>
        </section>

        <section class="form form-2">
        	<h1>Finalmente, sube tu foto para perfil</h1>
        	<div class="foto-cont">
			<div class="foto" id="preview">
				<figure>
					<img src="img/avatar.gif" alt="preview de imagen">
				</figure>				
			</div>
			<div class="archivo-style">
			<div class ="boton-archivo">	
			<input type="file" name="file" id="archivo"/>
			<p style="margin-top:-27px">Sube tu foto</p>
			</div>
			<div type="button" value="Enviar" name="submit-trabajo" class="btn-guardar first" id="submit-trabajo">Enviar</div>
			</div>
		</div>
        </section>

        <section class="form form-3">
            <h1>Ya esta listo tu registro, gracias por participar, para ver tu estado sigue el siguiente enlace.</h1>
            <a href="{{ URL::to('/') }}" target="_blank">Ir al sitio</a>
        </section>

        <section class="form lista-part">
            <h1>Selecciona tu nombre</h1>
           
                <div class="lista">
                    <h3></h3>
                </div>
            <button class="regreso-main">Regresar</button>                
            <button class="siguiente-main">Siguiente</button>
        </section>

    </section>
  <!--   <footer class="franja-bottom">
    	
    </footer> -->
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>}
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
$(document).on("click","#siguiente",function()
{
    $(".form-1").css("left","100%");
    $(".form-1").removeClass("animar-form");
    $(".form-1").css("display","block");
    $(".form-2").css("display","block");
})
$(document).on("click","#submit-trabajo",function()
{
    $(".form-2").css("left","100%");
    $(".form-2").removeClass("animar-form");
    $(".form-3").css("display","block");
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

</script>
</body>
</html>