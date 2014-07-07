<?php
/**
 * User: Elin
 * Date: 2014-07-06
 * Time: 19:48
 */

namespace GoFish\Application\ENFramework\Helpers\exceptionHandlers;


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
            $HTTPStatusCode = 200;
        } elseif ($this->_exception instanceof NoSuchRouteException) {
            $HTTPStatusCode = 404;
        } else {
            $HTTPStatusCode = 500;
        }

        return $HTTPStatusCode;
    }
}