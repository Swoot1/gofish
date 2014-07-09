<?php
use GoFish\Application\ENFramework\Helpers\ErrorHandling\ErrorHTTPStatusCodeFactory;

require_once 'Application/ENFramework/Helpers/Configuration.php';

try {
    $requestDispatcher = new \GoFish\Application\ENFramework\Helpers\RequestDispatcher();
    $requestModel = $requestDispatcher->getRequestModel();

    $dependencyInjectionContainer = simplexml_load_file('Application/ENFramework/Helpers/DependencyInjection/DependencyInjectionContainer.xml');
    $routing = new \GoFish\Application\ENFramework\Helpers\Routing\Routing($requestModel, $dependencyInjectionContainer);
    $routeCollection = include_once 'Application/ENFramework/Helpers/Routing/RoutesConfiguration.php';
    $route = $routeCollection->getRoute($requestModel);

    if ($route && $requestModel->getRequestURI() != 'session') {
        session_start();
    }

    // TODO fix trace on errors
    if ($route) {
        $response = $routing->callMethod($route);
        $response->sendResponse();
    } else {
        include 'Application\Templates\indexHTML.php';
    }

} catch (Exception $exception) {
    $errorHTTPStatusCodeFactory = new ErrorHTTPStatusCodeFactory($exception);
    $HTTPStatusCode = $errorHTTPStatusCodeFactory->getHTTPStatusCode();
    $response = new \GoFish\Application\ENFramework\Helpers\Response();
    $response->setStatusCode($HTTPStatusCode);
    $response->setData(array('Message' => $exception->getMessage()));
    $response->sendResponse();
}










































