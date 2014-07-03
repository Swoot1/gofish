<?php
/**
 * User: Elin
 * Date: 2014-07-03
 * Time: 17:07
 */

namespace GoFish\Tests\ENFrameworkTests\HelperTests;
include '../../../Application/Helpers/Route.php';

use GoFish\Application\Helpers\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{

    public function testGetController()
    {
        $route = new Route(
            array(
                'resource' => 'users',
                'controllerName' => 'userController'
            )
        );

        $this->assertEquals('userController', $route->getController());
    }

} 