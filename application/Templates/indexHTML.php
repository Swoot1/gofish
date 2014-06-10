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
    <div ng-controller="FishController">
        <div class="row">
            <div class="large-12 columns">
                <h1>Lägg till fångst</h1>
                <form name="caught_fish_form" ng-submit="createCaughtFish()">
                    <input name="fisherId" type="text" ng-model="caughtFish.userId" placeholder="Fiskarens id" ng-focus/>
                    <div class="error" ng-show="caught_fish_form.weight.$dirty && caught_fish_form.$invalid && !caught_fish_form.weight.$focused">
                        <small class="error" ng-show="caught_fish_form.weight.$error.required">
                            Hörredu! Vikt krävs!!
                        </small>
                    </div>
                    <input name="weight" type="number" type="number" ng-model="caughtFish.weight" ng-minlength=1 min="1" max="10" required novalidate placeholder="Vikt" ng-focus/>
                    <input name="measurement" type="number" ng-model="caughtFish.measurement" ng-minlength=1 min="1" max="10" required novalidate placeholder="Längd" ng-focus/>
                    <select name="fishId" ng-model="caughtFish.fishId" required novalidate>
                        <option ng:repeat="fish in fishCollection" ng-cloak value="{{fish.id}}">{{fish.name}}</option>
                    </select>
                    <button type="submit" ng-disabled="caught_fish_form.$invalid">Lägg till fångst</button>
                </form>
                <div class="row">
                    <div class="large-12 columns">
                        <ul ng-repeat="caughtFish in caughtFishCollection">
                            <li>
                                <p ng-cloak>Användarid: {{caughtFish.userId}}. FiskId: {{caughtFish.fishId}}</p>
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
        <form name="fish_form">
            <div class="row">
                <div class="large-12 columns">
                    <div class="error" ng-show="fish_form.name.$dirty && fish_form.$invalid">
                        <small class="error" ng-show="fish_form.$error.unique">
                                WOoow! Den fisken finns redan!
                        </small>
                    </div>
                    <input id="fish" ng-model="fish.name" type="text" ensure-unique-fish="name" ng-placeholder="Fiskens förnamn" ng-focus/>
                    <button type="button" ng-click="addFish()" ng-disabled="fish_form.$invalid">Lägg till fisk</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="large-12 columns">
                <ul ng-repeat="fish in fishCollection">
                    <li><p>{{fish.name |lowercase | capitalize}}  <input type="button" ng-click="deleteFish(fish)"class="button alert tiny" value="Ta bort fisk"/></p></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular-resource.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/app.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Directives/EnsureUniqueFish.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Directives/Focus.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Filters.js"></script>
<script type="text/javascript" src="Application/Public/Scripts/Controllers/FishController.js"></script>
</body>
</html>';