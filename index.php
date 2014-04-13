<?php

require_once 'application/helpers/Autoloader.php';
require_once 'application/helpers/Configuration.php';

putenv('TMP=C:/temp');

$configuration = new \GoFish\Application\Helpers\Configuration();
$configuration->setUpConfiguration();

$autoLoader = new \GoFish\Application\Helpers\Autoloader();
$autoLoader->setUpAutoLoader();

$requestDispatcher = new \GoFish\Application\Helpers\RequestDispatcher();
$requestModel = $requestDispatcher->getRequestModel();

$routeCollection = include_once 'application/helpers/RoutesConfiguration.php';

$route = $routeCollection->getRoute($requestModel);

if ($route) {
    $result = $route->callMethod($requestModel);
    $result = json_encode($result ? $result->toArray() : array(), JSON_UNESCAPED_UNICODE);
}

//$middleware = new \GoFish\Application\Helpers\Middleware($requestModel);
//
//$response = $middleware->getResponse();
header('Content-Type: application/json; charset=utf-8');
echo $result;






































//    $html = '<!DOCTYPE html>
//<html>
//<head>
//	<title>Ojas fiskeri</title>
//	<meta charset="utf-8"/>
//	<script src="scripts/javascript.js" type="text/javascript"></script>
//	<div id="content">
//	<form>
//    <input id="fisher" type="text" placeholder="Storfiskarns namn"/>
//    <select id="fish">
//        <option value="1">Gädda</option>
//        <option value="2">Mört</option>
//    </select>
//    <input id="weight" type="text" placeholder="Hur möe vägde han?"/>
//    <input id="measurement" type="text" placeholder="Hur lång va han?"/>
//    <button class="js-submit-catch">Skrytknapp</button>
//
//	</div>
//</head>
//<body>
//</body>
//</html>';
//    echo $html;

