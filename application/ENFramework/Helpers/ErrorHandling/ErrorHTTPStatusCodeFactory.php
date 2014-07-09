<?php
/**
 * User: Elin
 * Date: 2014-07-06
 * Time: 19:48
 */

namespace GoFish\Application\ENFramework\Helpers\ErrorHandling;


use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\ApplicationException;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\ConflictException;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\MethodNotAllowedException;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\NoSuchRouteException;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\NotFoundException;

class ErrorHTTPStatusCodeFactory
{

    private $_exception;

    public function __construct(\Exception $exception)
    {
        $this->_exception = $exception;
    }

    public function getHTTPStatusCode()
    {
        if ($this->_exception instanceof ApplicationException) {
            $HTTPStatusCode = 403;
        } elseif ($this->_exception instanceof NoSuchRouteException || $this->_exception instanceof NotFoundException) {
            $HTTPStatusCode = 404;
        } elseif ($this->_exception instanceof ConflictException) {
            $HTTPStatusCode = 409;
        } elseif ($this->_exception instanceof MethodNotAllowedException) {
            $HTTPStatusCode = 405;
        } else {
            $HTTPStatusCode = 500;
        }

        return $HTTPStatusCode;
    }
}