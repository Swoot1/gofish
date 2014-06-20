<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-18
 * Time: 14:40
 */

namespace GoFish\Application\Services;


use GoFish\Application\Helpers\exceptionHandlers\ApplicationException;
use GoFish\Application\Helpers\SessionManager;
use GoFish\Application\Models\Session;

class SessionService
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create($data)
    {
        $user = $this->userService->getUserByEmail($data['email']);
        $invalidLogin = $user === null || $user->isValidPassword($data['password']) == false;

        if ($invalidLogin) {
            throw new ApplicationException('Fel e-postadress eller användarnamn.');
        } else {
            SessionManager::startSession('User');
        }

        return new Session(array('isLoggedIn' => true));
    }

    public function delete()
    {
        SessionManager::endSession();
    }
} 