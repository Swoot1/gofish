<?php
/**
 * User: Elin
 * Date: 2014-07-09
 * Time: 10:40
 */

namespace GoFish\Tests\ENFrameworkTests\HelperTests;


class ErrorHandlerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that the undefined variable error throws a ErrorException.
     * @expectedException \GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\ErrorException
     */
    public function testErrorHandler()
    {
        require_once 'GoFish\Application\ENFramework\Helpers\ErrorHandling\ErrorHandler.php';

        echo $test;
    }

    /**
     * @expectedException \GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\FatalErrorException
     */
    public function testFatalErrorHandler(){
        require_once 'GoFish\Application\ENFramework\Helpers\ErrorHandling\ErrorHandler.php';

        array_shif(array());
    }
} 