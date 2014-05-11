<?php

namespace GoFish\Application\Templates;

echo '<!DOCTYPE html>
<html ng-app>
<head>
    <title>Ojas fiskeri</title>
    <meta charset="utf-8"/>
    <link href="Application/Public/Foundation/css/foundation.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="content">
    <div ng-controller="FishController">
        <div class="row">
            <div class="large-12 columns">
                <h1>Lägg till fiskar</h1>
            </div>
        </div>
        <form>
            <div class="row">
                <div class="large-12 columns">
                    <ul ng-repeat="fish in fishes">
                        <li><p>{{fish.name}}</p></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input id="fish" ng-model="fish.name" ng-model-instant type="text" placeholder="Name of the fish"/>
                    <button ng-click="addFish()">Add</button>
                </div>
            </div>
            {{fish.model}}
        </form>
    </div>
</div>
<script type="text/javascript" src="Application/Public/Scripts/FishController.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/angular.js"></script>
</body>
</html>';