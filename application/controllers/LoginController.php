<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-18
 * Time: 14:24
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\ENFramework\Models\DatabaseConnection;
use GoFish\Application\Mappers\UserMapper;
use GoFish\Application\Services\LoginService;
use GoFish\Application\Services\SessionService;
use GoFish\Application\Services\UserService;

class LoginController {


    /**
     * @var GoFish\Application\Services\LoginService
     */
    private $loginService;

    public function __construct()
    {
        $databaseConnection = new DatabaseConnection();
        $userMapper = new UserMapper($databaseConnection);
        $userService = new UserService($userMapper);
        $loginService = new LoginService($userService);
        $this->setLoginService($loginService);
    }

    private function setLoginService($loginService)
    {
        $this->loginService = $loginService;
    }


    private function getLoginService()
    {
        return $this->loginService;
    }

    public function create(array $data){
        $loginService = $this->getLoginService();
        return $loginService->create($data);
    }
} 