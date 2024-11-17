<?php
    require_once 'libs/router.php';
    require_once 'app/controllers/item.controller.php';

    $router = new Router();

    #                 endpoint        verbo      controller              metodo
    $router->addRoute('plantas',      'GET',     'PlantApiController',   'getAll');
    $router->addRoute('plantas/:id',  'PUT',     'PlantApiController',   'update');
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

