var itemsCompletadosInicial=[];
var itemsCompletados=[];

var idLista;

function indicarLista(idListaActual){
    idLista= idListaActual;
}

function agregarLista(){
    var aniadir = document.getElementsByClassName("botonAniadir");
    $('.row').removeClass("botonAniadir");
    $('.row').append("<div class='col-4'><button class='btn  btn-block botonConBorde' type='submit' id='hola' data-toggle='modal' data-target='#modalCrearLista'><a href='listaExpandida.php' class='nav-link'></a>"+$("#nombreLista").val()+"</button></div>");
    $('.row').append(aniadir);
    event.preventDefault();
    var nombreLista=$("#nombreLista").val();
    var nombreListaSinEspacios=nombreLista.replace(/ /g,"_");
    $.ajax({
        method: "POST",
        url: "abmLista.php",
        data: {nombre:nombreListaSinEspacios, operacion:"agregar"}
    })
        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == "OK") {
                location.href = "listas.php";
            }
        });
}

function ocultarModal(idModal){
    $("#"+idModal).modal("toggle");
}

function cambiarEstado(nombreItem){
    if(!$("."+nombreItem).hasClass("itemCompletado")){
        $("."+nombreItem).addClass("itemCompletado");
        itemsCompletados.push(nombreItem);
        $.ajax({
            method: "POST",
            url: "abmItem.php",
            data: {lista:idLista,nombreItem: nombreItem,operacion: "modificar", estado:false }
        })

        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == "OK") {
                location.href = "listaExpandida.php?idLista="+idLista;
            }
        });

    }

    else{
        $("."+nombreItem).removeClass("itemCompletado");
        for (let i = 0; i < itemsCompletadosInicial.length; i++) {
            if(itemsCompletados[i]===nombreItem){
                itemsCompletados.splice(i,1);
            }
        }
        $.ajax({
            method: "POST",
            url: "abmItem.php",
            data: {lista: idLista,nombreItem: nombreItem,operacion: "modificar", estado:true }
        })

        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == "OK") {
            location.href = "listaExpandida.php?idLista="+idLista;
            }
        });
    }
}

function mostrarItemsCompletados(){
        $(".itemCompletado").css("display","block");
        ocultarModal("modalModificarLista");
}

function mostrarItemsSinCompletar(){
        $(".itemCompletado").css("display","none");
        $("#itemsSinCompletar").html('Mostrar todos los items');
        $("#itemsSinCompletar").attr("onclick","mostrarItemsCompletados()");
        ocultarModal("modalModificarLista");
}

function cerrarItem(item) {
    console.log(item);
    event.preventDefault();
    // item=String(item);
    $("." + item).css("display", "none");
    $.ajax({
        method: "POST",
        url: "abmItem.php",
        data: {lista: idLista,nombreItem: item, operacion:"eliminar"}
    })
    .done(function (msg) {
        cerrarAnimacionCargando(false);
        if (msg == "OK") {
            location.href = "listaExpandida.php?idLista="+idLista;
        }
    });
}

function agregarItem(nombreItem, estado) {

    var nombreItemSinEspacios=nombreItem.replace(/ /g,"_");
    var nombreItemAux = "'" + nombreItemSinEspacios + "'";
    if(estado){
        $(".contenedorAgregarItem").append('<div class="contenedorParteInferior ' + nombreItemSinEspacios + ' itemsDeLaLista itemCompletado border-bottom border-top border-dark"><input type="checkbox" class="checkboxItem" checked onclick="cambiarEstado('+ nombreItemAux+')" >' + nombreItem + '<button type="button" onclick="cerrarItem(' + nombreItemAux + ')" class="close botonEliminar" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>');
        itemsCompletadosInicial.push(nombreItem);
        itemsCompletados.push(nombreItem);
    }
    else{
        $(".contenedorAgregarItem").append('<div class="contenedorParteInferior ' + nombreItemSinEspacios + ' itemsDeLaLista border-bottom border-top border-dark"><input type="checkbox" class="checkboxItem" onclick="cambiarEstado('+nombreItemAux+')">' + nombreItem + '<button type="button" onclick="cerrarItem(' + nombreItemAux + ')" class="close botonEliminar" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>');
    }
}


function ingresarNuevoItem() {
    console.log("entre");
    var itemIngresado = $(".inputIngresarItem").val();
    console.log(itemIngresado);
    if (itemIngresado == "") {
        $(".inputIngresarItem").removeClass("border-light");
        $(".inputIngresarItem").addClass("border-danger");
        setTimeout(function () {
            $(".inputIngresarItem").removeClass("border-danger");
            $(".inputIngresarItem").addClass("border-light");
        }, 1000);
    }
    else {
        console.log(itemIngresado);
        agregarItem(itemIngresado);
        itemIngresado=itemIngresado.replace(/ /g,"_");
        $(".inputIngresarItem").val('');
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "abmItem.php",
            data: {lista: idLista,nombreItem: itemIngresado,operacion: "agregar"}
            })
        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == "OK") {
               location.href = "listaExpandida.php?idLista="+idLista;
            }
        });
    }
}

function eliminarLista(){
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: "abmLista.php",
        data: {idLista:idLista, operacion:"eliminar"}
    })
    .done(function (msg) {
        cerrarAnimacionCargando(false);
        if (msg == "OK") {
            location.href = "listas.php";
        }
    });
}

function renombrarLista(){
    event.preventDefault();
    var nombreSinEspacio=$("#nuevoNombre").val().replace(/ /g,"_");
    $.ajax({
        method: "POST",
        url: "abmLista.php",
        data: {idLista:idLista, operacion:"modificar", nuevoNombre:nombreSinEspacio}
    })
    .done(function (msg) {
        cerrarAnimacionCargando(false);
        if (msg == "OK") {
            location.href = "listaExpandida.php?idLista="+idLista;
        }
    });
}