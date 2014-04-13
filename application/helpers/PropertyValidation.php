<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 20:32
 * To change this template use File | Settings | File Templates.
 */
namespace GoFish\Application\Helpers;

class PropertyValidation {
    protected $dataType;
    protected $minLength;
    protected $maxLength;
    protected $genericName;
    protected $allowNull = false;

    public function __construct($data){

    }

    private function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }

    public function getDataType()
    {
        return $this->dataType;
    }

    private function setGenericName($genericName)
    {
        $this->genericName = $genericName;
    }

    public function getGenericName()
    {
        return $this->genericName;
    }

    private function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function getMaxLength()
    {
        return $this->maxLength;
    }

    private function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    public function getMinLength()
    {
        return $this->minLength;
    }

    private function setAllowNull($allowNull)
    {
        $this->allowNull = $allowNull;
    }

    public function getAllowNull()
    {
        return $this->allowNull;
    }


}