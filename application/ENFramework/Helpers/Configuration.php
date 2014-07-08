<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-08
 * Time: 21:12
 * To change this template use File | Settings | File Templates.
 */

// Set where the application is found on disk.
set_include_path('C:/Users/Elin/repos/');

// Set the folder where the saved session files should go. Change the second argument if you want to change the folder.
ini_set('session.save_path', 'tmp');

// Set up the auto loader.
require_once 'AutoLoader.php';
$autoLoader = new \GoFish\Application\ENFramework\Helpers\Autoloader();
$autoLoader->setUpAutoLoader();


/**
 * http://stackoverflow.com/questions/841500/php-exceptions-vs-errors
 * @param $code
 * @param $message
 * @param $file
 * @param $line
 * @throws GoFish\Application\ENFramework\Helpers\exceptionHandlers\ErrorException
 */
function throwErrorException($code, $message, $file, $line)
{
    throw new \GoFish\Application\ENFramework\Helpers\exceptionHandlers\ErrorException($code, $message, $file, $line);
}

set_error_handler('throwErrorException');

/**
 * http://stackoverflow.com/questions/277224/how-do-i-catch-a-php-fatal-error
 * @throws GoFish\Application\ENFramework\Helpers\exceptionHandlers\FatalErrorException
 */
function fatal_handler()
{

    $file = "unknown file";
    $message = "shutdown";
    $code = E_CORE_ERROR;
    $line = 0;

    $error = error_get_last();

    if ($error !== NULL) {
        $code = $error["type"];
        $file = $error["file"];
        $line = $error["line"];
        $message = $error["message"];
    }

    throw new \GoFish\Application\ENFramework\Helpers\exceptionHandlers\FatalErrorException($code, $message, $file, $line);
}

register_shutdown_function("fatal_handler");