<?php

require_once 'Application/Helpers/Autoloader.php';
require_once 'Application/Helpers/Configuration.php';

putenv('TMP=C:/temp');

$configuration = new \GoFish\Application\Helpers\Configuration();
$configuration->setUpConfiguration();

$autoLoader = new \GoFish\Application\Helpers\Autoloader();
$autoLoader->setUpAutoLoader();

$requestDispatcher = new \GoFish\Application\Helpers\RequestDispatcher();
$requestModel = $requestDispatcher->getRequestModel();

$routeCollection = include_once 'Application/Helpers/RoutesConfiguration.php';

$route = $routeCollection->getRoute($requestModel);

if ($route) {
    $result = $route->callMethod($requestModel);
    $result = json_encode($result ? $result->toArray() : array(), JSON_UNESCAPED_UNICODE);
    header('Content-Type: Application/json; charset=utf-8');
    echo $result;
} else {
    $html = '<!DOCTYPE html>
                <html ng-app>
                    <head>
                        <title>Ojas fiskeri</title>
                        <meta charset="utf-8"/>
                        <div id="content">
                        <div ng-controller="FishController">
                        <form>
                        <ul ng-repeat="fish in fishes">
                            <li>{{fish.name}}</li>
                        </ul>
                        <input id="fish" ng-model="fish.name" ng-model-instant type="text" placeholder="Name of the fish"/>
                        <button ng-click="addFish()">Add</button>
                        {{fish.model}}
                        </div>
                        </div>
                    </head>
                    <script type="text/javascript" src="Application/Public/Scripts/FishController.js"></script>
                    <script type="text/javascript" src="Application/Public/Scripts/angular.js"></script>
                    <body>
                    </body>
                </html>';
    echo $html;
    $result = json_encode(array());
}










































