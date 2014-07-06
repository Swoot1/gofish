<?php

require_once 'Application/ENFramework/Helpers/AutoLoader.php';
require_once 'Application/ENFramework/Helpers/Configuration.php';

putenv('TMP=C:/temp');
$configuration = new \GoFish\Application\ENFramework\Helpers\Configuration();
$configuration->setUpConfiguration();

$autoLoader = new \GoFish\Application\ENFramework\Helpers\Autoloader();
$autoLoader->setUpAutoLoader();

$requestDispatcher = new \GoFish\Application\ENFramework\Helpers\RequestDispatcher();
$requestModel = $requestDispatcher->getRequestModel();

$DICXML = simplexml_load_file('Application/ENFramework/Helpers/DependencyInjectionContainer.xml');
$routing = new \GoFish\Application\ENFramework\Helpers\Routing($requestModel, $DICXML);
$routeCollection = include_once 'Application/ENFramework/Helpers/RoutesConfiguration.php';
$route = $routeCollection->getRoute($requestModel);


if($route && $requestModel->getRequestURI() != 'session'){
   session_start();
}

if ($route) {
    $result = $routing->callMethod($route);
    $result = json_encode($result ? $result->toArray() : array(), JSON_UNESCAPED_UNICODE);
    header('Content-Type: Application/json; charset=utf-8');
    echo $result;
} else {
    include 'Application\Templates\indexHTML.php';
    $result = json_encode(array());
}










































