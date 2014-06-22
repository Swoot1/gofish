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

class SessionController
{


    /**
     * @var \GoFish\Application\Services\SessionService
     */
    private $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function create(array $data)
    {
        return $this->sessionService->create($data);
    }

    public function delete()
    {
        return $this->sessionService->delete();
    }
} 