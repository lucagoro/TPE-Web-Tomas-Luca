<?php
include_once "app/models/BotinModel.php";
include_once "app/views/BotinView.php";
include_once "app/models/MarcasModel.php";

class BotinControl {
    private $model;
    private $view;
    private $modelMarca;

    function __construct($res) {
        $this->model = new BotinModel();
        $this->view = new BotinView($res);
        $this->modelMarca = new MarcasModel();
    }
    
    function showBotines() {
        $botines = $this->model->getAll();
        $botinesConMarcas = [];
        foreach ($botines as $botin) {
            // Obtenemos el nombre de la marca por su ID
            $marca = $this->modelMarca->getMarcaById($botin->id_marca);
            $botin->nombre_marca = $marca ? $marca->nombre : 'Marca desconocida';
            $botinesConMarcas[] = $botin;
        }
        $this->view->showBotines($botinesConMarcas);
    }

    function showBotin($id) {
        $botin = $this->model->get($id);
        $marcas = $this->modelMarca->getAllMarcas();
        $this->view->showBotin($botin, $marcas);
    }

    function addBotines() {
        $modelo = $_POST['modelo'];
        $color = $_POST['color'];
        $talle = $_POST['talle'];
        $gama = $_POST['gama'];
        $precio = $_POST['precio'];
        $id_marca = $_POST['id_marca'];

        if(empty($modelo) || empty($color) || empty($talle) || empty($gama) || empty($precio) || empty($id_marca)) {
            return $this->view->showError('Faltan campos obligatorios!');
        }

        $id = $this->model->insert($modelo, $color, $talle, $gama, $precio, $id_marca);
        if($id) {
            header("Location: " . BASE_URL);
        } else {
            return $this->view->showError('Error al insertar botin!');
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
            return $this->view->showError('Faltan campos obligatorios!');
        }

        $id = $this->model->edit($modelo, $color, $talle, $gama, $precio, $id_marca, $idBotin);
        if($id) {
            header("Location: " . BASE_URL);
        } else {
            return $this->view->showError('Error al editar botin!');
        }
    }

   
    
}