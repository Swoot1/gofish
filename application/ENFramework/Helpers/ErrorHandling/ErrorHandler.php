<?php
/**
 * User: Elin
 * Date: 2014-07-09
 * Time: 10:09
 */

use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\ErrorException;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\FatalErrorException;

/**
 * Throws an exception when an error occurrs i.e. when a variable is used but never defined.
 * http://stackoverflow.com/questions/841500/php-exceptions-vs-errors
 * @param $code
 * @param $message
 * @param $file
 * @param $line
 * @throws ErrorException
 */
function throwErrorException($code, $message, $file, $line)
{
    throw new ErrorException($code, $message, $file, $line);
}

set_error_handler('throwErrorException');


/**
 * Handles errors raised i.e. when a function that doesn't exist is called.
 * http://stackoverflow.com/questions/277224/how-do-i-catch-a-php-fatal-error
 * @throws FatalErrorException
 */
function handleFatalError()
{
    $error = error_get_last();

    if ($error !== NULL) {
        $code = $error["type"];
        $file = $error["file"];
        $line = $error["line"];
        $message = $error["message"];

        throw new FatalErrorException($code, $message, $file, $line);
    }
}

register_shutdown_function("handleFatalError");