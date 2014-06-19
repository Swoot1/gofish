<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:40
 */

namespace GoFish\Application\Models;

use GoFish\Application\ENFramework\Collections\PropertyValidationCollection;
use GoFish\Application\ENFramework\Models\GeneralModel;

class User extends GeneralModel
{

    protected $id;
    protected $username;
    protected $email;
    protected $password;

    protected function setUpValidation()
    {
        $this->setValidation(new PropertyValidationCollection(array()));
    }

    /**
     * @param $password
     * @return bool
     */
    public function isValidPassword($password){
        return password_verify($password, $this->password);
    }
} 