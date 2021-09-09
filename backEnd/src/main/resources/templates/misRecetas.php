<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estiloListas.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
</head>
<body>
<title>Cocinando</title>
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
                <li class="nav-item"><a href="miDespensa.php" class="nav-link">Mi despensa</a></li>
                <li class="nav-item"><a href="menuSemanal.php" class="nav-link">Menu semanal</a></li>
                <li class="nav-item"><a href="listas.php" class="nav-link">Lista de compras</a></li>
                <li class="nav-item"><a href="miDespensa.php" class="nav-link">Mi despensa</a></li>
            </ul>
        </div>
        <input class="form-control col-6 barraDeBusqueda" type="search" placeholder="Search" aria-label="Search"
               style="margin: 0 auto;position: absolute; left: 27%; top: 16px">
        <button type="button" class="btn btn-circle  botonIniciarSesion" data-toggle="modal" data-target="#exampleModal"
                id="iniciarSesionNavBar" type="submit" style="position: absolute; top: 12px"></button>
    </form>
</nav>
<br>
<br>
<h4 class="misListas">> Mis recetas
</h4>
<br>
<div class="container">
    <div class="row">
        <div class="col-4 botonAniadirLista">
            <button class="btn  btn-block boton" type="submit" id="aniadirListas" data-toggle="modal"
                    data-target="#exampleModal"><i class="fas fa-plus-circle"></i>Añadir
            </button>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom ">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#aniadirListas').click(function () {
            var aniadir = document.getElementsByClassName("botonAniadirLista");
            $('.row').removeClass("botonAniadirLista");
            $('.row').append("<div class='col-4'><button class='btn  btn-block boton' type='submit' id='hola' data-toggle='modal' data-target='#exampleModal'><a href='recetaMisRecetas.php' class='nav-link'></a> Prueba</button></div>");
            $('.row').append(aniadir);
        });

    });
</script>