<?php
session_start();
//CONFIGURACION
require_once 'config.php';
$app= App::getInstance();

//CONTROLADORES
require_once ROOT_PATH . 'controllers/ControllerPage.php';
require_once ROOT_PATH . 'controllers/ControllerAjaxItem.php';
require_once ROOT_PATH . 'controllers/ControllerAjaxUser.php';

//MANAGER CONTROLLER
$uri = filter_input(INPUT_SERVER,'REQUEST_URI');
$explode = explode($app->config['baseUrl'], $uri);
$resource = $explode[1];
$pos = strpos($resource, '?');    
if($pos!==false){
    $resource = substr($resource, 0, $pos);
}

if(isset($_SESSION['username'])){
    switch ($resource) {
        case 'ajax/items':
            $controller = new ControllerAjaxItem();
            $action = filter_input(INPUT_GET,'action');
            if(method_exists($controller, $action)){
                $controller->$action();
            }else{
               header("HTTP/1.0 404 Not Found");
            }
            break;
        case 'ajax/user':
            $controller = new ControllerAjaxUser();
            $action = filter_input(INPUT_GET,'action');
            if(method_exists($controller, $action)){
                $controller->$action();
            }else{
               header("HTTP/1.0 404 Not Found");
            }
            break;
        default:
            $controller = new ControllerPage();
            $controller->myTodoList();
            break;
    }

}else{
    switch ($resource) {
        case 'ajax/user':
            $controller = new ControllerAjaxUser();
            $action = filter_input(INPUT_GET,'action');
            if(method_exists($controller, $action)){
                $controller->$action();
            }else{
               header("HTTP/1.0 404 Not Found");
            }
            break;
        default:
            $controller = new ControllerPage();
            $controller->login();
            break;
    }
    
}
    
