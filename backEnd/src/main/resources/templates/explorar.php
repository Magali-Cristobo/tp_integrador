<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilosExplorar.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/335e9cffe5.js" crossorigin="anonymous"></script>
</head>
<body>
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
                <li class="nav-item"><a href="miDespensa.php" class="nav-link item">Mi despensa</a></li>
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
<div class="contenedor" style="background-color: #F2AF5C; width: 100%; height: 38px;">
    <div class="row">
        <div class="dropdown" style="position: absolute; left:10%;">
            <a class="btn dropdown-toggle botonDesplegable" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ordenar
            </a>
            <div class="dropdown-menu menuDesplegable" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item itemMenu" href="#">Alfabeticamente</a>
                <a class="dropdown-item itemMenu" href="#">Relevancia</a>
                <a class="dropdown-item itemMenu" href="#" data-toggle="modal" data-target="#exampleModal"
                   onclick="mostrarModalFecha()">Fecha</a>
            </div>
        </div>
        <div class="dropdown" style="position: absolute; right:10%;">
            <a class="btn dropdown-toggle botonDesplegable" href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filtrar
            </a>
            <div class="dropdown-menu menuDesplegable" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item itemMenu" href="#" data-toggle="modal" data-target="#exampleModal"
                   onclick="mostrarModalCalificacion()">Calificacion</a>
                <a class="dropdown-item itemMenu" href="#" data-toggle="modal" data-target="#exampleModal"
                   onclick="mostrarModalDificultad()">Dificultad</a>
                <a class="dropdown-item itemMenu" href="#" data-toggle="modal" data-target="#exampleModal"
                   onclick="mostrarModalAutor()">Autor</a>
                <a class="dropdown-item itemMenu" href="#" data-toggle="modal" data-target="#exampleModal"
                   onclick="mostrarModalIngredientes()">Ingredientes</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-4">
            <!-- Solo dejo el primero asi para mostrar que si queremos que vaya a otra pagina podemos hacer eso -->
            <a href="home.php">
                <button class="btn btn-block botonExplorar" type="button"
                        style="background-image: url('../img/PlatosComida/arrozConPollo.jpg');"><a href='recetaExplorar.php' class='nav-link'></a></button>
            </a>
            <span class="tituloReceta">Pollo con arroz</span>
        </div>
        <div class="col-4">
            <button class="btn btn-block botonExplorar" type="button"
                    style="background-image: url('../img/PlatosComida/canelones.jpg');"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Canelones</span>
        </div>
        <div class="col-4">
            <button class="btn btn-lg botonExplorar" type="button"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Pastel de papa</span>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <button class="btn btn-block botonExplorar"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Milanesa Napolitana</span>
        </div>
        <div class="col-4">
            <button class="btn btn-block botonExplorar" type="button"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Empanadas de carne</span>
        </div>
        <div class="col-4">
            <button class="btn btn-block botonExplorar" type="button"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Pizza</span>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <button class="btn btn-block botonExplorar" type="button"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Ensalada Caesar</span>
        </div>
        <div class="col-4">
            <button class="btn btn-block botonExplorar" type="button"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Macarrones con queso</span>
        </div>
        <div class="col-4">
            <button class="btn  btn-block botonExplorar" type="button"><a href='recetaExplorar.php' class='nav-link'></a></button>
            <span class="tituloReceta">Carne al horno</span>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
</div>
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script>
    function mostrarModalFecha() {//creo que no tiene sentido
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Seleccione una fecha</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='seleccionarFecha'><input class='inputModals' id='correoElectronico' type='date' name='fecha'><input type='submit' id='botonAceptar' value='Aceptar'></form></div></div></div>")
    }

    function pintarLimones(posicion) {
        $(".imagenModal").removeClass("imagenModalConColor");
        $(".imagenModal").attr("src", "../img/Imagenes/Limon.png");
        for (var i = 0; i <= posicion; i++) {
            $("#limon" + i).addClass("imagenModalConColor");
            $("#limon" + i).attr("src", '../img/Imagenes/limonNaranja.png');
        }
    }

    function pintarGorros(posicion) {
        $(".imagenModal").removeClass("imagenModalConColor");
        $(".imagenModal").attr("src", "../img/Imagenes/gorro de chef.png");
        for (var i = 0; i <= posicion; i++) {
            $("#gorro" + i).addClass("imagenModalConColor");
            $("#gorro" + i).attr("src", '../img/Imagenes/gorro de chef naranja.png');
        }
    }

    function mostrarModalDificultad() {
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Seleccione la dificultad</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='ingresarCalificacion'><div id='divimagenModals'><img id='gorro1' class='imagenModal' src='../img/Imagenes/gorro de chef.png' onclick='pintarGorros(1)''><img id='gorro2' class='imagenModal' src='../img/Imagenes/gorro de chef.png' onclick='pintarGorros(2)'><img id='gorro3' class='imagenModal' src='../img/Imagenes/gorro de chef.png' onclick='pintarGorros(3)'><img id='gorro4' class='imagenModal' src='../img/Imagenes/gorro de chef.png' onclick='pintarGorros(4)'><img id='gorro5' class='imagenModal' src='../img/Imagenes/gorro de chef.png' onclick='pintarGorros(5)'></div><input type='submit' id='botonAceptar' value='Aceptar'></form></div></div></div>");
        $(".modal").addClass("modalForms");
    }

    function mostrarModalCalificacion() {
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Seleccione la calificacion</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='ingresarCalificacion'><div id='divimagenModals'><img id='limon1' class='imagenModal' src='../img/Imagenes/Limon.png' onclick='pintarLimones(1)'><img id='limon2' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(2)'><img id='limon3' class='imagenModal' src='../img/Imagenes/Limon.png' onclick='pintarLimones(3)'><img id='limon4' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(4)'><img id='limon5' class='imagenModal' src='../img/Imagenes/Limon.png' onclick='pintarLimones(5)'></div><input type='submit' id='botonAceptar' value='Aceptar'></form></div></div></div>");
        $(".modal").addClass("modalForms");
    }

    function mostrarModalAutor() {
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Ingrese el autor</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='ingresarAutor'><div id='divimagenModals'><input type='text' ></div><input type='submit' id='botonAceptar' value='Aceptar'></form></div></div></div>");
        $(".modal").addClass("modalForms");
    }

    function mostrarModalIngredientes() {
        $(".modal").removeClass('modalForms');
        $('.modal-dialog').remove();
        $('.modal').append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Seleccione los ingredientes</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><form class='ingresarAutor'><div id='accordion'><div class='card'><div class='card-header divTitulo' id='headingOne'><h5 class='mb-0'><button class='btn btn-link collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseOne' aria-expanded='false' aria-controls='collapseOne'>Lacteos</button></h5></div><div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'><div class='card-body'><div class='ingrediente'><input type='checkbox'><label>Leche</label></div><div class='ingrediente'><input type='checkbox'><label>Queso crema</label></div><div class='ingrediente'><input type='checkbox'><label>Yogurt</label></div></div></div></div><div class='card'><div class='card-header divTitulo' id='headingTwo'><h5 class='mb-0'><button class='btn btn-link collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'>Verduleria</button></h5></div><div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'><div class='card-body'><div class='ingrediente'><input type='checkbox'><label>Tomate</label></div><div class='ingrediente'><input type='checkbox'><label>Lechuga</label></div><div class='ingrediente'><input type='checkbox'><label>Cebolla</label></div></div></div></div><div class='card'><div class='card-header divTitulo' id='headingThree'><h5 class='mb-0'><button class='btn btn-link collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseThree' aria-expanded='false' aria-controls='collapseThree'>Almacen</button></h5></div><div id='collapseThree' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'><div class='card-body'><div class='ingrediente'><input type='checkbox'><label>Harina</label></div><div class='ingrediente'><input type='checkbox'><label>Pan rallado</label></div><div class='ingrediente'><input type='checkbox'><label>Maicena</label></div></div></div></div></form><input type='submit' id='botonAceptar' value='Aceptar'></div></div></div>");
    }
    $.ajax({
        type: "GET",
        url: "/api/datos" //tiene que tener un nombre distinto a este archivo
    }).done(function (data) {
        <?php
            $json_recetas=file_get_contents(data);
            $recetas=json_decode($json_recetas,true);
            foreach ($recetas as $receta){
                echo $receta['dificultad'];
            }
        ?>
        console.log(data);
    });
</script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
</body>
</html>