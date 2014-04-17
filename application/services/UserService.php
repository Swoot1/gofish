<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:42
 */

namespace GoFish\Application\Services;


use GoFish\Application\Collections\UserCollection;
use GoFish\Application\Mappers\UserMapper;
use GoFish\Application\Models\User;

class UserService {
    private $userMapper;

    public function __construct(UserMapper $userMapper)
    {
        $this->setUserMapper($userMapper);
    }

    /**
     * @param UserMapper $userMapper
     * @return $this
     */
    private function setUserMapper(UserMapper $userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getUserMapper()
    {
        return $this->userMapper;
    }

    public function index()
    {
        $userMapper = $this->getUserMapper();
        $userData = $userMapper->index();

        return new UserCollection($userData);
    }

    public function create(array $data)
    {
        $userModel = new User($data);
        $userMapper = $this->getUserMapper();
        $DBParameters = $userModel->getDBParameters();
        $result = $userMapper->create($DBParameters);
        return $userModel;
    }

    public function read($id){
        $userMapper = $this->getUserMapper();
        $userData = $userMapper->read($id);

        return $userData ? new User($userData) : null;
    }

    public function update($id, $requestData){
        $userMapper = $this->getUserMapper();

        $savedUser = $this->read($id);

        if($savedUser == null){
            throw new \Exception('implement me');
        }

        $user = new User($requestData);

        $userMapper->update($user->getDBParameters());
        return $requestData ? new User($requestData) : null;
    }

    public function delete($id){
        $userMapper = $this->getUserMapper();
        $userMapper->delete($id);
    }
} 