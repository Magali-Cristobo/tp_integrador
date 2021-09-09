<?php
session_start();
const API_URL = 'http://localhost:8888/api/recetaExplorar/';
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
if($_POST["operacion"]=="busqueda"){
    $json_datosReceta = getUrl(API_URL ."filtrarBusqueda"."/".$_POST["palabraIngresada"]);
}
if($_POST["operacion"]=="filtrarIngredientes"){
    $json_datosReceta = getUrl(API_URL ."filtrarIngredientes"."/".json_encode($_POST["ingredientesArray"]));
}
$datosReceta = json_encode($json_datosReceta, true);
$titulosReceta=[];
$contador=0;
echo $json_datosReceta;
?>
