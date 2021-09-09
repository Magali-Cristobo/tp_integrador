var proximaPagina = "home.php";

function cerrarSesion(){
    $.ajax({
        method: "POST",
        url: "cerrarSesion.php"
    })
        .done(function (msg) {
            if (msg == "OK") {
                cerrarAnimacionCargando(false);
                location.href = "home.php";
            }
        });
}

function definirProximaPagina(nombrePagina) {
    proximaPagina = nombrePagina + ".php";
}

function chequearInicioSesion(nombrePagina, sesionIniciada) {
    if (sesionIniciada) {
        $(".redireccionamiento").attr("href", nombrePagina + ".php");
    } else {
        definirProximaPagina(nombrePagina);
    }
}

function mostrarCirculo(sesionIniciada) {
    if (sesionIniciada) {
        $("#botonSesionIniciada").css("display", "block");
        $("#iniciarSesionNavBar").css("display", "none");
        $(".barraDeBusqueda").addClass("col-9");
        $(".modalIniciarSesion").remove();
    } else {
        $(".tituloPlatoCarousel").attr("href", "#");
    }
}

function registrarse() {
    $(".mensajeError").css("visibility", "hidden");
    $(".iniciarSesion").css("display", "none");
    $(".registrarse").css("display", "block");
    $("#registrarseModal").css("color", "#F2AF5C");
    $("#iniciarSesionModal").css("color", "gray");
}

function iniciarSesion() {
    $(".mensajeError").css("visibility", "hidden");
    $(".registrarse").css("display", "none");
    $(".iniciarSesion").css("display", "block");
    $("#iniciarSesionModal").css("color", "#F2AF5C");
    $("#registrarseModal").css("color", "gray");

}

$(document).ready(function () {
    $("#mostarContrasenia a").on('click', function (event) {
        if ($('#mostarContrasenia input').attr("type") == "text") {
            $('#mostarContrasenia input').attr('type', 'password');
            $('#mostarContrasenia i').addClass("fa-eye-slash");
            $('#mostarContrasenia i').removeClass("fa-eye");
        } else if ($('#mostarContrasenia input').attr("type") == "password") {
            $('#mostarContrasenia input').attr('type', 'text');
            $('#mostarContrasenia i').removeClass("fa-eye-slash");
            $('#mostarContrasenia i').addClass("fa-eye");
        }
    });
    $('#carouselInicio').carousel({
        interval: 2000
    });
});

function login() {
    event.preventDefault();
    $(".mensajeError").css("visibility", "hidden");
    $.ajax({
        method: "POST",
        url: "chequearUsuario.php",
        data: {mail: $("#correoElectronico").val(), clave: $("#clave").val(), operacion: "login"}
    })
        .done(function (msg) {
            cerrarAnimacionCargando(false);
            if (msg == "OK") {
                location.href = proximaPagina;
            }
            else{
                $(".mensajeError").html("El usuario y/o la contraseña no coinciden");
                $(".mensajeError").css("visibility", "visible");
                cerrarAnimacionCargando(true);
            }
        });
}

function crearCuenta() {
    $(".mensajeError").css("visibility", "hidden");

    event.preventDefault();
    var nombre = $("#nombreUsuario").val();
    var contrasenia = $("#claveRegistrarse").val();
    var contrasenia2 = $("#confirmarClaveRegistrarse").val();
    var mail = $("#correoElectronicoRegistrarse").val();


    if (contrasenia === contrasenia2) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "chequearUsuario.php",
            data: {nombre: nombre, contrasenia: contrasenia, mail: mail,operacion:"crearCuenta"}
        })
            .done(function (msg) {
                if (msg === "OK") {
                    $("#correoElectronicoRegistrarse").removeClass("border-light");
                    $("#nombreUsuario").removeClass("border-light");
                    location.href = proximaPagina;
                }
                if(msg==="nombreRepetido"){
                    $("#nombreUsuario").addClass("border-danger");
                    $(".mensajeError").html("El nombre de usuario ya existe");
                    $(".mensajeError").css("visibility", "visible");

                }
                else {
                    $("#nombreUsuario").removeClass("border-danger");
                }
                if(msg==="mailRepetido"){
                    $("#correoElectronicoRegistrarse").addClass("border-danger");
                    $(".mensajeError").html("El mail ya fue utilizado");
                    $(".mensajeError").css("visibility", "visible");
                }
                else{
                    $("#correoElectronicoRegistrarse").removeClass("border-danger");

                }
                cerrarAnimacionCargando(true);
            });

    }
    else {
        $("#confirmarClaveRegistrarse").addClass("border-danger");
        $("#claveRegistrarse").addClass("border-danger");
        $(".mensajeError").html("Las contraseñas no coinciden");
        $(".mensajeError").css("visibility", "visible");
    }

}