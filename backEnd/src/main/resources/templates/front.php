<?php
    const API_URL = 'http://localhost/tpIntegrador/DesarrolloWeb/Maquetado/';

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

    $json_usuarios = getUrl(API_URL . 'usuarios.php');

    $usuarios = json_decode($json_usuarios, true);

   ?> <h1> <?php echo $usuarios['nombre'] ?> </h1> <?php
    
    $res = postUrl(API_URL . 'chequearUsuario.php', $usuarios);

    echo $res;
?>