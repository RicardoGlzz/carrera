$(document).on("click",".btn-registro",function()
{
    $(".progreso").css("right","0");
    // $(".form-0").css("left","100%");
})




// CANVAS
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
// ctx.width = 25;
// ctx.height = 25;

window.requestAnimFrame = (function (callback) {
   
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
        window.setTimeout(callback, 1000 / 60);
    };
})();

var cargar = function()
{

    var fondo = new Image();   
    fondo.onload = function() 
    {
        ctx.drawImage(fondo, 69, 50);
    };
    fondo.src= "img/mapa.png";
}
var pathArray = [];

// var enx = prompt("coordenada en x");
// var eny = prompt("coordenada en y");
// var num1 = parseInt(enx);
// var num2 = parseInt(eny);

// Coordenada inicial
pathArray.push({
    x: 0,
    y: 0
});
pathArray.push({
    x: 50,
    y: 50
});
// pathArray.push({
//     x: 200,
//     y: 200
// });
// pathArray.push({
//     x: 200,
//     y: 200
// });

var polypoints = makePolyPoints(pathArray);

var width = 2;
var height = 5;
var position = 0;
var speed = 2;
animate();

var fps = 60;

function animate() {
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
    }
    return (points);
}

cargar();
