var animacionDeCargar;
function agregarPuntitos(){
    var texto = $(".textoCargando").text();
    switch(texto.length){
        case 9:
            $(".textoCargando").text("Cargando..");
            break;

        case 10:
            $(".textoCargando").text("Cargando...");
            break;

        case 11:
            $(".textoCargando").text("Cargando.");
            break;
    }
}
function cerrarAnimacionCargando(cerrarVentana){
    clearInterval(animacionDeCargar);
    if(cerrarVentana){
        $(".parteCargando").css("display","none");
    }
}
$(document).ajaxStart(function(){
    $(".parteCargando").css("display","block");
    animacionDeCargar = setInterval(agregarPuntitos, 200);
});
$(document).ready(function(){
    var a = $( document ).height();
    $(".parteCargando").css("height", a + "px");
});