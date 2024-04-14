<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'app/Controller/home.api.controller.php';
    require_once 'app/Controller/members.api.controller.php';

    $router = new Router();
 
    #                endpoint     verb     controller             method
    $router->addRoute('/home/:DATE',     'GET',    'HomeApiController',    'getSummaryData'   );
    $router->addRoute('/members',        'GET',    'MembersApiController', 'getMembers'   );
    $router->addRoute('/members/:ID',    'GET',    'MembersApiController', 'getMembers'   );
    
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);