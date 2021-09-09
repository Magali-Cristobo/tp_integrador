<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estiloListas.css">
    <link rel="stylesheet" href="../css/estiloMenuSemanal.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
</head>
<!--https://icons.getbootstrap.com/icons/list-check/ icono para la ventana-->
<body>
<title>Cocinando - Lista</title>
<!--Hacer una variable en JS q agarre el nombre de la lista y lo ponga en el titulo, igual con el logo-->
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
                <li class="nav-item"><a href="menuSemanal.php" class="nav-link">Mi despensa</a></li>
                <li class="nav-item"><a href="listas.php" class="nav-link">Lista de compras</a></li>
            </ul>
        </div>
        <input class="form-control col-6 barraDeBusqueda" type="search" placeholder="Search" aria-label="Search"
               style="margin: 0 auto;position: absolute; left: 27%; top: 16px">
        <button type="button" class="btn btn-circle  botonIniciarSesion" data-toggle="modal" data-target="#exampleModal"
                id="iniciarSesionNavBar" type="submit" style="position: absolute; top: 12px"></button>
    </form>
</nav>

<p class="titulo">Mi menu semanal</p>

<div class="container contenedor">
    <div class="row">
        <div class="col border cuadrillaNaranja">
            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-calendar-week " fill="currentColor"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
            </svg>
        </div>
        <div class="col border cuadrillaNaranja">D</div>
        <div class="col border cuadrillaNaranja">A</div>
        <div class="col border cuadrillaNaranja">M</div>
        <div class="col border cuadrillaNaranja">C</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaGris">D</div>
        <div class="col border cuadrillaGris"><button class="cuadrillaGris">prueba</button></div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaNaranja">L</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaGris">M</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaNaranja">X</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaGris">J</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaNaranja">V</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="col border cuadrillaNaranja">col</div>
        <div class="w-100"></div>

        <div class="col border cuadrillaGris">S</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="col border cuadrillaGris">col</div>
        <div class="w-100"></div>
    </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small fixed-bottom">
    <nav class="navbar navbar-light footer" style="height: 20px" style="background-color: #FEEEB3">
    </nav>
</footer>
</body>

<script>

</script>
</html>