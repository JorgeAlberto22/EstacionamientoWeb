<?php
    $idUsuario = $_POST["id"];
    $tipoUsuario = $_POST["tipo"];
    session_start(); 
    $_SESSION["tipoUsuario"] = $tipoUsuario; 
    $_SESSION["idUsuario"] = $idUsuario; 
    session_regenerate_id();
    echo $tipoUsuario;
?>