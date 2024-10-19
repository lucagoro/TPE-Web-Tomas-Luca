<?php
class AuthView {
    private $usuario = null;
    
    function showLogin($error = '') {
        require "templates/form_login.phtml";
    }

}