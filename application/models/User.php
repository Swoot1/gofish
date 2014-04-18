<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:40
 */

namespace GoFish\Application\Models;


use GoFish\Application\Collections\PropertyValidationCollection;
use GoFish\Application\ENFramework\Models\GeneralModel;

class User extends GeneralModel{

    protected $id;
    protected $username;
    protected $email;
    protected $password;

    protected function setUpValidation(){

        // TODO autoloader isn't working here.
        $this->setValidation(new PropertyValidationCollection(array()));
    }
} 