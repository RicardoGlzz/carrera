$(function()
{

    var total = 12000; //metros totales
    var distancia_linea = 1200; //metros por linea, suponiendo que se dibujaran 10 lineas

    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");

    
    window.requestAnimFrame = (function (callback) {

        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    })();

    var pathArray = [];

// VARIABLE DE DISTANCIA TOTAL
var distancia_total = $("#numero-metros").text();
distancia_total.replace('m','');
var numero = parseInt(distancia_total);
// var numero = 6450;


// Coordenada inicial

var inicial =
{
    x: 50,
    y: 230
}

// Coordenadas para distancia de lineas
var primera = 
{
    x: 50,
    y: 50
}

var segunda = 
{
    x: 260,
    y: 90
}

var tercera = 
{
    x: 490,
    y: 60
}

var cuarta = 
{
    x: 710,
    y: 60
}


var quinta = 
{
    x: 720,
    y: 240
}


var sexta = 
{
    x: 720,
    y: 420
}

var septima = 
{
    x: 500,
    y: 440
}

var octava = 
{
    x: 320,
    y: 300
}

var novena = 
{
    x: 60,
    y: 360
}


var decima = 
{
    x: 70,
    y: 280
}



    // PRIMERA LINEA
    if( numero <= 1200)
    {

            // Calcular distancia entre dos puntos
            x1 = 50;
            y1 = 230;
            x2 = 50;
            y2 = 50;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cy = (numero * distancia) / 1200;
            var val = inicial.y-cy;
            var valor = Math.round(val);
            console.log(valor);
          
            // console.log(valor);
            
            pathArray.push(inicial);  
            pathArray.push(
            {
                x: 50,
                y: valor
            }
            );

        }

    // SEGUNDA LINEA
    else if(numero <= 2400)
    {       
        numero-=1200;
            // Calcular distancia entre dos puntos
            x1 = 50;
            y1 = 50;
            x2 = 260;
            y2 = 90;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cx = (numero * distancia) / 1200;
            var val = primera.x+cx;
            var valor = Math.round(val);
            console.log(cx);
            console.log(valor);

            pathArray.push(inicial);
            pathArray.push(primera);

            pathArray.push(
            {
                x: valor,
                y: 80
            }
            );  
        }

    // TERCERA LINEA
    else if(numero <= 3600)
    {   
        numero-=2400;
            // Calcular distancia entre dos puntos
            x1 = 260;
            y1 = 90;
            x2 = 490;
            y2 = 60;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cx = (numero * distancia) / 1200;
            var val = segunda.x+cx;
            var valor = Math.round(val);
            // console.log(val);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);

            pathArray.push(
            {
                x: valor,
                y: 60
            }
            );  
        }

    // CUARTA LINEA
    else if(numero <= 4800)
    {
        numero-=3600;
            // Calcular distancia entre dos puntos
            x1 = 490;
            y1 = 60;
            x2 = 710;
            y2 = 60;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cx = (numero * distancia) / 1200;
            var val = tercera.x+cx;
            var valor = Math.round(val);
            // console.log(val);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(
            {
                x: valor,
                y: 60
            }
            );  
        }

     // QUINTA LINEA
     else if(numero <= 6000)
     {
        
        numero-=4800;
            // Calcular distancia entre dos puntos
            x1 = 710;
            y1 = 60;
            x2 = 720;
            y2 = 240;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cy = (numero * distancia) / 1200;
            var val = cuarta.y+cy;
            var valor = Math.round(val);
            // console.log(valor);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(cuarta);
            pathArray.push(
            {
                x: 720,
                y: valor
            }
            );  
            console.log(pathArray.length);
           



        }

    // SEXTA LINEA
    else if(numero <= 7200)
    {
        numero-=6000;
            // Calcular distancia entre dos puntos
            x1 = 720;
            y1 = 240;
            x2 = 500;
            y2 = 440;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cy = (numero * distancia) / 1200;
            var val = quinta.y+cy;
            var valor = Math.round(val);
           
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(cuarta);
            pathArray.push(quinta);
            pathArray.push(
            {
                x: 720,
                y: valor
            }
            );  
        }

    // SEPTIMA LINEA
    else if(numero <= 8400)
    {
        numero-=7200;
            // Calcular distancia entre dos puntos
            x1 = 720;
            y1 = 440;
            x2 = 500;
            y2 = 440;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cx = (numero * distancia) / 1200;
            var val = sexta.x-cx;
            var valor = Math.round(val);
            // console.log(val);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(cuarta);
            pathArray.push(quinta);
            pathArray.push(sexta);
            pathArray.push(
            {
                x: valor,
                y: 400
            }
            );  
        }

    // OCTAVA LINEA
    else if(numero <= 9600)
    {
        numero-=8400;
            // Calcular distancia entre dos puntos
            x1 = 500;
            y1 = 440;
            x2 = 320;
            y2 = 300;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cx = (numero * distancia) / 1200;
            var val = septima.x-cx;
            var valor = Math.round(val);
            // console.log(val);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(cuarta);
            pathArray.push(quinta);
            pathArray.push(sexta);
            pathArray.push(septima);
            pathArray.push(
            {
                x: valor,
                y: 300
            }
            );  
        }

    // NOVENA LINEA
    else if(numero <= 10800)
    {
        numero-=9600;
            // Calcular distancia entre dos puntos
            x1 = 360;
            y1 = 260;
            x2 = 60;
            y2 = 360;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cx = (numero * distancia) / 1200;
            var val = octava.x-cx;
            var valor = Math.round(val);
            // console.log(val);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(cuarta);
            pathArray.push(quinta);
            pathArray.push(sexta);
            pathArray.push(septima);
            pathArray.push(octava);
            pathArray.push(
            {
                x: valor,
                y: 360
            }
            );  
        }

    // DECIMA LINEA
    else if(numero <= 12000)
    {
        numero-= 10800;
            // Calcular distancia entre dos puntos
            x1 = 60;
            y1 = 360;
            x2 = 50;
            y2 = 280;
            var distancia = Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
            // obtener los puntos en x o en y
            var cy = (numero * distancia) / 1200;
            var val = octava.y-cy;
            var valor = Math.round(val);
            // console.log(val);
            // console.log(cx);
            // console.log(distancia);

            pathArray.push(inicial);
            pathArray.push(primera);
            pathArray.push(segunda);
            pathArray.push(tercera);
            pathArray.push(cuarta);
            pathArray.push(quinta);
            pathArray.push(sexta);
            pathArray.push(septima);
            pathArray.push(octava);
            pathArray.push(novena);
            pathArray.push(
            {
                x: 60,
                y: valor
            }
            );  
        }

        var puntosclave = hacerPuntosClave(pathArray);
        var posicion = 0;
        var velocidad = 2;
        animate();

        var fps = 40;



function animate() {

    // lineas guia
    // ctx.lineWidth = 5;

    // ctx.beginPath();
    // ctx.moveTo(150, 200);
    // ctx.lineTo(130, 10);
    // ctx.strokeStyle = 'red';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(130, 10);
    // ctx.lineTo(340, 80);
    // ctx.strokeStyle = 'green';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(340, 80);
    // ctx.lineTo(560, 30);
    // ctx.strokeStyle = 'gold';
    // ctx.stroke();
    

    // ctx.beginPath();
    // ctx.moveTo(560, 30);
    // ctx.lineTo(800, 40);
    // ctx.strokeStyle = 'blue';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(800, 40);
    // ctx.lineTo(800, 220);
    // ctx.strokeStyle = 'gold';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(800, 220);
    // ctx.lineTo(800, 380);
    // ctx.strokeStyle = 'red';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(800, 380);
    // ctx.lineTo(550, 380);
    // ctx.strokeStyle = 'blue';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(550, 380);
    // ctx.lineTo(350, 250);
    // ctx.strokeStyle = 'gold';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(350, 250);
    // ctx.lineTo(125, 360);
    // ctx.strokeStyle = 'red';
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.moveTo(125, 360);
    // ctx.lineTo(150, 200);
    // ctx.strokeStyle = 'blue';
    // ctx.stroke();

    setTimeout(function () {
        requestAnimFrame(animate);

        // calcular nueva posicion
        posicion += velocidad;
        if (posicion > puntosclave.length - 1) {
            return;
        }
        var pt = puntosclave[posicion];
        // console.log(posicion);


        // dibujar imagenes deacuerdo a su posicion
         if(posicion >= 402)
            {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.save();
                ctx.beginPath();
                ctx.translate(pt.x, pt.y);
                // Objeto de la imagen del corredor
                 img = new Image();
                // url de imagen
                img.src = "img/mono_animar_2.png";
                ctx.drawImage(img,0,-80);
                ctx.restore();
            }
          if(posicion == 1008)
            {
                
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.save();
                ctx.beginPath();
                ctx.translate(pt.x, pt.y);
                // Objeto de la imagen del corredor
                 img = new Image();
                // url de imagen
                img.src = "img/termino.png";
                ctx.drawImage(img,0,-80);
                ctx.restore();
            }  
            if(posicion <= 402) 
            {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.save();
                ctx.beginPath();
                ctx.translate(pt.x, pt.y);
                // Objeto de la imagen del corredor
                 img = new Image();
                // url de imagen
                img.src = "img/mono_animar.png";
                ctx.drawImage(img,0,-80);
                ctx.restore();   
            }

    }, 1000 / fps);

    // Si ya alcanzo la meta que se posicione al final de meta solamente
     if(numero > 12000)
     {

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.save();
        ctx.beginPath();
        // Objeto de la imagen del corredor
        img = new Image();
        // url de imagen
        img.src = "img/termino.png";
        ctx.drawImage(img,80,150);
        ctx.restore();
     }
}

function hacerPuntosClave(pathArray) {

    var puntos = [];

    for (var i = 1; i < pathArray.length; i++) 
    {
        var startPt = pathArray[i - 1];
        var endPt = pathArray[i];
        var dx = endPt.x - startPt.x;
        var dy = endPt.y - startPt.y;
        for (var n = 0; n <= 100; n++)
        {
            var x = startPt.x + dx * n / 100;
            var y = startPt.y + dy * n / 100;
            puntos.push({
                x: x,
                y: y
            });
        }
    }
    return (puntos);

}

});


