<?php
class AuthView {
    
    function showLogin($error = '') {
        require "templates/form_login.phtml";
    }

    // function showSignup($error = '') {
        // require 'templates/form_signup.phtml'
    // }
}