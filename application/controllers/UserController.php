<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:42
 */

namespace GoFish\Application\Controllers;


use GoFish\Application\ENFramework\Models\DatabaseConnection;
use GoFish\Application\Mappers\UserMapper;
use GoFish\Application\Services\UserService;

class UserController {

    /**
     * @var GoFish\Application\Services\UserService
     */
    private $userService;

    public function __construct()
    {
        $databaseConnection = new DatabaseConnection();
        $userMapper = new UserMapper($databaseConnection);
        $userService = new UserService($userMapper);
        $this->setUserService($userService);
    }

    private function setUserService($userService)
    {
        $this->userService = $userService;
    }

    private function getUserService()
    {
        return $this->userService;
    }

    public function index()
    {
        $userService = $this->getUserService();
        return $userService->index();
    }

    public function create(array $data)
    {
        $userService = $this->getUserService();
        return $userService->create($data);
    }

    public function read($id)
    {
        $userService = $this->getUserService();
        return $userService->read($id);
    }

    public function update($id, $requestData)
    {
        $userService = $this->getUserService();
        return $userService->update($id, $requestData);
    }

    public function delete($id)
    {
        $userService = $this->getUserService();
        return $userService->delete($id);
    }
} 