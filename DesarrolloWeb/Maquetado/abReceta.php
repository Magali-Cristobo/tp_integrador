<?php
session_start();
//const API_URL = 'http://localhost:8888/api/recetaExplorar/';
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


if(isset($_GET["operacion"])) {
    $respuesta=getUrl("http://localhost:8888/api/eliminarReceta/".(int)$_GET["id"]);
    header('Location: '.'misRecetas.php');
}

if(isset($_POST["ingredientesIngresados"])) {

    $datosAIngresar = json_encode($_POST);
    $json_ingresoUsuario = postUrl("http://localhost:8888/api/insertarReceta",$datosAIngresar);
}

?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estiloReceta.css">
    <link rel="stylesheet" href="estiloMisRecetas.css">
    <link rel="stylesheet" href="estilos.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="operacionesSesion.js"></script>
    <script src="operacionesRecetas.js"></script>

</head>
<body>
<title><?php echo $_GET["nombre"]?></title>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>


<br>

<h2 class='modal-title text-center tituloReceta'><?php echo $_GET["nombre"]?></h2>
<br>
<div class="container infoReceta">
    <form>
        <div class="row">
            <div class="col-5">
                <h5 class="titulo">Ingredientes:</h5>
                <div class="ingredientesItems">
                    <svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-plus-square botonAgregarIngrediente" onclick="agregarIngrediente()"
                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path fill-rule="evenodd"
                              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    <input type="text" placeholder="Ingrediente" class="inputIngresarIngrediente border border-light">
                </div>
            </div>
            <div class="divCantidad col-3">
                <br>
                <input type="number" class="inputCantidad" id="cantidad" min="1" placeholder="Cant.">
            </div>
            <div class="unidad col-4">
                <br>
                <select class="form-control inputUnidad" id="unidad">
                    <option>Lts.</option>
                    <option>Gr.</option>
                    <option>Kg.</option>
                    <option>Ml.</option>
                    <option>Cucharada</option>
                    <option>Taza</option>
                    <option>Pizca</option>
                    <option>Unidad</option>
                </select>
            </div>
        </div>
        <div class="itemsAgregados container"></div>
        <br>
            <div>
                <div class="masInformacion">
                    <h5 class="titulo">Dificultad:</h5>
                    <div class='ingresarCalificacion'>
                            <div id='divimagenModals'>
                                <img id='gorro1' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(1)'>
                                <img id='gorro2' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(2)'>
                                <img id='gorro3' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(3)'>
                                <img id='gorro4' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(4)'>
                                <img id='gorro5' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(5)'>
                            </div>
                        </div>
                </div>
            </div>
        <br>
    <div class="container">
        <div class="row">
            <div class="pasos">
                <h5 class="titulo">Preparación:</h5>
                    <div>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-square botonAgregarPaso" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="agregarPasoCrearReceta()">
                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        <input type="text" placeholder="Ingrese los pasos" class="inputIngresarPasos border border-light">
                    </div>
            </div>
    <!--        <div class="pasos container"></div>-->
        </div>
    </div>
    </form>
    <form>
        <div class="form-group">
            <label class="titulo" for="exampleFormControlFile1">Seleccione la foto del plato</label>
            <input type="file" class="form-control-file"  accept=".png, .jpg" id="imagen">
        </div>
    </form>
<br>
<div class="container contenedorBotones">
    <div class="row">
        <button class="btn " type="submit" id="botonGuardarMiReceta" onclick="insertarReceta(<?php echo $_SESSION['idUsuario']?>,' <?php echo $_GET['nombre']?>' )">
            Guardar
        </button>
    </div>
    <br>
    <div class="row">
        <p class="mensajeError" > Por favor complete todos los campos antes de guardar la receta</p>
    </div>
    <p id="imagenB64" ></p>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5>Elegí cuándo</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body' id='cuerpoModal'>
                <form class='datos'>
                    <div class="form-group">
                        <label for="diaSemana">Dia de la semana</label>
                        <select class="form-control" id="diaSemana">
                            <option>Lunes</option>
                            <option>Martes</option>
                            <option>Miercoles</option>
                            <option>Jueves</option>
                            <option>Viernes</option>
                            <option>Sabado</option>
                            <option>Domingo</option>
                        </select>
                        <label for="momentoDelDia">Momento del dia</label>
                        <select class="form-control" id="momentoDelDia">
                            <option>Desayuno</option>
                            <option>Almuerzo</option>
                            <option>Merienda</option>
                            <option>Cena</option>
                        </select>
                    </div>
                    <label>Cantidad de personas</label>
                    <br>
                    <input type='number' id="cantPersonas">
                    <br>
                    <input type='submit' id='botonAceptar' value='Aceptar' onclick="agregarRecetaMenu()">
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
<footer class="page-footer font-small blue fixed-bottom ">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script>
    $(document).ready(function(){
        var a = $( document ).height();
        $(".parteCargando").css("height", a + "px");
    });


    barraDeBusqueda();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>