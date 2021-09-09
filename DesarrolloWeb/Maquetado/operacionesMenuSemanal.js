var ultimaReceta;
var cantPersonasMenu;
function mostrarModal(idReceta, momento, dia, cantidadPersonas){
    ultimaReceta=idReceta;
    momentoMenu=momento;
    diaMenu=dia;
    cantPersonasMenu=cantidadPersonas;
    $("#modalElegirOpcion").modal("show");
}
function abrirReceta(){
    location.href='recetaMenuSemanal.php?idReceta='+ultimaReceta;
}
function eliminarDelMenu(){
    $.ajax({
        method: "POST",
        url: "abAlMenu.php",
        data: {idReceta: ultimaReceta,momento: momentoMenu, fecha:diaMenu, cantPersonas:cantPersonasMenu, operacion: "eliminar"}
    })
        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == "OK") {
                location.href = "menuSemanal.php";
            }
        });
}