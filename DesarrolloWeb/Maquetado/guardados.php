<?php
session_start();
const API_URL = 'http://localhost:8888/api/guardados/';

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
    <title>Mis preferidas</title>
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="estilosExplorar.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
    <script src="barra.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="cargando.js"></script>
    <script src="operacionesSesion.js"></script>
</head>
<body>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>

<br>
<br>
<div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
    <strong>Tus guardados.</strong> Guardá una receta y consultala acá cuando quieras.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<h4 class="tituloPagina">> Mis preferidas</h4>
<br>
<div class="container">
    <div class="row">
        <?php
        if(!array_key_exists("error", $datosReceta)){
            foreach ($datosReceta as $receta){
                foreach ($receta as $recetita){
                    if($recetita[0]["clavePrimaria"]==-1){?>
                            <br>
                       <div class="alert alert-warning alert-dismissible fade show alerta" role="alert">
                        Algunas de las recetas guardadas han sido eliminadas por el autor.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <?php
                   continue;
                    }
                if($contador<=2){
                    ?>
                    <div class="col-4">
                        <a href="#">
                            <button class="btn btn-block botonExplorar" type="button" style="background-image: url('<?php echo $recetita[0]["imagen"]?>');"><a href='recetaMisGuardados.php?idReceta=<?php echo $recetita[0]["clavePrimaria"]?>' class='nav-link'></a></button>
                        </a>
                        <span class="tituloReceta"><?php echo $recetita[0]["titulo"]?></span>
                    </div>
                    <?php
                    $contador++;
                }
                else{
                $contador=1;
        ?>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <a href="home.php">
                <button class="btn btn-block botonExplorar" type="button" style="background-image: url('<?php echo $recetita[0]["imagen"]?>');"><a href='recetaMisGuardados.php?idReceta=<?php echo $recetita[0]["clavePrimaria"]?>' class='nav-link'></a></button>
            </a>
            <span class="tituloReceta"><?php echo $recetita[0]["titulo"] ?></span>
        </div>
        <?php
        }}}}?>
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

<footer class="page-footer font-small blue fixed-bottom">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script>
    barraDeBusqueda();
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
