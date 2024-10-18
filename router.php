<?php
 include "app/controllers/BotinControl.php";
 include "app/controllers/MarcasControl.php";
 include "app/controllers/AuthControl.php";
 

 define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

 if(!empty($_GET['action'])) {
    $action = $_GET['action'];
 } else {
    $action = 'botines' || $action = 'marcas'; // cambiar a inicio cuando este
 }

 $params = explode('/', $action);

 switch($params[0]) {
    //case 'inicio':
    //aca seguro un metodo de tomi (lista de marcas)
    case 'marcas':
        $controller = new MarcasControl();
        $controller->showMarcas();
        break;
    case 'nombre':
        $controller = new MarcasControl();
        $controller->showMarca($params[1]);
        break;
    case 'insertar':
        $controller = new MarcasControl();
        $controller->addMarca();
        break;
    case 'eliminar':
        $controller = new MarcasControl();
        $controller->removeMarcas($params[1]);
        break;
    case 'editar':
        $controller = new MarcasControl();
        $controller->editMarca($idBotin);
        break;
    case 'botines':
        $controller = new BotinControl();
        $controller->showBotines();
        break;
    case 'botin':
        $controller = new BotinControl();
        $controller->showBotin($params[1]);
        break;
    case 'insertar':
        $controller = new BotinControl();
        $controller->addBotines();
        break;
    case 'eliminar':
        $controller = new BotinControl();
        $controller->removeBotines($params[1]);
        break;
    case 'editar':
        $controller = new BotinControl();
        $controller->editBotin($idBotin);
        break;
    case 'showLogin':
        $controller = new AuthControl();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthControl();
        $controller->login();
        break;
    default:
    echo "ERROR 404 not found";
    break;
 }