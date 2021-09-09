<?php
    session_start();
    if (isset($_SESSION["SESION_INICIADA"])){
        session_destroy();
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
</head>
<body>
<title>Cocinando</title>
<nav class="navbar navbar-light">
    <form class="form-inline" style="height: 38px; width: 100%">
        <input class="col-7 form-control barraDeBusqueda" type="search" placeholder="Search" aria-label="Search">
        <button type="button" class="btn  botonIniciarSesion col-4" data-toggle="modal" data-target="#exampleModal"
                id="iniciarSesionNavBar" type="submit" style="position: absolute;right: 15px">Iniciar sesion
        </button>
        <button type="button" class="btn btn-circle  botonIniciarSesion" data-toggle="modal" data-target="#exampleModal"
                id="botonSesionIniciada" type="submit" style="position: absolute; top: 4px"></button>
    </form>
</nav>
<div class="container">
<div id="carouselInicio" class="carousel slide">
    <div class="carousel-inner carousel">
        <div class="carousel-item active">
            <img src="../img/PlatosComida/muslos-de-pollo-al-horno-receta.png" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block">
                <label class="tituloPlatoCarousel">Muslos de pollo</label>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../img/PlatosComida/ravioles1.png" class="d-block w-100 imagenCarousel" alt="">
            <div class="carousel-caption d-md-block">
                <label class="tituloPlatoCarousel">Ravioles</label>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../img/PlatosComida/receta-wok-de-cerdo.png" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block">
                <label class="tituloPlatoCarousel">Wok de cerdo</label>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../img/PlatosComida/salmon_rosado_con_salsa_a_las_hierbas_y_guarnicion_de_vegetales_0.png"
                 class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block">
                <label class="tituloPlatoCarousel">Salmon</label>
            </div>
        </div>
    </div>
</div>
<br>
    <div class="row">
        <div class="col-4">
            <button class="btn  btn-block boton" type="submit" id="menuSemanal" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('menuSemanal')"><a href="#" class="redireccionamiento">Menu semanal</a>
            </button>
        </div>
        <div class="col-4">
            <button class="btn  btn-block boton" id="explorar" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('explorar')"><a href="#" class="redireccionamiento">Explorar</a>            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-lg boton" id="listaDeCompras" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('listas')"><a href="#" class="redireccionamiento">Listas de compras</a>
            </button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <button class="btn  btn-block boton" id="misRecetas" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('misRecetas')"><a href="#" class="redireccionamiento">Mis recetas</a>
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-block boton" id="guardados" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('guardados')"><a href="#" class="redireccionamiento">Guardados</a>
            </button>
        </div>
        <div class="col-4">
            <button class="btn  btn-block boton" id="miDespensa" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('miDespensa')"><a href="#" class="redireccionamiento">Mi despensa</a>
            </button>
        </div>
    </div>
</div>
<br>
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom">
    <nav class="navbar navbar-light " style="height: 20px">
    </nav>
</footer>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a class="modal-title col-5" id="iniciarSesionModal" onclick="iniciarSesion()"
                   style="text-decoration: none"><h6 class='modal-title text-center'>Iniciar sesion</h6></a>
                <a class="modal-title col-5" id="registrarseModal" onclick="registrarse()"
                   style="text-decoration: none"><h6 class=' modal-title text-center'>Registrarse</h6></a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="iniciarSesion">
                    <input class="inputModals" id="correoElectronico" type="email" name="mail"
                           placeholder="Ingrese el correo electronico">
                    <div class="input-group" id="mostarContrasenia">
                        <input type="password" class="inputModals" id="clave" placeholder="Ingrese su contraseña"
                               name="clave">
                        <div class="contraseniaOculta">
                            <a class="ojoContrasenia" href="#"><i class="fa fa-eye-slash"></i></a>
                        </div>
                    </div>
                    <input type="checkbox">
                    <label for="remember"> Recordarme</label>
                    <input type="submit" class="botonesModal" value="Ingresar" onclick="login()">
                    <button id="facebook" class="redes">
                        <i class="fab fa-facebook-f "></i>
                        Acceder con Facebook
                    </button>
                    <button id="google" class="redes">
                        <i class="fab fa-google"></i>
                        Acceder con Google
                    </button>

                </form>
                <form class="registrarse">
                    <input class="inputModals" id="nombreUsuario" type="text" name="usuario"
                           placeholder="Ingrese el nombre de usuario">
                    <input class="inputModals" id="correoElectronicoRegistrarse" type="email" name="mail"
                           placeholder="Ingrese el correo electronico">
                    <div class="input-group" id="mostarContrasenia">
                        <input type="password" class="inputModals" id="claveRegistrarse"
                               placeholder="Ingrese su contraseña">
                        <div class="contraseniaOculta">
                            <a class="ojoContrasenia" href="#"><i class="fa fa-eye-slash "></i></a>
                        </div>
                    </div>
                    <input type="password" class="inputModals" id="confirmarClaveRegistrarse"
                           placeholder="Repita la contraseña">
                    <input type="checkbox">
                    <label for="remember"> Me gustaria recibir notificaciones</label>
                    <input class="botonesModal" type="submit" value="Crear cuenta">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(mostrarCirculo());
    var proximaPagina = "home.php";

    function chequearInicioSesion(nombrePagina){
        <?php if (isset($_SESSION["SESION_INICIADA"])){?>
            $(".redireccionamiento").attr("href",nombrePagina+".php");
        <?php }
        else{ ?>
          definirProximaPagina(nombrePagina);
        <?php } ?>
    }

    function definirProximaPagina(nombrePagina) {
        proximaPagina = nombrePagina + ".php";
    }

    function mostrarCirculo() {
        <?php if (isset($_SESSION["SESION_INICIADA"])){?>
            $("#botonSesionIniciada").css("display", "block");
            $("#iniciarSesionNavBar").css("display", "none");
            $(".barraDeBusqueda").addClass("col-9");
            $(".fade").remove();
        <?php }?>
    }

    function registrarse() {
        $(".iniciarSesion").css("display", "none");
        $(".registrarse").css("display", "block");
        $("#registrarseModal").css("color", "#F2AF5C");
        $("#iniciarSesionModal").css("color", "gray");
    }

    function iniciarSesion() {
        $(".registrarse").css("display", "none");
        $(".iniciarSesion").css("display", "block");
        $("#iniciarSesionModal").css("color", "#F2AF5C");
        $("#registrarseModal").css("color", "gray");

    }

    $(document).ready(function () {
        console.log("entre");
        $("#mostarContrasenia a").on('click', function (event) {
//        event.preventDefault();
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
        $.ajax({
            method: "POST",
            url: "chequearUsuario.php",
            data: {mail: $("#correoElectronico").val(), clave: $("#clave").val()}
        })
            .done(function (msg) {
                if (msg == "OK") {
                    location.href = proximaPagina;
                }
            });
    }
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
