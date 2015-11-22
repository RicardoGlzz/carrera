$(function()
{


    var total = 12000; //metros totales
    var distancia_linea = 1200; //metros por linea, suponiendo que se dibujaran 10 lineas
   
    
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");



    // lineas guia
    // ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    window.requestAnimFrame = (function (callback) {
   
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
        window.setTimeout(callback, 1000 / 60);
    };
})();

var pathArray = [];

var metros = prompt("cuantos metros avanzara");
var numero = parseInt(metros);


// Coordenada inicial
// pathArray.push(
//     {
//         x: 150,
//         y: 230
//     }
// );
if( numero == 1200)
{
    pathArray.push(
    {
        x: 50,
        y: 230
    }
);

        pathArray.push(
        {
            x: 50,
            y: 1
        }
    );
}
if( numero > 1200)
{
      pathArray.push(
    {
        x: 50,
        y: 230
    }
);

        pathArray.push(
        {
            x: 50,
            y: 1
        }
    );

    pathArray.push(
        {
            x: 400,
            y: 30
        }, {
            x: 750,
            y: 10
        }
    );
}
// pathArray.push(
//     {
//         x: 750,
//         y: 310
//     }
// );
// pathArray.push(
//     {
//         x: 380,
//         y: 310
//     }
// );

// pathArray.push(
//     {
//         x: 280,
//         y: 180
//     }
// );

// pathArray.push(
//     {
//         x: 180,
//         y: 250
//     }
// );

// pathArray.push(
//     {
//         x: 10,
//         y: 250
//     }
// );

// pathArray.push(
//     {
//         x: 50,
//         y: 200
//     }
// );
// pathArray.push(
//     {
//         x: 80,
//         y: 150
//     }
// );

var polypoints = makePolyPoints(pathArray);

// var width = 2;
// var height = 5;
var position = 0;
var speed = 1;
animate();

var fps = 40;

function animate() {
    ctx.lineWidth = 5;

    ctx.beginPath();
    ctx.moveTo(150, 200);
    ctx.lineTo(130, 10);
    ctx.strokeStyle = 'red';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(130, 10);
    ctx.quadraticCurveTo(380, 100, 500, 70);
    ctx.strokeStyle = 'green';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(500, 70);
    ctx.lineTo(830, 40);
    ctx.strokeStyle = 'blue';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(830, 40);
    ctx.lineTo(830, 380);
    ctx.strokeStyle = 'gold';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(830, 380);
    ctx.lineTo(450, 380);
    ctx.strokeStyle = 'blue';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(450, 380);
    ctx.lineTo(350, 250);
    ctx.strokeStyle = 'gold';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(350, 250);
    ctx.lineTo(190, 320);
    ctx.strokeStyle = 'red';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(190, 320);
    ctx.lineTo(40, 300);
    ctx.strokeStyle = 'blue';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(40, 300);
    ctx.lineTo(140, 260);
    ctx.strokeStyle = 'gold';
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(140, 260);
    ctx.lineTo(150, 200);
    ctx.strokeStyle = 'green';
    ctx.stroke();


    setTimeout(function () {
        requestAnimFrame(animate);

        // calcular nueva posicion
        position += speed;
        if (position > polypoints.length - 1) {
            return;
        }
        var pt = polypoints[position];


        // dibujar
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.save();
        ctx.beginPath();
        ctx.translate(pt.x, pt.y);
        // Objeto de la imagen del corredor
        img = new Image();
        // url de imagen
        
        img.src = "img/mono_animar.png";
        ctx.drawImage(img,0,0);
        ctx.restore();

    }, 1000 / fps);
}

function makePolyPoints(pathArray) {

    var points = [];

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
            points.push({
                x: x,
                y: y
            });
        }
         console.log(points);
    }
    return (points);
   
}



});