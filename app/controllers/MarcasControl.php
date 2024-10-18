<?php
require_once 'app/models/MarcasModel.php';
require_once 'app/views/MarcasViews.php';

class MarcasControl{
    private $view;
    private $model;

    function __construct() {
        $this->model = new MarcasModel();
        $this->view = new MarcasView();
    }
    function showMarcas(){
        $marcas=$this->model->getMarcas();
        $this->view->showMarcas($marcas);
    }
}