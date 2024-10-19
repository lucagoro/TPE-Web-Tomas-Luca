<?php
 include "app/controllers/BotinControl.php";
 include "app/controllers/MarcasControl.php";
 include "app/controllers/AuthControl.php";
 include "libs/response.php";
 include "app/middlewares/sessionAuthMiddleware.php";
 include "app/middlewares/verifyAuthMiddleware.php";

 

 define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

 if(!empty($_GET['action'])) {
    $action = $_GET['action'];
 } else {
    $action = 'botines'; // cambiar a inicio cuando este
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
    case 'insertarr':
        $controller = new MarcasControl();
        $controller->addMarca();
        break;
    case 'eliminar':
        $controller = new MarcasControl();
        $controller->removeMarcas($params[1]);
        break;
    case 'editarr':
        $controller = new MarcasControl();
        $controller->editMarca($params[1]);
        break;
    case 'botines':
        sessionAuthMiddleware($res);
        $controller = new BotinControl($res);
        $controller->showBotines();
        break;
    case 'botin':
        sessionAuthMiddleware($res);
        $controller = new BotinControl($res);
        $controller->showBotin($params[1]);
        break;
    case 'insertar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new BotinControl($res);
        $controller->addBotines();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new BotinControl($res);
        $controller->removeBotines($params[1]);
        break;
    case 'editBotin':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new BotinControl($res);
        $controller->editBotin($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthControl();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthControl();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthControl();
        $controller->logout();
        break;
    default:
    echo "ERROR 404 not found";
    break;
 }