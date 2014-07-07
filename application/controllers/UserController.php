<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:42
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\Services\UserService;

class UserController
{

    /**
     * @var \GoFish\Application\Services\UserService
     */
    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $userService = $this->userService;
        return $userService->index();
    }

    public function create(array $data)
    {
        $userService = $this->userService;
        return $userService->create($data);
    }

    public function read($id)
    {
        $userService = $this->userService;
        return $userService->read($id);
    }

    public function update($id, $requestData)
    {
        $userService = $this->userService;
        return $userService->update($id, $requestData);
    }

    public function delete($id)
    {
        $userService = $this->userService;
        $userService->delete($id);
    }
} 