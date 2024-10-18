<?php
require_once 'app/controllers/MarcasControl.php';
class MarcasView{
    function showMarcas($marcas){
        $count = count($marcas);
        require 'templates/lista_marcas.phtml';
    }
    function showMarca($marca, $botines){
        require "templates/marca_botines.phtml";
    }
    function showError($error){
        require 'templates/error.phtml';
    }


}