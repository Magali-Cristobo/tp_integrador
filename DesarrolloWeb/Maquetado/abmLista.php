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
if($_POST["operacion"]=="agregar"){
    $json_datosLista = getUrl("http://localhost:8888/api/agregarLista/" . $_SESSION["idUsuario"]."/".$_POST["nombre"]);
}
else if ($_POST["operacion"]=="eliminar"){
    $json_datosLista = getUrl("http://localhost:8888/api/eliminarLista/" . $_SESSION["idUsuario"]."/".$_POST["idLista"]);
}
else if($_POST["operacion"]=="modificar"){
    $json_datosLista = getUrl("http://localhost:8888/api/renombrarLista/" . $_SESSION["idUsuario"]."/".$_POST["idLista"]."/".$_POST["nuevoNombre"]);
}
$datosLista = json_decode($json_datosLista, true);
echo "OK";
?>