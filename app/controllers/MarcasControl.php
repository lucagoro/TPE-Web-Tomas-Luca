<?php
require_once 'app/models/MarcasModel.php';
require_once 'app/views/MarcasView.php';

class MarcasControl{
    private $view;
    private $model;

    function __construct() {
        $this->model = new MarcasModel();
        $this->view = new MarcasView();
    }

    function showMarcas(){
        $marcas = $this->model->getAllMarcas();
        $this->view->showMarcas($marcas);
    }

    function showMarca($id){
        $marca = $this->model->getMarca($id);
        $this->view->showMarca($marca);
    }

    function addMarca(){
        $marca = $_POST['nombre'];
        $sede = $_POST['sede'];

        if(empty($marca) || empty($sede)){
            $this->view->showError('Faltan campos obligatorios! Por favor completarlos para seguir con el proceso.');
        }
        $id = $this->model->insertMarca($marca, $sede);
        if($id){
            header("Location: ". BASE_URL);
        }else{
            $this->view->showError('Error al cargar marca!');
        }
    }

    function removeMarcas($id){
        $this->model->deleteMarca($id);
    }

    function editMarca($id_marca){
        $marca = $_POST['nombre'];
        $sede = $_POST['sede'];

        if(empty($marca) || empty($sede)){
            $this->view->showError('Faltan campos obligatorios!');
        }

        $id = $this->model->editMarca($marca, $sede, $id_marca);
        if($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError('Error al editar marca!');
        }
    }
}