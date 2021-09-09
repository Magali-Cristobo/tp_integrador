function armarBarra() {
    $(".barra").append( '<form class="form-inline items" style="width: 90%">\n' +
        '        <button class="navbar-toggler" id="botonNavBar" type="button" data-toggle="collapse"\n' +
        '                data-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">\n' +
        '            <span class="navbar-toggler-icon"></span>\n' +
        '        </button>\n' +
        '        <div class="navbar-collapse collapse" id="navbarNav">\n' +
        '            <ul class="navbar-nav flex-row ml-auto justify-content-between" style="display: block">\n' +
        '                <br>\n' +
        '                <li class="nav-item"><a href="home.php" class="nav-link">Inicio</a></li>\n' +
        '                <li class="nav-item"><a href="explorar.php" class="nav-link item">Recetario</a></li>\n' +
        '                <li class="nav-item"><a href="guardados.php" class="nav-link">Mis preferidas</a></li>\n' +
        '                <li class="nav-item"><a href="misRecetas.php" class="nav-link">Mis creaciones</a></li>\n' +
        '                <li class="nav-item"><a href="menuSemanal.php" class="nav-link">¿Que comemos?</a></li>\n' +
        '                <li class="nav-item"><a href="listas.php" class="nav-link">Lista de compras</a></li>\n' +
        '                <li class="nav-item"><a href="miDespensa.php" class="nav-link">Mi despensa</a></li>\n' +
        '            </ul>\n' +
        '        </div>\n' +
        '        <input class="form-control col-6 barraDeBusqueda" id="barraDeBusqueda"  type="search" placeholder="Busca una receta" aria-label="Search" list="titulosReceta"\n' +
        '               style="margin: 0 auto;position: absolute; left: 27%; top: 16px">\n' +
        '        <button type="button" class="btn btn-circle  botonIniciarSesion" data-toggle="modal" data-target="#modalCerrarSesion" id="botonSesionIniciada" type="submit" style="position: absolute; top: 12px"></button>\n' +
        '    </form>\n' );
}

