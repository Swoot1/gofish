<?php
/**
 * User: Elin
 * Date: 2014-07-11
 * Time: 12:14
 */

namespace GoFish\Application\Controllers;


use GoFish\Application\ENFramework\Helpers\Response;
use GoFish\Application\Services\AuthorizationService;

class AuthorizationController {
    /**
     * @var \GoFish\Application\Services\AuthorizationService
     */
    private $authorizationService;

    public function __construct(AuthorizationService $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }

    public function login(array $data)
    {
        $authorization = $this->authorizationService->login($data);
        $response = new Response();
        $response->setData($authorization->toArray());
        return $response;

    }

    public function logout()
    {
       $this->authorizationService->logout();
        $response = new Response();
        return $response;
    }
} 