<?php
require_once 'Router.php';
require_once './Controller/resenias.api.Controller.php';





$router = new Router();

$router->addRoute('resenias', 'GET', 'ReseniasApiController', 'getResenias');
$router->addRoute('resenias/:ID', 'GET', 'ReseniasApiController', 'getResenia');
$router->addRoute('resenias/:ID', 'DELETE', 'ReseniasApiController', 'deleteResenia');
$router->addRoute('resenias', 'POST', 'ReseniasApiController', 'insertResenia'); 
$router->addRoute('resenias/:ID', 'PUT', 'ReseniasApiController', 'editResenia'); 



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
