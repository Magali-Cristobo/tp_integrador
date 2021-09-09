<?php
session_start();
const API_URL = 'http://localhost:8888/api/miDespensa/';

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

$json_productos = getUrl(API_URL . $_SESSION["idUsuario"]);
$productos = json_decode($json_productos, true);
$contador=0;
?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="estilosMiDespensa.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
</head>
<body>
<title>Mi despensa</title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<br>
<div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
    <strong>Tu despensa.</strong> Consultá los productos que escaneaste.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="container contenedor">
    <label>Lacteos</label>
    <div class="gallery js-flickity Lacteos" data-flickity-options='{ "wrapAround": true,  "pageDots": false }'></div>
    <br>
    <label>Condimentos</label>
    <div class="gallery js-flickity Condimentos" data-flickity-options='{ "wrapAround": true,  "pageDots": false }'></div>
    <br>
    <label>Quesos untables</label>
    <div class="gallery js-flickity QuesosUntables" data-flickity-options='{ "wrapAround": true,  "pageDots": false }'></div>
    <br>
    <label>Pastas </label>
    <div class="gallery js-flickity Pastas" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'></div>
    <br>
    <br>
    <label>Endulzantes </label>
    <div class="gallery js-flickity Endulzantes" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'></div>
    <br>
    <label>Bebidas gasificadas</label>
    <div class="gallery js-flickity BebidasGasificadas" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'></div>
    <br>
    <label>Verduleria</label>
    <div class="gallery js-flickity Verduleria" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'></div>
    <br>
    <label>Infusiones</label>
    <div class="gallery js-flickity Infusiones" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'></div>
    <br>
    <label>Harinas</label>
    <div class="gallery js-flickity Harinas" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'></div>
    <?php
    if(!array_key_exists("error", $productos)){
        foreach ($productos as $productosDespensa){
            foreach ($productosDespensa as $datosProducto ){
                $json_datosUnProducto = getUrl("http://localhost:8888/api/productos/".$datosProducto["producto"]);
                $datosUnProducto = json_decode($json_datosUnProducto, true);
                foreach ($datosUnProducto as $elementos){
                    $producto=$elementos;
                    $imagen=$elementos["imagen"];
                    $cantidad=$datosProducto["cantidad"];
                    ?>
        <script language="JavaScript" type="text/javascript">
            $(".<?php echo $elementos['categoria']?>").append("<div class='gallery-cell' style='background-image: url("+'<?php echo $imagen ?>'+"); background-position: center' data-toggle='popover'' title='Cantidad'' data-content='<?php echo $cantidad?>'></div>");
        </script>
        <?php
        }
        }
        }}
    ?>

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
<footer class="page-footer font-small blue fixed-bottom">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script>
    function ocultarPopUp() {
        $('[data-toggle="popover"]').popover('hide');
    }

    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });

    $('[data-toggle="popover"]').on('show.bs.popover', function () {
        setTimeout(ocultarPopUp, 1000);
    });
    barraDeBusqueda();
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>