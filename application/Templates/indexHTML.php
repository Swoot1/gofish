<?php

namespace GoFish\Application\Templates;

echo '<!DOCTYPE html>
<html ng-app="GoFish">
<head>
    <title>Ojas fiskeri</title>
    <meta charset="utf-8"/>
    <link href="Application/Public/Foundation/css/foundation.css" type="text/css" rel="stylesheet"/>
    <link href="Application/Public/test.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="content">
    <div ng-view></div>
</div>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular-resource.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular-route.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/app.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Directives/EnsureUniqueFish.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Directives/Focus.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Filters.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Controllers/FishController.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Controllers/CaughtFishController.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Controllers/UserController.js"></script>
</body>
</html>';