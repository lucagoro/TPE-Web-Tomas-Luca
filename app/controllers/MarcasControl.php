<?php
require_once 'app/models/MarcasModel.php';
require_once 'app/views/MarcasView.php';

class MarcasControl{
    private $view;
    private $model;
    private $modelBotin;

    function __construct($res) {
        $this->model = new MarcasModel();
        $this->view = new MarcasView($res);
        $this->modelBotin = new BotinModel();
    }

    function showMarcas(){
        $marcas = $this->model->getAllMarcas();
        $botines = $this->modelBotin->getAll();
        $this->view->showMarcas($marcas);
    }

    function showMarca($id){
        $marca = $this->model->getMarca($id);
        $botines = $this->model->getBotinesByMarca($id);
        $this->view->showMarca($marca, $botines);
    }

    function addMarca(){
        $marca = $_POST['nombre'];
        $sede = $_POST['sede'];
        $foto = $_POST['foto'];

        if(empty($marca) || empty($sede)){
            $this->view->showError('Faltan campos obligatorios! Por favor completarlos para seguir con el proceso.');
        }
        $this->model->insertMarca($marca, $sede, $foto);
        header("Location: " . BASE_URL . "marcas");
        
    }

    function removeMarcas($id){
        $this->model->deleteMarca($id);
        header("Location: " . BASE_URL . "marcas");
    }

    function editMarca($id_marca){


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $marca = trim($_POST["nombre"]);
            $sede = trim($_POST["sede"]);
            $foto = trim($_POST["foto"]);
        }
            if(empty($marca) || empty($sede)){
                $this->view->showError('Faltan campos obligatorios!');
            }

            $id = $this->model->editMarca($marca, $sede, $id_marca, $foto);
            if($id) {
                header("Location: " . BASE_URL . "marcas");
            } else {
                $this->view->showError('Error al editar marca!');
            }
    }
    function preEdit($id_marca){
        $marca = $this->model->getMarca($id_marca);
        $this->view->showEditForm($marca);
        
    }
}