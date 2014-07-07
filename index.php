<?php
require_once 'Application/ENFramework/Helpers/Configuration.php';

try {
    $requestDispatcher = new \GoFish\Application\ENFramework\Helpers\RequestDispatcher();
    $requestModel = $requestDispatcher->getRequestModel();

    $dependencyInjectionContainer = simplexml_load_file('Application/ENFramework/Helpers/DependencyInjectionContainer.xml');
    $routing = new \GoFish\Application\ENFramework\Helpers\Routing($requestModel, $dependencyInjectionContainer);
    $routeCollection = include_once 'Application/ENFramework/Helpers/RoutesConfiguration.php';
    $route = $routeCollection->getRoute($requestModel);

    if ($route && $requestModel->getRequestURI() != 'session') {
        session_start();
    }

    if ($route) {
        $result = $routing->callMethod($route);
        $result = json_encode($result ? $result->toArray() : array(), JSON_UNESCAPED_UNICODE);
        $header = new \GoFish\Application\ENFramework\Helpers\Header();
        $header->executeHeader();
        echo $result;
    } else {
        include 'Application\Templates\indexHTML.php';
        $result = json_encode(array());
    }

} catch (Exception $exception) {
    $errorHTTPStatusCodeFactory = new \GoFish\Application\ENFramework\Helpers\exceptionHandlers\ErrorHTTPStatusCodeFactory($exception);
    $HTTPStatusCode = $errorHTTPStatusCodeFactory->getHTTPStatusCode();
    $header = new \GoFish\Application\ENFramework\Helpers\Header();
    $header->setResponseCode($HTTPStatusCode);
    $header->executeHeader();
    echo $exception->getMessage();
}










































