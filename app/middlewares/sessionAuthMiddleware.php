<?php

    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id_usuario'])) {
            $res->usuario = new stdClass();
            $res->usuario->id_usuario = $_SESSION['id_usuario'];
            $res->usuario->usuario = $_SESSION['usuario'];
            return;
        }
    }
?>