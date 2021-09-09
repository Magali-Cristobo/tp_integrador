<?php
session_start();
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
if($_POST["operacion"]=="agregar") {
    $json_datosLista = getUrl("http://localhost:8888/api/agregarAlMenu/" . $_SESSION["idUsuario"] . "/" . $_POST["idReceta"] . "/" . $_POST["momento"] . "/" . $_POST["fecha"] . "/" . $_POST["cantPersonas"]);
}
else{
    $json_datosLista = getUrl("http://localhost:8888/api/eliminarAlMenu/" . $_SESSION["idUsuario"] . "/" . $_POST["idReceta"] . "/" . $_POST["momento"] . "/" . $_POST["fecha"] . "/" . $_POST["cantPersonas"]);

}
    $datosLista = json_decode($json_datosLista, true);
echo "OK";
?>