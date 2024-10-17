<?php

class BotinView {

    function showBotines($botines) {
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