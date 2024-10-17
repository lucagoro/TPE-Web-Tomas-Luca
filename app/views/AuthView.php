<?php
class AuthView {
    
    function showLogin($error = '') {
        require "templates/form_login.phtml";
    }
}