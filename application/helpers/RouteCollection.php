<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-13
 * Time: 11:29
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;


use GoFish\Application\Collections\GeneralCollection;
use GoFish\Application\Models\Request;

class RouteCollection extends GeneralCollection
{
    protected $model = 'GoFish\Application\helpers\Route';

    public function getRoute(Request $request)
    {
        $matchingRoute = false;

        foreach ($this->data as $route) {
            if ($route->isMatchingRoute($request->getRequestURI(), $request)) {
                $matchingRoute = $route;
                break;
            }
        }
        return $matchingRoute;
    }

}