<?php
session_start();
const API_URL = 'http://localhost:8888/api/recetaExplorar/';

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
if (isset($_GET["operacion"])){
    $calificacion = [
        'id' => (int) $_GET["idReceta"],
        'calificacion' => (int) $_GET["calificacion"],
        'idUsuario' => (int)$_SESSION["idUsuario"]
    ];
    $json_recetas = postUrl("http://localhost:8888/api/agregarCalificacion",json_encode($calificacion));
    header('Location: '.'recetaExplorar.php?idReceta='.(int)$_GET["idReceta"]);

}
$json_datosReceta = getUrl(API_URL . (int) $_GET["idReceta"]);
$datosReceta = json_decode($json_datosReceta, true);
$contador = 0;
$receta = ["id", $_GET["idReceta"]];
foreach ($datosReceta as $datos) {
    foreach ($datos as $elementos) {
        $receta = $elementos;
    }
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
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
    <script src="operacionesRecetas.js"></script>
</head>
<body>
<title> <?php echo $receta["titulo"]?></title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<br>

<h2 class='modal-title text-center tituloReceta'><?php echo $receta["titulo"]?></h2>
<br>
<div class="container infoReceta">
    <div class="row">
        <div class="col-5"><h5 class="ingredientesTitulo">Ingredientes:</h5>
            <br>
            <div class="ingredientesItems">
                <?php
                    foreach ($receta["ingredientes"] as $ingredientes){
                ?>
                        <h6 class="items"><i class="fas fa-utensil-spoon"></i> <?php echo $ingredientes["cantidad"]." ".$ingredientes["unidad"]." ".$ingredientes["nombre"]?></h6>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="col-7 ">
            <div class="masInformacion">
                <h5 class="informacionExtra">Dificultad:
                <?php
                        for ($i=0;$i<$receta["dificultad"];$i++){?>
                            <img class="gorroChef" src="Imagenes/Gorro%20de%20chef.png">
                            <?php
                        }
                    ?>
                </h5>
            </div>
            <h5 class="informacionExtra">Puntaje:
                <?php
                if($receta["puntaje"]!=0){
                    for ($i=0;$i<$receta["puntaje"];$i++){?>
                        <img class="limones" src="Imagenes/Limon.png">
                        <?php
                    }
                }
                else{
                    ?> Aún no tiene calificaciones <?php
                }
                ?>

            </h5>
            <h5 class="informacionExtra">Autor:
                <?php
                $json_nombreUsuario = getUrl("http://localhost:8888/api/traerNombreUsuario/" . $receta["autor"]);
                $nombreUsuario = json_decode($json_nombreUsuario, true);
                echo $nombreUsuario["nombreUsuario"];
                ?>
            </h5>
        </div>

    </div>
</div>
<br>
<br>

<div class="container">
    <h5 class="ingredientesTitulo">Preparación:</h5>
    <br>
    <?php
    $contador=1;
    foreach ($receta["preparacion"] as $pasos){
        ?>
        <h6 class="items"> <?php echo $contador . $pasos?></h6>
        <?php
        $contador++;
    }
    ?>
</div>
<br>
<br>
<br>

<div class="container contenedorBotones">
    <?php
    $json_comprobarCalificacion=getUrl("http://localhost:8888/api/comprobarCalificacion/".$_GET["idReceta"]."/".$_SESSION["idUsuario"]);
    $comprobacion = $json_comprobarCalificacion === 'true'? true: false;
    if( (int)$receta["autor"] != $_SESSION["idUsuario"] && !$comprobacion){ ?>
        <div class="row">
            <a class="dropdown-item puntuarReceta" href="#" data-toggle="modal" data-target="#modalPuntuarReceta">Puntuá la receta</a>
            <div class="modal fade modalForms" id="modalPuntuarReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5>Seleccione la calificacion</h5>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button></div><div class='modal-body' id='cuerpoModal'>
                            <form class='ingresarCalificacion'>
                                <div id='divimagenModals'>
                                    <img id='limon1' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(1)'>
                                    <img id='limon2' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(2)'>
                                    <img id='limon3' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(3)'>
                                    <img id='limon4' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(4)'>
                                    <img id='limon5' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(5)'>
                                </div>
                                <input type='submit' id='botonAceptar' value='Aceptar' onclick='aniadirCalificacion( <?php echo $_GET['idReceta'] ?>)'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <button class="btn  boton" type="submit" id="botonAniadirAlMenu" data-toggle="modal"
                data-target="#modalAniadirAlMenu" >Añadir al menu
        </button>
        <button class="btn  boton" type="submit" id="botonGuardarIzquierda" onclick="agregarGuardado(<?php echo $_GET['idReceta'] ?>)">
            Guardar
        </button>
    </div>
</div>
<div class="modal fade" id="modalAniadirAlMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <select class="form-control modalAniadirAlMenu" id="diaSemana">
                            <option>Lunes</option>
                            <option>Martes</option>
                            <option>Miercoles</option>
                            <option>Jueves</option>
                            <option>Viernes</option>
                            <option>Sabado</option>
                            <option>Domingo</option>
                        </select>
                        <label for="momentoDelDia">Momento del dia</label>
                        <select class="form-control modalAniadirAlMenu" id="momentoDelDia">
                            <option>Desayuno</option>
                            <option>Almuerzo</option>
                            <option>Merienda</option>
                            <option>Cena</option>
                        </select>
                    </div>
                    <label>Cantidad de personas</label>
                    <br>
                    <input type='number' class="modalAniadirAlMenu" id="cantPersonas" min="1">
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
    $(document).ready(function (){
        <?php
        $recetaGuardada=false;
        $json_datosRecetasGuardadas = getUrl('http://localhost:8888/api/guardados/' . $_SESSION["idUsuario"]);
        $datosRecetasGuardadas = json_decode($json_datosRecetasGuardadas, true);
        foreach ($datosRecetasGuardadas as $receta) {
            foreach ($receta as $recetita) {
                if ($recetita[0]["clavePrimaria"] == $_GET["idReceta"]) {
                    $recetaGuardada = true;
                }
            }
        }
        if($recetaGuardada){ ?>
        $("#botonGuardarIzquierda").html("No guardar");
        $("#botonGuardarIzquierda").attr("onclick","eliminarGuardados(<?php echo $_GET['idReceta'] ?> )");
        <?php } ?>
    });

    function agregarRecetaMenu(){
        event.preventDefault();
        var momento=$("#momentoDelDia").val();
        var dia=$("#diaSemana").val();
        var diaYMomentoElegido=[dia, momento];
        var arregloDeDiasYMomentos = [];
        var grillaOcupada=false;
        if ($("#cantPersonas").val()!="" && $("#cantPersonas").val()>0) {
            <?php
            $json_datosMenu = getUrl("http://localhost:8888/api/menuSemanal/" . $_SESSION["idUsuario"]);
            $datosMenu = json_decode($json_datosMenu, true);
            if($json_datosMenu!=null){
                foreach ($datosMenu as $datos) {
                    foreach ($datos as $elementos){ ?>
                        var diaYMomento =[];
                        diaYMomento.push( '<?php echo $elementos["fecha"] ?>');
                        diaYMomento.push(  '<?php echo $elementos["momento"];?>')
                        arregloDeDiasYMomentos.push(diaYMomento);
                    <?php
                    }
                }
            }
            ?>
            for (let i = 0; i < arregloDeDiasYMomentos.length; i++ ) {
                if(JSON.stringify(arregloDeDiasYMomentos[i])==JSON.stringify(diaYMomentoElegido)){
                    grillaOcupada=true;
                    $(".datos").append("<p class='errorAlAgregar'> Ya tiene ocupado ese lugar en el menú </p>");
                    break;
                }
            }
            if(!grillaOcupada){
                $.ajax({
                    method: "POST",
                    url: "abAlMenu.php",
                    data: {idReceta: <?php echo $_GET["idReceta"]?>,momento: momento, fecha:dia, cantPersonas:parseInt($("#cantPersonas").val()), operacion: "agregar"}
                })
                    .done(function (msg) {
                        if (msg == "OK") {
                            location.href = "menuSemanal.php";
                        }
                    });
            }
        }
    }
    barraDeBusqueda();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>