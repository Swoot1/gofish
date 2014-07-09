<?php
/**
 * User: Elin
 * Date: 2014-07-08
 * Time: 21:47
 */

namespace GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions;


class ErrorException extends \Exception{

    public function __construct($code, $message, $file, $line){
        parent::__construct($message, $code);

        $this->file = $file;
        $this->line = $line;
    }
} 