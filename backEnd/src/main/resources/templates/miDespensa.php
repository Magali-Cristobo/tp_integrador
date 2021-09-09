<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilosMiDespensa.css">
    <link rel="stylesheet" href="../css/estiloListas.css">
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
</head>
<body>
<title>Mi despensa</title>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md" style="background-color: #FEEEB3">
    <form class="form-inline" style="width: 90%">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation"
                style="margin-top:7px;margin-bottom: -8px">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav flex-row ml-auto justify-content-between" style="display: block">
                <br>
                <li class="nav-item"><a href="home.php" class="nav-link">Inicio</a></li>
                <li class="nav-item"><a href="explorar.php" class="nav-link item">Explorar</a></li>
                <li class="nav-item"><a href="guardados.php" class="nav-link">Guardados</a></li>
                <li class="nav-item"><a href="misRecetas.php" class="nav-link">Mis recetas</a></li>
                <li class="nav-item"><a href="menuSemanal.php" class="nav-link">Menu semanal</a></li>
                <li class="nav-item"><a href="listas.php" class="nav-link">Lista de compras</a></li>
            </ul>
        </div>
        <input class="form-control col-6 barraDeBusqueda" type="search" placeholder="Search" aria-label="Search"
               style="margin: 0 auto;position: absolute; left: 27%; top: 16px">
        <button type="button" class="btn btn-default btn-circle botonIniciarSesion" data-toggle="modal"
                data-target="#exampleModal" id="iniciarSesionNavBar" type="submit"
                style="position: absolute; top: 12px"></button>
    </form>
</nav>
<br>
<div class="container contenedor">
    <label>Lacteos</label>
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true,  "pageDots": false }'>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/arrozConPollo.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/canelones.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/muslos-de-pollo-al-horno-receta.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/ravioles.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/receta-wok-de-cerdo.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
    </div>
    <br>
    <label>Carniceria y pescaderia</label>
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/arrozConPollo.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/canelones.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/muslos-de-pollo-al-horno-receta.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/ravioles.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/receta-wok-de-cerdo.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
    </div>
    <br>
    <label>Verduleria</label>
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/arrozConPollo.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/canelones.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/muslos-de-pollo-al-horno-receta.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/ravioles.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/receta-wok-de-cerdo.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
    </div>
    <br>
    <label>Verduleria</label>
    <div class="gallery js-flickity" data-flickity-options='{ "wrapAround": true,  "pageDots": false}'>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/arrozConPollo.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/canelones.jpg'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/muslos-de-pollo-al-horno-receta.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/ravioles.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
        <div class="gallery-cell"
             style="background-image: url('../img/PlatosComida/receta-wok-de-cerdo.png'); background-position: center;"
             data-toggle="popover" title="Cantidad" data-content="1"></div>
    </div>
</div>
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>

<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
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
</script>

</body>
</html>