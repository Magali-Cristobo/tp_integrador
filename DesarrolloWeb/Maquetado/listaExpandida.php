<?php
session_start();
const API_URL = 'http://localhost:8888/api/listaExpandida/';
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
$json_datosLista = getUrl(API_URL . $_SESSION["idUsuario"]);
$datosLista = json_decode($json_datosLista, true);
$contador=0;
$lista =[];
foreach ($datosLista as $datos) {
    foreach ($datos as $elementos){
        if($elementos["clavePrimaria"]==$_GET["idLista"]){
            $lista=$elementos;
        }
    }
}
$idLista= $_GET["idLista"];
?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estiloListaExpandida.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
    <script src="operacionesListas.js"></script>

</head>
<body>
<title><?php echo $lista["nombre"]?></title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<div class="partePrincipal">
    <div class="parteSuperior">
        <button class="botonOpciones" data-toggle="modal" data-target="#modalModificarLista">
            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalModificarLista" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Opciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" >&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-link botonOpcion" id="itemsSinCompletar"  onclick="mostrarItemsSinCompletar()" >Mostrar items sin completar</button>
                        <button class="btn btn-link botonOpcion"  id="eliminarLista" onclick="eliminarLista()">Eliminar lista</button>
                        <button class="btn btn-link botonOpcion" id="renombrarLista" data-toggle="modal" data-target="#modalRenombrarLista" onclick="ocultarModal('modalModificarLista')">Renombrar lista</button>
                    </div>
                </div>
            </div>
        </div>
        <p class="nombreLista"><?php echo $lista["nombre"]?></p>
    </div>
    <div class="parteInferior">
        <div class="contenedorParteInferior contenedorAgregarItem border-top border-bottom border-dark">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-square botonAgregarItem" onclick="ingresarNuevoItem()"
                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path fill-rule="evenodd"
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>

            <input type="text" placeholder="Producto Nuevo" class="inputIngresarItem border border-light">
        </div>
    </div>
</div>
<div class="modal fade" id="modalRenombrarLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5>Ingrese nuevo nombre</h5>
                <button type='button' class='close'  onclick="ocultarModal('modalRenombrarLista')">
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body' id='cuerpoModal'>
                <form class='datos'>
                    <input type='text' id="nuevoNombre">
                    <br>
                    <input type='submit' id='botonAceptar' value='Aceptar' onclick="renombrarLista()">
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
<!-- Footer -->
<footer class="page-footer font-small fixed-bottom">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script>
    $(document).ready(function (){
        indicarLista(<?php echo $_GET["idLista"]?>);
    });
    barraDeBusqueda();
</script>

<?php
foreach ($lista["items"] as $item){
    $estado = $item["estado"] ? "true" : "false";
    ?>
    <script>
        agregarItem("<?php echo $item['descripcion']?>",<?php echo $estado ?>);
    </script>
    <?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>