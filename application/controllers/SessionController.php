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
use GoFish\Application\Services\SessionService;
use GoFish\Application\Services\UserService;

class SessionController {


    /**
     * @var GoFish\Application\Services\SessionService
     */
    private $sessionService;

    public function __construct()
    {
        $databaseConnection = new DatabaseConnection();
        $userMapper = new UserMapper($databaseConnection);
        $userService = new UserService($userMapper);
        $sessionService = new SessionService($userService);
        $this->setSessionService($sessionService);
    }

    private function setSessionService($sessionService)
    {
        $this->sessionService = $sessionService;
    }


    private function getSessionService()
    {
        return $this->sessionService;
    }

    public function create(array $data){
        $sessionService = $this->getSessionService();
        $sessionService->create($data);
    }
} 