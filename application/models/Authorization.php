<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-06-17
 * Time: 20:44
 */

namespace GoFish\Application\Models;


use GoFish\Application\ENFramework\Collections\PropertyValidationCollection;
use GoFish\Application\ENFramework\Models\GeneralModel;
use GoFish\Application\ENFramework\Helpers\PropertyValidation;

class Authorization extends GeneralModel
{
    protected $isLoggedIn = false;


    protected function setUpValidation()
    {
        $this->setValidation(new PropertyValidationCollection(array(
            new PropertyValidation(array(
                    'dataType' => 'boolean',
                    'genericName' => 'Inloggad-flagga',
                    'propertyName' => 'isLoggedIn'
                )
            )
        )));
    }
}