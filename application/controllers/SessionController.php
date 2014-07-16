<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-18
 * Time: 14:24
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\ENFramework\Helpers\Response;
use GoFish\Application\Services\SessionService;

class SessionController // TODO
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
        $session = $this->sessionService->create($data);
        $response = new Response();
        $response->setData($session->toArray());
        return $response;

    }

    public function delete()
    {
        return $this->sessionService->delete();
    }
} 