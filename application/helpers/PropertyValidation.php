<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 20:32
 * To change this template use File | Settings | File Templates.
 */
namespace GoFish\Application\Helpers;

use GoFish\Application\Helpers\exceptionHandlers\ApplicationException;

class PropertyValidation
{
//    protected $dataTypeValidation;
    protected $minLength = 1;
    protected $maxLength = null;
    protected $genericName;
    protected $propertyName;
    protected $allowNull = false;

    public function __construct($data)
    {
        foreach($data as $propertyName => $value){
            $this->$propertyName = $value;
        }
    }

    public function validate($value)
    {
        $this->validateNull($value);
        $this->validateMinLength($value);
        $this->validateMaxLength($value);
    }

    /**
     * @param $value
     * @return bool
     * @throws exceptionHandlers\ApplicationException
     */
    private function validateNull($value)
    {
        if ($value === null && $this->allowNull === false) {
            throw new ApplicationException('Ange ett värde för ' . $this->genericName);
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     * @throws exceptionHandlers\ApplicationException
     */
    private function validateMinLength($value)
    {
        if (strlen($value) < $this->minLength) {
            throw new ApplicationException($this->genericName . 'måste vara minst' . $this->minLength . 'långt.');
        }

        return true;
    }

    /**
     * @param $value
     * @return bool
     * @throws exceptionHandlers\ApplicationException
     */
    private function validateMaxLength($value)
    {
        if ($this->maxLength && strlen($value > $this->maxLength)) {
            throw new ApplicationException($this->genericName . 'får vara högst' . $this->maxLength . 'långt.');
        }

        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function hasMatchingData($data)
    {
        $result = true;

        foreach ($data as $propertyName => $value) {
            if ($this->$propertyName !== $value) {
                $result = false;
                break;
            }
        }

        return $result;
    }

}