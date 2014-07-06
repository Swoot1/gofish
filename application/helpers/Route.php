<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-13
 * Time: 11:29
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;

use GoFish\Application\ENFramework\Helpers\exceptionHandlers\ApplicationException;

class Route
{
    protected $resource;
    protected $controllerName;
    protected $requiresAuthorization = true;
    // allowed request methods

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function getController()
    {
        return $this->controllerName;
    }

    public function isMatchingRoute($stringToMatch)
    {
        return $stringToMatch != '' && preg_match(sprintf('/^\/{0,1}%s(\/\d{1,10}){0,1}(\?(\w{0,30}=[\w\d]{0,200}&{0,1}){0,100}){0,1}$/', $this->resource), $stringToMatch) == 1;
    }
}