<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-08
 * Time: 17:14
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;


class Autoloader
{

    public function setUpAutoLoader()
    {
        spl_autoload_extensions('.php');
        spl_autoload_register();
    }
}