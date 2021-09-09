<?php
session_start();
const API_URL = 'http://localhost:8888/api/recetaMisRecetas/';

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
?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="estiloListasRecetas.css">
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
<title>Mis creaciones</title>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<br>
<br>
<div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
    <strong>Tus creaciones.</strong> Animate a innovar y compartí tus creaciones.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<h4 class="tituloPagina">> Mis creaciones
</h4>
<br>
<div class="container">
    <div class="row">
        <?php
            if(!array_key_exists("error", $datosReceta)){
                foreach ($datosReceta as $datos) {
                    foreach ($datos as $elementos){?>
                        <div class='col-6'>
                            <button class='btn  btn-block botonConBorde' type='submit' id='receta'>
                                <a href='recetaMisRecetas.php?idReceta=<?php echo $elementos["clavePrimaria"]?>' class="tituloBoton"><?php echo $elementos["titulo"]?></a> </button>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        <div class="col-6 botonAniadir">
            <button class="btn  btn-block botonConBorde" type="submit" id="aniadir" data-toggle="modal"
                    data-target="#modalReceta"><i class="fas fa-plus-circle"></i> Crea tu receta
            </button>
        </div>
    </div>
</div>
<div class="modal fade" id="modalReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5>Ingrese el nombre de la receta</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body' id='cuerpoModal'>
                <form class='datos'>
                    <input type='text' id="nuevoNombre" maxlength="30">
                    <br>
                    <input type='submit' id='botonAceptar' value='Aceptar' onclick="agregarReceta()">
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
<footer class="page-footer font-small blue fixed-bottom ">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
<script>

    barraDeBusqueda();
</script>