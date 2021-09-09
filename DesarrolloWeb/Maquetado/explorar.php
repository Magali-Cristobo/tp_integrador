<?php
const API_URL = 'http://localhost:8888/api';
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
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

if(isset($_GET["operacion"])){
    if($_GET["operacion"]=="dificultad"){
        $json_recetas = getUrl(API_URL ."/"."recetaExplorar"."/"."filtrarDificultad"."/".$_GET["dificultad"]);
    }
    else if($_GET["operacion"]=="puntaje"){
        $json_recetas = getUrl(API_URL ."/"."recetaExplorar"."/"."filtrarCalificacion"."/".$_GET["puntaje"]);
    }
    else if($_GET["operacion"]=="autor"){
        $json_recetas = getUrl(API_URL ."/"."recetaExplorar"."/"."filtrarUsuario"."/".$_GET["autor"]);
    }
    else if($_GET["operacion"]=="filtrarIngredientes"){
        $parametros=explode(",",$_GET["Ingredientes"]);
        $payload = json_encode(array("ingredientes" => $parametros));
        $json_recetas = postUrl("http://localhost:8888/api/recetaExplorar/filtrarIngredientes",$payload);
    }

}
else {
    $json_recetas = getUrl(API_URL .'/'. 'datos');
}

$recetas = json_decode($json_recetas, true);
$contador=0;

?>
<html>
<head>
    <meta charset="utf-8">
    <link  rel="icon" href="Imagenes/check.png" type="image/png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilosExplorar.css">
    <link rel="stylesheet" href="estiloIconoCargando.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Explorar</title>
    <script src="barra.js"></script>
    <script src="cargando.js"></script>
    <script src="barraDeBusqueda.js"></script>
    <script src="operacionesSesion.js"></script>
</head>
<body>
<div class="parteCargando">
    <p class="textoCargando">Cargando...</p>
</div>
<nav class="navbar navbar-light navbar-fixed-top navbar-inverse navbar-toggleable-md barra">
    <script>armarBarra()</script>
</nav>
<div class="contenedor" style="background-color: #F2AF5C; width: 100%; height: 38px;">
    <div class="row">
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

        <?php
        if(!array_key_exists("error", $recetas)){
        foreach ($recetas as $receta){
        foreach ($receta as $recetita){
        if($contador<=2){
            ?>
            <div class="col-4">
                <a href="#">
                    <button class="btn btn-block botonExplorar" type="button" style="background-image: url('<?php echo $recetita["imagen"]?>');"><a href='recetaExplorar.php?idReceta=<?php echo $recetita["clavePrimaria"]?>' class='nav-link'></a></button>
                </a>

                <span class="tituloReceta"><?php echo $recetita["titulo"]?></span>
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
                <button class="btn btn-block botonExplorar" type="button" style="background-image: url('<?php echo $recetita["imagen"]?>') "><a href='recetaExplorar.php?idReceta=<?php echo $recetita["clavePrimaria"]?>' class='nav-link'></a></button>
            </a>
            <span class="tituloReceta"><?php echo $recetita["titulo"]?></span>
        </div>
        <?php
        }}} ?>

    </div>
</div>
<?php
        }
        else {  ?>
                </div>
            </div>
                <div class="row h-75 contenedorMensajeError">
                    <div class="col-sm-12 my-auto">
                        <h5 class="errorAlFiltrar align-self-center " id="mensajeError">No se encontraron recetas que cumplan con esa búsqueda</h5>
                        <button class="btn errorAlFiltrar align-self-center" type="submit" id="botonEliminarFiltro" onclick="volverAExplorar()">Eliminar filtros</button>
                </div>
                </div>
        <?php
        } ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
<br>
<!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom">
    <nav class="navbar navbar-light footer">
    </nav>
</footer>
<script>


    var dificultad=1;
    var calificacion=1;

    function volverAExplorar(){
        location.href="explorar.php";
    }


    function pintarLimones(posicion) {
        $(".imagenModal").removeClass("imagenModalConColor");
        $(".imagenModal").attr("src", "Imagenes/Limon.png");
        for (var i = 0; i <= posicion; i++) {
            $("#limon" + i).addClass("imagenModalConColor");
            $("#limon" + i).attr("src", 'Imagenes/limonNaranja.png');
        }
        calificacion=posicion;
    }

    function pintarGorros(posicion) {
        $(".imagenModal").removeClass("imagenModalConColor");
        $(".imagenModal").attr("src", "Imagenes/gorro de chef.png");
        for (var i = 0; i <= posicion; i++) {
            $("#gorro" + i).addClass("imagenModalConColor");
            $("#gorro" + i).attr("src", 'Imagenes/gorro de chef naranja.png');
        }
        dificultad=posicion;

    }

    function mostrarModalDificultad() {
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Seleccione la dificultad</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='cruzCerrarModal'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='ingresarCalificacion'><div id='divimagenModals'><img id='gorro1' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(1)''><img id='gorro2' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(2)'><img id='gorro3' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(3)'><img id='gorro4' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(4)'><img id='gorro5' class='imagenModal' src='Imagenes/gorro de chef.png' onclick='pintarGorros(5)'></div><input type='submit' id='botonAceptar' value='Aceptar' onclick='filtrarPorDificultad()'></form></div></div></div>");
        $(".modal").addClass("modalForms");
    }

    function filtrarPorDificultad(){
        event.preventDefault();
        location.href="explorar.php?operacion=dificultad&dificultad="+dificultad;
    }


    function mostrarModalCalificacion() {
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Seleccione la calificacion</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='cruzCerrarModal'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='ingresarCalificacion'><div id='divimagenModals'><img id='limon1' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(1)'><img id='limon2' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(2)'><img id='limon3' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(3)'><img id='limon4' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(4)'><img id='limon5' class='imagenModal' src='Imagenes/Limon.png' onclick='pintarLimones(5)'></div><input type='submit' id='botonAceptar' value='Aceptar' onclick='filtrarPorCalificacion()'></form></div></div></div>");
        $(".modal").addClass("modalForms");
    }

    function filtrarPorCalificacion(){
        event.preventDefault();
        location.href="explorar.php?operacion=puntaje&puntaje="+calificacion;
    }

    function mostrarModalAutor() {
        $(".modal-dialog").remove();
        $(".modal").append("<div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5>Ingrese el autor</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='cruzCerrarModal'>&times;</span></button></div><div class='modal-body' id='cuerpoModal'><form class='ingresarAutor'><div id='divimagenModals'><input type='text' id='autor' ></div><input type='submit' id='botonAceptar' value='Aceptar' onclick='filtrarPorUsuario()' ></form></div></div></div>");
        $(".modal").addClass("modalForms");
    }

    function filtrarPorUsuario(){
        event.preventDefault();
        location.href="explorar.php?operacion=autor&autor="+$("#autor").val();
    }


    function mostrarModalIngredientes() {
        $(".modal").removeClass('modalForms');
        $('.modal-dialog').remove();
        $('.modal').append("<div class='modal-dialog' role='document'>" +
            "<div class='modal-content'>" +
            "<div class='modal-header'>" +
            "<h5>Seleccione los ingredientes</h5>" +
            "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
            "<span aria-hidden='true' class='cruzCerrarModal' >&times;</span><" +
            "/button>" +
            "</div>" +
            "<div class='modal-body'>" +
            "<form class='ingresarAutor'>" +
            "<div id='accordion'>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingOne'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseOne' aria-expanded='false' aria-controls='collapseOne'>Lacteos</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseOne' class='collapse' aria-labelledby='headingOne' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Leche')\">" +
            "<label>Leche</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Crema de leche')\">" +
            "<label>Crema de leche</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Dulce de leche')\">" +
            "<label>Dulce de leche</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso crema')\">" +
            "<label>Queso crema</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso rallado')\">" +
            "<label>Queso rallado</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso azul')\">" +
            "<label>Queso azul</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso mozzarella')\">" +
            "<label>Queso mozzarella</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso parmesano')\">" +
            "<label>Queso parmesano</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso suave')\">" +
            "<label>Queso suave</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso de barra')\">" +
            "<label>Queso de barra</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Yogurt')\">" +
            "<label>Yogurt</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Queso cremoso')\">" +
            "<label>Queso cremoso</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Manteca')\">" +
            "<label>Manteca</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingTwo'>" +
            "<h5 class='mb-0'><button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo' >Verduleria</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Tomate')\">" +
            "<label>Tomate</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Lechuga')\">" +
            "<label>Lechuga</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Cebolla')\">" +
            "<label>Cebolla</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Morron')\">" +
            "<label>Morron</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Papa')\">" +
            "<label>Papa</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Batata')\">" +
            "<label>Batata</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Calabaza')\">" +
            "<label>Calabaza</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Zanahoria')\">" +
            "<label>Zanahoria</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Berenjena')\">" +
            "<label>Berenjena</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Zucchini')\">" +
            "<label>Zucchini</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Albahaca')\">" +
            "<label>Albahaca</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Choclo en grano')\">" +
            "<label>Choclo en grano</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingThree'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseThree' aria-expanded='false' aria-controls='collapseThree'>Harinas y leudantes</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseThree' class='collapse' aria-labelledby='headingThree' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Harina leudante')\">" +
            "<label>Harina leudante</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Harina')\">" +
            "<label>Harina</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Harina 0000')\">" +
            "<label>Harina 0000</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Harina 000')\">" +
            "<label>Harina 000</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Harina integral)\">" +
            "<label>Harina integral</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Harina de arroz)\">" +
            "<label>Harina integral</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Levadura')\">" +
            "<label>Levadura </label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Fecula de mandioca')\">" +
            "<label>Fecula de mandioca</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Almidon de maiz')\">" +
            "<label>Almidon de maiz</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Maicena')\">" +
            "<label>Maicena</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingFour'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseFour' aria-expanded='false' aria-controls='collapseFour'>Carnes</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseFour' class='collapse' aria-labelledby='headingFour' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Cuadril')\">" +
            "<label>Cuadril</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Tapa de nalga')\">" +
            "<label>Tapa de nalga</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Pechuga')\">" +
            "<label>Pechuga</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Carne picada')\">" +
            "<label>Carne picada</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Matambre')\">" +
            "<label>Matambre</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Bondiola')\">" +
            "<label>Bondiola </label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Entraña')\">" +
            "<label>Entraña</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Asado')\">" +
            "<label>Asado</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Vacio')\">" +
            "<label>Vacio</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Riñon')\">" +
            "<label>Riñon</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Bisteces de res')\">" +
            "<label>Bisteces de res</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Bisteces de cerdo')\">" +
            "<label>Bisteces de cerdo</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingFive'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseFive' aria-expanded='false' aria-controls='collapseFive'>Condimentos</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseFive' class='collapse' aria-labelledby='headingFive' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Perejil')\">" +
            "<label>Perejil</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Laurel')\">" +
            "<label>Laurel</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Pimienta')\">" +
            "<label>Pimienta</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Pimenton')\">" +
            "<label>Pimenton</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Nuez moscada')\">" +
            "<label>Nuez moscada</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Ajo')\">" +
            "<label>Ajo</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Sal')\">" +
            "<label>Sal</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Oregano')\">" +
            "<label>Oregano</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Azafran')\">" +
            "<label>Azafran</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingSix'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseSix' aria-expanded='false' aria-controls='collapseSix'>Aderezos</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseSix' class='collapse' aria-labelledby='headingSix' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Mayonesa')\">" +
            "<label>Mayonesa</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Mostaza')\">" +
            "<label>Mostaza</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Salsa golf')\">" +
            "<label>Salsa golf</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Ketchup')\">" +
            "<label>Ketchup</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Barbacoa')\">" +
            "<label>Barbacoa</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Salsa criolla')\">" +
            "<label>Salsa criolla</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Chimichurri')\">" +
            "<label>Chimichurri</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingSeven'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseSeven' aria-expanded='false' aria-controls='collapseSeven'>Aceites y vinagres</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseSeven' class='collapse' aria-labelledby='headingSeven' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Aceite de girasol')\">" +
            "<label>Aceite de girasol</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Aceite de oliva')\">" +
            "<label>Aceite de oliva</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Vinagre de manzana')\">" +
            "<label>Vinagre de manzana</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Aceite mezcla')\">" +
            "<label>Aceite mezcla</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingEight'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseEight' aria-expanded='false' aria-controls='collapseEight'>Arroz y legumbres</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseEight' class='collapse' aria-labelledby='headingEight' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Arroz para sushi')\">" +
            "<label>Arroz para sushi </label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Arroz blanco')\">" +
            "<label>Arroz blanco</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Arroz yamani')\">" +
            "<label>Arroz yamani</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Arroz integral')\">" +
            "<label>Arroz integral</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Arroz fino')\">" +
            "<label>Arroz fino</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Lentejas')\">" +
            "<label>Lentejas</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Porotos')\">" +
            "<label>Porotos</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Arvejas')\">" +
            "<label>Arvejas</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Garbanzos')\">" +
            "<label>Garbanzos</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Lentejones')\">" +
            "<label>Lentejones</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Trigo burgol')\">" +
            "<label>Trigo burgol</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "<div class='card'>" +
            "<div class='card-header divTitulo' id='headingNine'>" +
            "<h5 class='mb-0'>" +
            "<button class='btn  collapsed tituloAcordeon' data-toggle='collapse' data-target='#collapseNine' aria-expanded='false' aria-controls='collapseNine'>Endulzantes</button>" +
            "</h5>" +
            "</div>" +
            "<div id='collapseNine' class='collapse' aria-labelledby='headingNine' data-parent='#accordion'>" +
            "<div class='card-body'>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Azucar')\">" +
            "<label>Azucar</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Azucar rubio')\">" +
            "<label>Azucar rubio</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Azucar impalpable')\">" +
            "<label>Azucar impalpable</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Azucar moreno')\">" +
            "<label>Azucar moreno</label>" +
            "</div>" +
            "<div class='ingrediente'>" +
            "<input type='checkbox' onclick=\"agregarElementosClickeados('Edulcorante')\">" +
            "<label>Edulcorante</label>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</form>" +
            "<input type='submit' id='botonAceptar' value='Aceptar' onclick='filtrarPorIngredientes()'></div></div></div>");
        $(".tituloAcordeon").on('click', function (e) { e.preventDefault(); })
    }

    var ingredientes=[];
    function agregarElementosClickeados(nombre){
        if(!ingredientes.includes(nombre)){
            ingredientes.push(nombre);
        }
        else {
            let pos=ingredientes.indexOf(nombre);
            ingredientes.splice(pos,1);
        }
    }

    function filtrarPorIngredientes(){
        event.preventDefault();
        location.href="explorar.php?operacion=filtrarIngredientes&Ingredientes="+ingredientes;

    }
    barraDeBusqueda();
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>