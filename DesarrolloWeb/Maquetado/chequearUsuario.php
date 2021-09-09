<?php
    session_start();
    const API_URL = 'http://localhost:8888/api/datosUsuario/';
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
    if($_POST["operacion"]=="login"){
        $json_datosUsuario = getUrl(API_URL . "/".$_POST["mail"]."/". $_POST["clave"]);
        $datosUsuario = json_decode($json_datosUsuario, true);
        $idUsuario=$datosUsuario["idUsuario"];
        if($idUsuario!=-1){
            $_SESSION["idUsuario"]=$idUsuario;
            echo "OK";
        }
        else{
            echo "usuario incorrecto";
        }
    }
    else{

        $datosAIngresar = json_encode(array("usuario" => $_POST));
        $json_ingresoUsuario = postUrl("http://localhost:8888/api/ingresoUsuario",$datosAIngresar);
        $respuesta = json_decode($json_ingresoUsuario, true);
        if(!array_key_exists("nombreRepetido", $respuesta) && !array_key_exists("mailRepetido", $respuesta)){
            $_SESSION["idUsuario"]=$respuesta["usuarioCreadoExitosamente"];
            echo "OK";
        }
        else if(array_key_exists("nombreRepetido", $respuesta)){
            echo "nombreRepetido";
        }
        else if(array_key_exists("mailRepetido", $respuesta)){
            echo "mailRepetido";
        }

    }

?>