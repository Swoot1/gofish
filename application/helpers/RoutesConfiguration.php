<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-13
 * Time: 15:08
 * To change this template use File | Settings | File Templates.
 */


$routes = array();

$routes[] = array(
    'resource' => 'fish',
    'controller' => 'FishController'
);

$routes[] = array(
    'resource' => 'users',
    'controller' => 'UserController'
);

$routes[] = array(
    'resource' => 'sessions',
    'controller' => 'SessionController'
);

$routes[] = array(
    'resource' => 'caughtfish',
    'controller' => 'CaughtFishController'
);

return new \GoFish\Application\Helpers\RouteCollection($routes);