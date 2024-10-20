<?php
require_once 'app/controllers/MarcasControl.php';
class MarcasView{
    public $usuario = null;
    
    function __construct($usuario) {
        $this->usuario = $usuario;
    }
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
    function showEditForm($marca){
        require 'templates/editar_marca.phtml';
    }


}