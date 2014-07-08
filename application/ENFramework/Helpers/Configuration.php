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