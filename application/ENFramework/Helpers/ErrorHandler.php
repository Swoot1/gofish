<?php
/**
 * User: Elin
 * Date: 2014-07-09
 * Time: 10:09
 */

namespace GoFish\Application\ENFramework\Helpers;


class ErrorHandler
{

    public function setupErrorHandlers()
    {
        set_error_handler('throwErrorException');
        register_shutdown_function("handleFatalError");
    }

    /**
     * Handle errors that're raised when i.e. a variable is used but never defined.
     * http://stackoverflow.com/questions/841500/php-exceptions-vs-errors
     * @param $code
     * @param $message
     * @param $file
     * @param $line
     * @throws exceptionHandlers\ErrorException
     */
    private function throwErrorException($code, $message, $file, $line)
    {
        throw new \GoFish\Application\ENFramework\Helpers\exceptionHandlers\ErrorException($code, $message, $file, $line);
    }


    /**
     * Handle errors that're raised i.e. when a function that doesn't exist is called.
     * http://stackoverflow.com/questions/277224/how-do-i-catch-a-php-fatal-error
     * @throws exceptionHandlers\FatalErrorException
     */
    private function handleFatalError()
    {
        $error = error_get_last();

        if ($error !== NULL) {
            $code = $error["type"];
            $file = $error["file"];
            $line = $error["line"];
            $message = $error["message"];

            throw new \GoFish\Application\ENFramework\Helpers\exceptionHandlers\FatalErrorException($code, $message, $file, $line);
        }
    }
} 