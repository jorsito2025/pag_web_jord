<?php

if (!empty($_POST["btningresar"])) {
    if (empty($_POST["usuario"]) and empty($_POST["password"])) {
        echo '<div class="alert alert-danger">LOS CAMOPOS ESTAN VACIOS</div>';
    } else {
        $usuario= $_POST["usuario"];
        $clave= $_POST["password"];
        $sql=$conexion->query(" select * from usuarios where usuario='$usuario' and clave='$clave' ");
        if ($datos=$sql->fetch_object()) {
            header("location:mi_aplicacion");
        } else {
            echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
        }
    }    

}

?>