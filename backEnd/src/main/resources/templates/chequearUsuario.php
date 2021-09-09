<?php
    session_start();
    if ($_POST['mail'] == 'admin@gmail.com' && $_POST['clave'] == 'admin'){
        $_SESSION["SESION_INICIADA"]=1;
        echo 'OK';
    }
    else{
        echo 'Error de autenticación';
    }
?>