function agregarGuardado(idReceta) {
    event.preventDefault();
    $.ajax({
        method: 'POST',
        url: 'abGuardado.php',
        data: {idReceta: idReceta, operacion:'agregar'}
        })
            .done(function (msg) {
                cerrarAnimacionCargando(false);
                if (msg == 'OK') {
                    location.href = 'guardados.php';
                }
            });
}

function eliminarGuardados(idReceta){
    $.ajax({
        method: 'POST',
        url: 'abGuardado.php',
        data: {idReceta: idReceta, operacion:'eliminar'}
    })
        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == 'OK') {
                location.href = 'guardados.php';
            }
        });
}

var calificacion=0;
function pintarLimones(posicion) {
    $('.imagenModal').removeClass('imagenModalConColor');
    $('.imagenModal').attr('src', 'Imagenes/Limon.png');
    for (var i = 0; i <= posicion; i++) {
        $('#limon' + i).addClass('imagenModalConColor');
        $('#limon' + i).attr('src', 'Imagenes/limonNaranja.png');
    }
    calificacion=posicion;
}

function aniadirCalificacion(idReceta){
    event.preventDefault();
    location.href='recetaExplorar.php?operacion=calificar&idReceta='+idReceta+'&calificacion='+calificacion;
    $('#modalPuntuarReceta').modal('toggle');
}

function eliminarReceta(idReceta){
    location.href="abReceta.php?operacion=eliminar&id="+ idReceta ;
}

function agregarReceta(){
    var aniadir = document.getElementsByClassName("botonAniadir");
    $('.row').removeClass("botonAniadir");
    $('.row').append(aniadir);
    crearReceta();
}

function crearReceta(){
    event.preventDefault();
    location.href="abReceta.php?nombre="+$("#nuevoNombre").val();
}

// Crear una receta nueva

var reader = new FileReader();

var contadorIngredientes=0;
var cantidadPasos=1;
var dificultad=0;
let ingredientes=new Map();
let pasos=new Map();

function pintarGorros(posicion) {
    $(".imagenModal").removeClass("imagenModalConColor");
    $(".imagenModal").attr("src", "Imagenes/gorro de chef.png");
    for (var i = 0; i <= posicion; i++) {
        $("#gorro" + i).addClass("imagenModalConColor");
        $("#gorro" + i).attr("src", 'Imagenes/gorro de chef naranja.png');
    }
    dificultad=posicion;
}

function cerrarItem(item, elemento) {
    $("." + item).css("display", "none");
    if(elemento==1){
        for (var [key, value] of ingredientes) {
            for (var [key2, value2] of ingredientes.get(key)){
                if(key2=="nombre" && value2==item){
                    ingredientes.delete(key);
                }
            }
        }
    }
    else{
        for (var [key, value] of pasos) {
            for (var [key2, value2] of pasos.get(key)){
                if(key2=="descripcion" && value2==item){
                    pasos.delete(key);
                }
            }
        }
    }
}

function agregarItem(nombreItem) {
    let atributosIngredientes=new Map();
    atributosIngredientes.set("unidad",$("#unidad").val());
    atributosIngredientes.set("cantidad", parseInt($("#cantidad").val()));
    atributosIngredientes.set("nombre",nombreItem);
    ingredientes.set(contadorIngredientes,atributosIngredientes);
    var nombreItemAux = "'" + nombreItem + "'";
    $(".itemsAgregados").append('<div class="row"> <div class="contenedorParteInferior ' + nombreItem + ' itemsDeLaLista border-bottom border-top border-dark"><p class="elementoAgregado">'+$("#cantidad").val()+ " "+ $("#unidad").val()+" "+nombreItem +'<button type="button" onclick="cerrarItem(' + nombreItemAux + ',1)" class="close botonEliminar" aria-label="Close"><span aria-hidden="true" class="cruz">&times;</span></button></p></div></div>');
    contadorIngredientes++;
}

function agregarPaso(paso) {
    let atributosPasos=new Map();
    atributosPasos.set("paso",String(cantidadPasos));
    atributosPasos.set("descripcion",paso);
    pasos.set(cantidadPasos-1, atributosPasos);
    var nombrePasoAux = "'" + paso + "'";
    $(".pasos").append('<div class="contenedorParteInferior ' + paso + ' listaDePasos border-bottom border-top border-dark"><p class="elementoAgregado">'+paso +'<button type="button" onclick="cerrarItem(' + nombrePasoAux + ', 2)" class="close botonEliminar" aria-label="Close"><span aria-hidden="true" class="cruz" >&times;</span></button></p></div>');
    cantidadPasos++;
}

function agregarIngrediente() {
    var itemIngresado = $(".inputIngresarIngrediente").val();
    var cantidadIngresada = $("#cantidad").val();
    var ingresaNombre = true;
    if (itemIngresado == "") {
        $(".inputIngresarIngrediente").removeClass("border-light");
        $(".inputIngresarIngrediente").addClass("border-danger");
        setTimeout(function () {
            $(".inputIngresarIngrediente").removeClass("border-danger");
            $(".inputIngresarIngrediente").addClass("border-light");
        }, 1000);
        ingresaNombre = false;
    }
    if (cantidadIngresada == "") {
        $("#cantidad").removeClass("border-light");
        $("#cantidad").addClass("border-danger");
        setTimeout(function () {
            $("#cantidad").removeClass("border-danger");
            $("#cantidad").addClass("border-light");
        }, 1000);
    }
    if (cantidadIngresada != "" && ingresaNombre) {
        agregarItem(itemIngresado);
        $(".inputIngresarIngrediente").val('');
        $("#cantidad").val('');

    }
}

function agregarPasoCrearReceta() {
    var pasoIngresado = $(".inputIngresarPasos").val();
    if (pasoIngresado == "") {
        $(".inputIngresarPasos").removeClass("border-light");
        $(".inputIngresarPasos").addClass("border-danger");
        setTimeout(function () {
            $(".inputIngresarPasos").removeClass("border-danger");
            $(".inputIngresarPasos").addClass("border-light");
        }, 1000);
    }
    else {
        pasoIngresado = "-"+$(".inputIngresarPasos").val();
        agregarPaso(pasoIngresado);
        $(".inputIngresarPasos").val('');

    }
}


function parseToBase64(idInput) {
    var input = document.getElementById(idInput);
    var file = input.files[0];

    reader.onload = function () {
        b64 = reader.result.replace(/^data:.+;base64,/, '');
        $("#imagenB64").html(b64);
    };
    reader.readAsDataURL(file);
}

function insertarReceta(idUsuario, nombre) {
    var contador = 0;
    var elementoImagen = $("#imagenB64").innerHTML;

    let jsonObject2 = {};
    "use strict";
    pasos.forEach((value, key) => {
        let jsonObject = {};
        value.forEach((valor2, clave2) => {
            jsonObject[clave2] = valor2

        });
        jsonObject2[key] = jsonObject;
    });

    let jsonObject2Ingredientes = {};
    ingredientes.forEach((value, key) => {
        let jsonObjectIngredientes = {};
        value.forEach((valor2, clave2) => {
            jsonObjectIngredientes[clave2] = valor2
        });
        jsonObject2Ingredientes[key] = jsonObjectIngredientes;
    });

    if (dificultad == 0 || pasos.size == 0 || ingredientes.size == 0 || $("#imagen").val() == "") {
        $(".mensajeError").css("visibility", "visible");


    }
    else {
        parseToBase64("imagen");
        reader.onloadend=function (){
            $(".mensajeError").css("visibility", "hidden");
            $.ajax({
                method: "POST",
                url: "abReceta.php",
                data: {
                    idUsuario:idUsuario,
                        titulo: nombre,
                        dificultad: parseInt(dificultad),
                        imagen: $("#imagenB64").text(),
                        pasosIngresados: jsonObject2,
                        ingredientesIngresados: jsonObject2Ingredientes
                    }
                })
                .done(function (msg) {
                    location.href = "misRecetas.php";
                });
            };
        }
    }