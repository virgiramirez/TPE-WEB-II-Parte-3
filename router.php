<?php
require_once 'libs/router.php';
require_once 'app/controllers/plant.api.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/middlewares/jwt.auth.middleware.php';
$router = new Router();

$router->addMiddleware(new JWTAuthMiddleware());

#                 endpoint        verbo      controller              metodo
$router->addRoute('plantas', 'GET', 'PlantApiController', 'getAllFiltred' );

$router->addRoute('plantas/:id', 'GET', 'PlantApiController', 'get' );
$router->addRoute('plantas', 'POST', 'PlantApiController', 'create');

$router->addRoute('usuarios/token', 'GET','UserApiController','getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);