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
?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estiloListasRecetas.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <link rel="stylesheet" href="estilos.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
    <script src="operacionesListas.js"></script>
</head>
<body>
<title>Listas</title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<br>
<div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
    <strong>Tus listas.</strong> Crealas y editalas para una mejor organización.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<h4 class="tituloPagina">> Mis listas</h4>
<br>
<div class="container">
    <div class="row">
        <?php
        if(!array_key_exists("error", $datosLista)){
            foreach ($datosLista as $datos) {
                foreach ($datos as $elementos){?>
                    <div class='col-6'>
                        <button class='btn  btn-block botonConBorde' type='submit' id='hola'>
                            <a href='listaExpandida.php?idLista=<?php echo $elementos["clavePrimaria"]?>' class='tituloBoton' ><?php echo $elementos["nombre"]?></a></button>
                    </div>
                    <?php
                }
        }}
        ?>
        <div class="col-6 botonAniadir">
            <button class="btn  btn-block botonConBorde" type="submit" id="aniadir" data-toggle="modal" data-target="#modalCrearLista">
                <i class="fas fa-plus-circle"></i> Crea tu lista
            </button>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCrearLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5>Crea tu lista</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body' id='cuerpoModal'>
                <form class='datos'>
                    <div class="form-group">
                        <label for="nombreLista">Ingrese el nombre</label>
                        <input type="text" id="nombreLista" maxlength="25">
                    <br>
                    <input type='submit' id='botonAceptar' value='Aceptar' onclick="agregarLista()">
                </form>
            </div>
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
<footer class="page-footer font-small blue fixed-bottom ">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script>
    barraDeBusqueda();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
