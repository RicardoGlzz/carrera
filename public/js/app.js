$(function()
{

    var total = 12000; //metros totales
    var distancia_linea = 1200; //metros por linea, suponiendo que se dibujaran 10 lineas
   
    var ctx = document.getElementById("canvas");
    var ctx=ctx.getContext("2d");


    ctx.beginPath();
    ctx.strokeStyle="#00FFA4";
    ctx.lineWidth=10;
    ctx.moveTo(150,150);
    ctx.lineTo(150,50);
    ctx.stroke();

    ctx.beginPath();
    ctx.strokeStyle="#00FFA4";
    ctx.lineWidth=10;
    ctx.moveTo(150,50);
    ctx.lineTo(300,50);
    ctx.stroke();
});