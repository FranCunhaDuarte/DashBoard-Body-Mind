<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/Controller/home.api.controller.php';

    $router = new Router();

    #                endpoint     verb     controller             method
    $router->addRoute('dashboard/home',     'GET',    'HomeApiController', 'getSummaryData'   );
    
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);