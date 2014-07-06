<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 19:44
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Models;

use GoFish\Application\ENFramework\Collections\PropertyValidationCollection;
use GoFish\Application\ENFramework\Models\GeneralModel;
use GoFish\Application\ENFramework\Helpers\PropertyValidation;

class Fish extends GeneralModel
{
    protected $id;
    protected $name;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Sets the type and length validation on all properties.
     * @return $this
     */
    protected function setUpValidation()
    {
        $validation = new PropertyValidationCollection(array(
            new PropertyValidation(array(
                    'dataType' => 'integer',
                    'genericName' => 'FiskID',
                    'propertyName' => 'id'
                )
            ),
            new PropertyValidation(array(
                    'dataType' => 'integer',
                    'genericName' => 'ID:t för fisktyp',
                    'propertyName' => 'name'
                )
            ),

        ));
        $this->setValidation($validation);
        return $this;
    }

    protected function setUpDefaultValues()
    {
        $defaultValues = array(
            'id' => null,
            'name' => null
        );

        $this->setDefaultValues($defaultValues);
    }
}