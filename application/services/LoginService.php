<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-18
 * Time: 14:40
 */

namespace GoFish\Application\Services;


use GoFish\Application\Helpers\SessionManager;
use GoFish\Application\Models\Login;

class LoginService {

    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function create($data){
        SessionManager::startSession('User');
        return new Login(array('isLoggedIn' => true));
    }
} 