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
                <h1>Lägg till fångst</h1>
                <form>
                    <input type="text" ng-model="caughtFish.userId" ng-model-instant placeholder="Fiskarens id" />
                    <input type="number" ng-model="caughtFish.weight" min="1" max="10" placeholder="Vikt"/>
                    <input type="number" ng-model="caughtFish.measurement" min="1" max="10" placeholder="Längd"/>
                    <select ng-model="caughtFish.fishId">
                        <option ng:repeat="fish in fishCollection" value="{{fish.id}}">{{fish.name}}</option>
                    </select>
                    <button type="button" ng-click="addCaughtFish()">Lägg till fångst</button>
                </form>
                <div class="row">
                    <div class="large-12 columns">
                        <ul ng-repeat="caughtFish in caughtFishCollection">
                            <li>
                                <p>Användarid: {{caughtFish.userId}}. FiskId: {{caughtFish.fishId}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <h1>Lägg till fiskar</h1>
            </div>
        </div>
        <form>
            <div class="row">
                <div class="large-12 columns">
                    <input id="fish" ng-model="fish.name" ng-model-instant type="text" placeholder="Fiskens förnamn"/>
                    <button type="button" ng-click="addFish()">Lägg till fisk</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="large-12 columns">
                <ul ng-repeat="fish in fishCollection">
                    <li><p>{{fish.name}}  <input type="button" ng-click="deleteFish(fish)"class="button alert tiny" value="Ta bort fisk"/></p></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="Application/Public/Scripts/angular.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular-resource.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/FishController.js"></script>
</body>
</html>';