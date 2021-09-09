<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estiloListas.css">
    <link rel="stylesheet" href="../css/estiloListaExpandida.css">
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
<div class="partePrincipal">
    <div class="parteSuperior">
        <button class="botonOpciones" data-toggle="modal" data-target="#staticBackdrop">
            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor"
                 xmlns="http://www.w3.org/2000/svg"><!-- intentar de rotar cuando se preciona/hover -->
                <path fill-rule="evenodd"
                      d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
            </svg>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Opciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ordenar alfabeticamente</p>
                        <p>Guardar lista</p>
                        <p>Enviar lista</p>
                        <p>Vaciar lista</p>
                        <p>Mostrar solo items sin completar</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <p class="nombreLista">Super</p> <!-- Hacer este titulo una variable -->
    </div>

    <div class="parteInferior">
        <div class="contenedorParteInferior contenedorAgregarItem border-top border-bottom border-dark">
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-square botonAgregarItem"
                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path fill-rule="evenodd"
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>

            <input type="text" placeholder="Producto Nuevo" class="inputIngresarItem border border-light">
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="page-footer font-small fixed-bottom">
    <nav class="navbar navbar-light footer" style="height: 20px" style="background-color: #FEEEB3">
    </nav>
</footer>
</body>

<script>
    function cerrarItem(item) {
        console.log(1);
        $("." + item).css("display", "none");
    };

    function agregarItem(nombreItem) {
        $(".contenedorAgregarItem").append('<div class="contenedorParteInferior ' + nombreItem + ' itemsDeLaLista border-bottom border-top border-dark"><input type="checkbox" class="checkboxItem">' + nombreItem + '<button type="button" onclick="cerrarItem(' + nombreItem + ')" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button> </div>');
    };
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus');
    });
    $(".botonAgregarItem").click(function () {
        var itemIngresado = $(".inputIngresarItem").val();
        if (itemIngresado == "") {
            $(".inputIngresarItem").removeClass("border-light");
            $(".inputIngresarItem").addClass("border-danger");
            setTimeout(function () {
                $(".inputIngresarItem").removeClass("border-danger");
                $(".inputIngresarItem").addClass("border-light");
            }, 1000);
        } else {
            agregarItem(itemIngresado);
            $(".inputIngresarItem").val('');
        }
    });
</script>
</html>