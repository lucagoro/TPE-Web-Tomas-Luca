<?php

class BotinView {
    public $usuario = null;

    function __construct($usuario) {
            $this->usuario = $usuario;
    }

    function showBotines($botinesConMarcas) {
        $count = count($botinesConMarcas);
        require "templates/lista_botines.phtml";
    }

    function showBotin($botin) {
        require "templates/botin_info.phtml";
        require "templates/editar_botin.phtml";
    }

    function showError($error) {
        require "templates/error.phtml";
    }
}