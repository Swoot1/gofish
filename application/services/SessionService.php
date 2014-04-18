<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-18
 * Time: 14:40
 */

namespace GoFish\Application\Services;


class SessionService {

    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function create($data){
        session_start();
        session_id(1);
//        $user = $this->userService->read($data['userId']);
    }
} 