<?php
include_once "app/models/UserModel.php";
include_once "app/views/AuthView.php";

class AuthControl {
    private $model;
    private $view;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    function showLogin() {
        $this->view->showLogin(); // muestro el formulario de login
    } 

    function login() {
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        if(empty($usuario)) {
            return $this->view->showLogin('Falta completar el nombre de usuario!');
        }
        if(empty($contraseña)) {
            return $this->view->showLogin('Falta completar la contraseña!');
        }

        $userFromDB = $this->model->getUserByUsername($usuario); // verifica q el usuario este en la bd

        if($userFromDB && password_verify($contraseña, $userFromDB->contraseña)) {
            session_start();
            $_SESSION['id_usuario'] = $userFromDB->id_usuario;
            $_SESSION['usuario'] = $userFromDB->usuario;
            
            header("Location: " . BASE_URL);
        } else {
            return $this->view->showLogin('Credenciales incorrectas!');
        }

    }

    function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }
    
}