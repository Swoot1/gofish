<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:40
 */

namespace GoFish\Application\Models;


use GoFish\Application\Collections\PropertyValidationCollection;

class User extends GeneralModel{
    protected $id;
    protected $name;




    protected function setUpValidation(){
        $this->setValidation(new PropertyValidationCollection(array()));
    }

} 