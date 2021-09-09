<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estiloReceta.css">
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
                <li class="nav-item"><a href="misRecetas.php" class="nav-link">Mis recetas</a></li>
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


<h2 class='modal-title text-center tituloReceta'> Carne al horno</h2>
<br>
<div class="container infoReceta">
    <div class="row">
        <div class="col-5"><h5 class="ingredientesTitulo">Ingredientes:</h5>
            <div class="ingredientesItems">
                <h6 class="items"><i class="fas fa-utensil-spoon"></i> Prueba</h6>
                <h6 class="items"><i class="fas fa-utensil-spoon"></i> Prueba</h6>
                <h6 class="items"><i class="fas fa-utensil-spoon"></i> Prueba</h6>
                <h6 class="items"><i class="fas fa-utensil-spoon"></i> Prueba</h6>
                <h6 class="items"><i class="fas fa-utensil-spoon"></i> Prueba</h6>
            </div>
        </div>

        <div class="col-7 ">
            <div class="masInformacion">
                <h5 class="informacionExtra">Dificultad: <img class="gorroChef" src="../img/Imagenes/Gorro%20de%20chef.png">
                    <img class="gorroChef" src="../img/Imagenes/Gorro%20de%20chef.png"> <img class="gorroChef"
                                                                                      src="../img/Imagenes/Gorro%20de%20chef.png">
                    <img class="gorroChef" src="../img/Imagenes/Gorro%20de%20chef.png"> <img class="gorroChef"
                                                                                      src="../img/Imagenes/Gorro%20de%20chef.png">
                </h5>
            </div>

            <h5 class="informacionExtra">Personas: <img class="personas" src="Imagenes/Logo%20persona.png"> <img
                    class="personas" src="../img/Imagenes/Logo%20persona.png"> <img class="personas"
                                                                             src="../img/Imagenes/Logo%20persona.png"> <img
                    class="personas" src="../img/Imagenes/Logo%20persona.png"> <img class="personas"
                                                                             src="../img/Imagenes/Logo%20persona.png"></h5>
            <h5 class="informacionExtra">Puntaje: <img class="personas" src="Imagenes/Limon.png"> <img class="personas"
                                                                                                       src="../img/Imagenes/Limon.png">
                <img class="personas" src="../img/Imagenes/Limon.png"> <img class="personas" src="../img/Imagenes/Limon.png"> <img
                        class="personas" src="../img/Imagenes/Limon.png"></h5>
            <h5 class="informacionExtra">Autor: Usuario </h5>
        </div>

    </div>
</div>
<br>

<div class="container">
    <h5 class="ingredientesTitulo">Preparación:</h5>
    <br>
    <h6 class="items">1- Prueba</h6>
    <h6 class="items">2- Prueba</h6>
    <h6 class="items">3- Prueba</h6>
    <h6 class="items">4- Prueba</h6>
    <h6 class="items">5- Prueba</h6>

</div>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <button class="btn  boton" type="submit" id="botonAniadirAlMenu" data-toggle="modal"
                data-target="#exampleModal">Añadir al menu
        </button>
        <button class="btn  boton" type="submit" id="botonNoGuardar" data-toggle="modal" data-target="#exampleModal">No
            guardar
        </button>
    </div>
</div>

<footer class="page-footer font-small blue fixed-bottom ">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
</body>
</html>