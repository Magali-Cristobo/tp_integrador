<?php
    session_start();
function getUrl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function postUrl($url, $parametros){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}
$json_imagenes=getUrl("localhost:8888/api/traerImagenesPlatos");
$imagenes=json_decode($json_imagenes, true);
?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilosHome.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
    <script src="barraDeBusqueda.js"></script>
</head>
<body>
<title>Listo el pollo</title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light">
    <form class="form-inline elementosNavBar " >
        <input class="col-7 form-control barraDeBusqueda"  id="barraDeBusqueda" type="search" placeholder="Busca una receta" aria-label="Search"  data-toggle="modal"
               data-target="#exampleModal" list="titulosReceta" >
        <button type="button" class="btn  botonIniciarSesion col-4" data-toggle="modal" data-target="#exampleModal"
                id="iniciarSesionNavBar" type="submit"  >Iniciar sesion
        </button>
        <button type="button" class="btn btn-circle  botonIniciarSesion" data-toggle="modal" data-target="#modalCerrarSesion" id="botonSesionIniciada"  type="submit"></button>
    </form>
</nav>
<div class="container">
<div id="carouselInicio" class="carousel slide">
    <div class="carousel-inner carousel">
        <div class="carousel-item active">
            <img  src="<?php echo $imagenes[0]['imagen']?>" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block tituloReceta">
               <a class="tituloPlatoCarousel" href="recetaExplorar.php?idReceta=<?php echo $imagenes[0]['id']?>"><?php echo $imagenes[0]["titulo"]?></a>
            </div>
        </div>
        <div class="carousel-item ">
            <img  src="<?php echo $imagenes[1]['imagen']?>" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block tituloReceta">
                <a class="tituloPlatoCarousel" href="recetaExplorar.php?idReceta=<?php echo $imagenes[1]['id']?>"><?php echo $imagenes[1]["titulo"]?></a>
            </div>
        </div>
        <div class="carousel-item ">
            <img  src="<?php echo $imagenes[2]['imagen']?>" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block tituloReceta">
                <a  class="tituloPlatoCarousel" href="recetaExplorar.php?idReceta=<?php echo $imagenes[2]['id']?>"><?php echo $imagenes[2]["titulo"]?></a>
            </div>
        </div>
        <div class="carousel-item ">
            <img  href="recetaExplorar.php?idReceta=<?php echo $imagenes[3]['id']?>" src="<?php echo $imagenes[3]['imagen']?>" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block tituloReceta">
                <a class="tituloPlatoCarousel" href="recetaExplorar.php?idReceta=<?php echo $imagenes[3]['id']?>"><?php echo $imagenes[3]["titulo"]?></a>
            </div>
        </div>
        <div class="carousel-item">
            <img  href="recetaExplorar.php?idReceta=<?php echo $imagenes[4]['id']?>" src="<?php echo $imagenes[4]['imagen']?>" class="d-block w-100 imagenCarousel">
            <div class="carousel-caption d-md-block tituloReceta">
                <a class="tituloPlatoCarousel" href="recetaExplorar.php?idReceta=<?php echo $imagenes[4]['id']?>"><?php echo $imagenes[4]["titulo"]?></a>
            </div>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-4">
            <button class="btn  btn-block boton" type="submit" id="menuSemanal" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('menuSemanal', <?php echo isset($_SESSION["idUsuario"])?>)"><a href="#" class="redireccionamiento">¿Que comemos?</a>
            </button>
        </div>
        <div class="col-4">
            <button class="btn  btn-block boton" id="explorar" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('explorar', <?php echo isset($_SESSION["idUsuario"])?>)"><a href="#" class="redireccionamiento">Recetario</a></button>
        </div>
        <div class="col-4">
            <button class="btn btn-lg boton" id="listaDeCompras" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('listas',<?php echo isset($_SESSION["idUsuario"])?>)"><a href="#" class="redireccionamiento">Listas de compras</a>
            </button>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-4">
            <button class="btn  btn-block boton" id="misRecetas" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('misRecetas',<?php echo isset($_SESSION["idUsuario"])?>)"><a href="#" class="redireccionamiento">Mis creaciones</a>
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-block boton" id="guardados" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('guardados',<?php echo isset($_SESSION["idUsuario"])?>)"><a href="#" class="redireccionamiento">Mis preferidas</a>
            </button>
        </div>
        <div class="col-4">
            <button class="btn  btn-block boton" id="miDespensa" type="submit" data-toggle="modal"
                    data-target="#exampleModal" onclick="chequearInicioSesion('miDespensa',<?php echo isset($_SESSION["idUsuario"])?>)"><a href="#" class="redireccionamiento">Mi despensa</a>
            </button>
        </div>
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
<div class="modal fade modalIniciarSesion" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form class="iniciarSesion" onsubmit="login()">
                    <input class="inputModals" id="correoElectronico" type="email" name="mail"
                           placeholder="Ingrese el correo electronico" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <div class="input-group" id="mostarContrasenia">
                        <input type="password" class="inputModals" id="clave" placeholder="Ingrese su contraseña"
                               name="clave">
                        <div class="contraseniaOculta">
                            <a class="ojoContrasenia" href="#"><i class="fa fa-eye-slash"></i></a>
                        </div>
                    </div>
                    <input type="checkbox">
                    <label for="remember"> Recordarme</label>
                    <input type="submit" class="botonesModal" value="Ingresar" >
                    <p class="mensajeError"></p>
                    <button id="facebook" class="redes">
                        <i class="fab fa-facebook-f "></i>
                        Acceder con Facebook
                    </button>
                    <button id="google" class="redes">
                        <i class="fab fa-google"></i>
                        Acceder con Google
                    </button>

                </form>
                <form class="registrarse" onsubmit="crearCuenta()">
                    <input class="inputModals" id="correoElectronicoRegistrarse" type="email" name="mail"
                           placeholder="Correo electronico (ejemplo@mail.com)" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <input class="inputModals" id="nombreUsuario" type="text" name="usuario"
                           placeholder="Nombre de usuario" pattern=".{5,}" title="Cinco o más caracteres" required>
                    <div class="input-group" id="mostarContrasenia">
                        <input type="password" class="inputModals" id="claveRegistrarse"
                               placeholder="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="Debe contener al menos un número, una mayúscula y una minúscula, y al menos 8 o más caracteres">
                        <div class="contraseniaOculta">
                            <a class="ojoContrasenia" href="#"><i class="fa fa-eye-slash "></i></a>
                        </div>
                    </div>
                    <input type="password" class="inputModals" id="confirmarClaveRegistrarse"
                           placeholder="Repita la contraseña" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Debe contener al menos un número, una mayúscula y una minúscula, y al menos 8 o más caracteres">
                    <input type="checkbox">
                    <label for="remember"> Me gustaria recibir notificaciones</label>
                    <input class="botonesModal" type="submit" value="Crear cuenta" >
                    <p class="mensajeError"></p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCerrarSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true' class="cruzCerrarModal">&times;</span>
            </button>
            <div class='modal-body' id='cuerpoModal'>
                <input type='submit' id='botonCerrarSesion' value='Cerrar sesion' onclick="cerrarSesion()">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(mostrarCirculo(<?php echo isset($_SESSION["idUsuario"])?>));
    barraDeBusqueda();
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
