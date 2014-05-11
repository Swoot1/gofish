<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:38
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Models;

use GoFish\Application\ENFramework\Collections\PropertyValidationCollection;
use GoFish\Application\ENFramework\Models\GeneralModel;
use GoFish\Application\Helpers\PropertyValidation;

class CaughtFish extends GeneralModel
{
    protected $id;
    protected $fishId;
    protected $userId;
    protected $weight;
    protected $measurement;
    protected $fishName;

    public function __construct(array $data = array())
    {
        parent::__construct($data);
    }

//    public function setId($id) // TODO
//    {
//        $this->id = $id;
//    }
//
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function setFishId($fishId)
//    {
//        $this->fishId = $fishId;
//    }
//
//    public function getFishId()
//    {
//        return $this->fishId;
//    }
//
//    public function setMeasurement($measurement)
//    {
//        $this->measurement = $measurement;
//    }
//
//    public function getMeasurement()
//    {
//        return $this->measurement;
//    }
//
//    public function setFishName($name)
//    {
//        $this->fishName = $name;
//    }
//
//    public function getFishName()
//    {
//        return $this->fishName;
//    }
//
//    public function setUserId($userId)
//    {
//        $this->userId = $userId;
//    }
//
//    public function getUserId()
//    {
//        return $this->userId;
//    }
//
//    public function setWeight($weight)
//    {
//        $this->weight = $weight;
//    }
//
//    public function getWeight()
//    {
//        return $this->weight;
//    }

    /**
     * Sets the type and length validation on all properties.
     * @return $this
     */
    protected function setUpValidation()
    {
        $validation = new PropertyValidationCollection(array(
            'id' => new PropertyValidation(array(
                        'dataType' => 'integer',
                        'genericName' => 'ID:t för fångad fisk')
                ),
            'fishId' => new PropertyValidation(array(
                        'dataType' => 'integer',
                        'genericName' => 'ID:t för fisktyp')
                ),

        ));
        $this->setValidation($validation);
        return $this;
    }

    /**
     *
     */
    protected function setUpNoDBProperties()
    {
        $noDBProperties = array(
            'fishName'
        );

        $this->setNoDBProperties($noDBProperties);
    }

    protected function setUpDefaultValues()
    {
        $defaultValues = array(
            'id' => null,
            'fishId' => null,
            'userId' => null,
            'weight' => null,
            'measurement' => null,
            'fishName' => null
        );

        $this->setDefaultValues($defaultValues);
    }
}