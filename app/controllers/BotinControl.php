<?php
include_once "app/models/BotinModel.php";
include_once "app/views/BotinView.php";

class BotinControl {
    private $model;
    private $view;

    function __construct() {
        $this->model = new BotinModel();
        $this->view = new BotinView();
    }
    
    function showBotines() {
        $botines = $this->model->getAll();
        $this->view->showBotines($botines);
    }

    function showBotin($id) {
        $botin = $this->model->get($id);
        $this->view->showBotin($botin);
    }

    function addBotines() {
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $talle = $_POST['talle'];
        $gama = $_POST['gama'];
        $precio = $_POST['precio'];
        $id_marca = $_POST['id_marca'];

        if(empty($modelo) || empty($color) || empty($talle) || empty($gama) || empty($precio) || empty($id_marca)) {
            $this->view->showError('Faltan campos obligatorios!');
        }

        $id = $this->model->insert($modelo, $color, $talle, $gama, $precio, $id_marca);
        if($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError('Error al insertar botin!');
        }
    }

    function removeBotines($id) {
        $this->model->delete($id);
        header("Location: " . BASE_URL);

    }

    function editBotin($idBotin) {
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $talle = $_POST['talle'];
        $gama = $_POST['gama'];
        $precio = $_POST['precio'];
        $id_marca = $_POST['id_marca'];

        if(empty($modelo) || empty($color) || empty($talle) || empty($gama) || empty($precio) || empty($id_marca)) {
            $this->view->showError('Faltan campos obligatorios!');
        }

        $id = $this->model->edit($modelo, $color, $talle, $gama, $precio, $id_marca, $idBotin);
        if($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError('Error al editar botin!');
        }
    }
    
}