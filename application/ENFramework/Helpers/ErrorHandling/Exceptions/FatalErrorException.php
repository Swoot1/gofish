<?php
/**
 * User: Elin
 * Date: 2014-07-08
 * Time: 21:57
 */

namespace GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions;

/**
 * An exception that is thrown when a error occurs, i.e. when a function that doesn't exist is called.
 * Class FatalErrorException
 * @package GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions
 */
class FatalErrorException extends \Exception
{
    public function __construct($code, $message, $file, $line)
    {
        parent::__construct($message, $code);

        $this->file = $file;
        $this->line = $line;
    }
} 