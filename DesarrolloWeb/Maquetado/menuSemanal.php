<?php
session_start();
const API_URL = 'http://localhost:8888/api/menuSemanal/';

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
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}
$json_datosReceta = getUrl(API_URL . $_SESSION["idUsuario"]);
$datosReceta = json_decode($json_datosReceta, true);
$contador=0;
$momento=[];
$fecha=[];
?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estiloMenuSemanal.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
    <script src="operacionesMenuSemanal.js"></script>

</head>
<body>
<title>Menu Semanal</title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<br>
<br>
<div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
    <strong>Tu menu semanal.</strong> Tocá el plato y vas a poder elegir qué y cuándo comer.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container contenedor">
    <table class="table table-sm">
        <thead>
        <tr id="tituloMenu">
            <td class="titulo" colspan="5">Menu semanal</td>
        </tr>
        <tr class="filaFondoNaranja">
            <th scope="col">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-calendar-week " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                </svg>
            </th>
            <th scope="col">D</th>
            <th scope="col">A</th>
            <th scope="col">M</th>
            <th scope="col">C</th>
        </tr>
        </thead>
        <tbody>
        <tr class="FilaFondoBlanco diaDeLaSemana" id="Domingo">
            <th class="grillaOcupada" scope="row">D</th>
            <td id="DomingoDesayuno"></td>
            <td id="DomingoAlmuerzo"></td>
            <td id="DomingoMerienda"></td>
            <td id="DomingoCena"></td>
        </tr>
        <tr class="FilaFondoNaranja" id="Lunes">
            <th class="grillaOcupada" scope="row">L</th>
            <td id="LunesDesayuno"></td>
            <td id="LunesAlmuerzo"></td>
            <td id="LunesMerienda"></td>
            <td id="LunesCena"></td>
        </tr>
        <tr class="FilaFondoBlanco" id="Martes">
            <th class="grillaOcupada" scope="row">M</th>
            <td id="MartesDesayuno"></td>
            <td id="MartesAlmuerzo"></td>
            <td id="MartesMerienda"></td>
            <td id="MartesCena"></td>
        </tr>
        <tr class="FilaFondoNaranja" id="Miercoles">
            <th class="grillaOcupada" scope="row">X</th>
            <td id="MiercolesDesayuno"></td>
            <td id="MiercolesAlmuerzo"></td>
            <td id="MiercolesMerienda"></td>
            <td id="MiercolesCena"></td>
        </tr>
        <tr class="FilaFondoBlanco" id="Jueves">
            <th class="grillaOcupada" scope="row">J</th>
            <td id="JuevesDesayuno"></td>
            <td id="JuevesAlmuerzo"></td>
            <td id="JuevesMerienda"></td>
            <td id="JuevesCena"></td>
        </tr>
        <tr class="FilaFondoNaranja" id="Viernes">
            <th class="grillaOcupada" scope="row">V</th>
            <td id="ViernesDesayuno"></td>
            <td id="ViernesAlmuerzo"></td>
            <td id="ViernesMerienda"></td>
            <td id="ViernesCena"></td>
        </tr>
        <tr class="FilaFondoBlanco" id="Sabado">
            <th class="grillaOcupada" scope="row">S</th>
            <td id="SabadoDesayuno"></td>
            <td id="SabadoAlmuerzo"></td>
            <td id="SabadoMerienda"></td>
            <td id="SabadoCena"></td>
        </tr>
        </tbody>
    </table>
    <?php
    if($json_datosReceta!=null){
        foreach ($datosReceta as $datos) {
            foreach ($datos as $elementos){
                if(isset($elementos["error"])){?>
                    <div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
                        Algunas de las recetas guardadas han sido eliminadas por el autor.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                continue;
                }
                    $json_datosUnaReceta = getUrl("http://localhost:8888/api/recetaExplorar/".$elementos["idReceta"]);
                    $datosReceta = json_decode($json_datosUnaReceta, true);
                    foreach ($datosReceta as $datos) {
                        foreach ($datos as $elementos2){
                            $receta=$elementos2;
                        }
                    }
                    ?>
                    <script>
                        var momentoMenu="'" + '<?php echo $elementos["momento"]?>' + "'";
                        var diaMenu="'" + '<?php echo $elementos["fecha"]?>' + "'";
                        $("#<?php echo $elementos["fecha"].$elementos["momento"] ?>") . append ('<a onclick="mostrarModal(<?php echo $receta['clavePrimaria']?>, '+momentoMenu+', '+diaMenu+', <?php echo $elementos['cantidadPersonas']?>)"><img class="elegirReceta" src="<?php echo $receta["imagen"]?>"></a>')
                        $("#<?php echo $elementos["fecha"].$elementos["momento"] ?>").addClass("grillaOcupada");
                    </script>

              <?php
            }
        }
    }?>

    <script>
        var diasDeLaSemana=["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
        for(var j=0;j<diasDeLaSemana.length;j++){
            var padre = document.getElementById(diasDeLaSemana[j]);
            hijos = padre.childNodes;
            for(var i=0;i<hijos.length;i++){
                if(!$(hijos[i]).hasClass("grillaOcupada")){
                    $(hijos[i]) . append ("<a href='explorar.php'><img class='elegirReceta' src='Imagenes/plato.png'></a>")
                }
            }
        }
    </script>
</div>
<div class="modal fade" id="modalCerrarSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true' class="cruzCerrarModal">&times;</span>
            </button>
            <div class='modal-body' id='cuerpoModal'>
                <input type='submit' id="botonCerrarSesion" value='Cerrar sesion' onclick="cerrarSesion()">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalElegirOpcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true' class="cruzCerrarModal">&times;</span>
            </button>
            <div class='modal-body' id='cuerpoModal'>
                <button class="botonesModal" id="verReceta" onclick="abrirReceta()">Ver receta</button>
                <button class="botonesModal" id="eliminarDelMenu" onclick="eliminarDelMenu()">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="page-footer font-small fixed-bottom">
    <nav class="navbar navbar-light footer" style="height: 20px" style="background-color: #FEEEB3">
    </nav>
</footer>
</body>
<script>


    barraDeBusqueda();
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>