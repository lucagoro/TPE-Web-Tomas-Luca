<?php

class BotinView {
    public $usuario = null;

    function __construct($usuario) {
            $this->usuario = $usuario;
    }

    function showBotines($botines, $marcas) {
        $count = count($botines);
        require "templates/lista_botines.phtml";
    }

    function showBotin($botin) {
        require "templates/botin_info.phtml";
        //require de edit aca pero si esta logueado seria(ver eso)
    }

    function showError($error) {
        require "templates/error.phtml";
    }
}