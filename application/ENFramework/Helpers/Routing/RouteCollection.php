<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-13
 * Time: 11:29
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\ENFramework\Helpers\Routing;

use GoFish\Application\ENFramework\Collections\GeneralCollection;
use GoFish\Application\ENFramework\Models\Request;

class RouteCollection extends GeneralCollection
{
    protected $model = 'GoFish\Application\ENFramework\Helpers\Routing\Route';

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