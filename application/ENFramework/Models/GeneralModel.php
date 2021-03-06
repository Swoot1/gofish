<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 21:18
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\ENFramework\Models;

use GoFish\Application\ENFramework\Collections\PropertyValidationCollection;

abstract class GeneralModel
{
    protected $_validation;
    protected $_noDBProperties = array();
    protected $_defaultValues = array();

    public function __construct(array $data = array())
    {
        $this->setUpValidation();
        $this->setData($data);
    }

    protected function setValidation(PropertyValidationCollection $validation)
    {
        $this->_validation = $validation;
    }

    protected function setNoDBProperties(array $noDBProperties)
    {
        $this->_noDBProperties = $noDBProperties;
    }

    protected function getNoDBProperties()
    {
        return $this->_noDBProperties;
    }

    protected function setDefaultValues(array $defaultValues)
    {
        $this->_defaultValues = $defaultValues;
    }

    private function setData(array $data)
    {
        foreach ($data as $propertyName => $value) {
            $this->_validation->validate($propertyName, $value);
            $this->$propertyName = $value;
        }

        return $this;
    }

    abstract protected function setUpValidation();

    /**
     * @return array
     */
    public function toArray()
    {
        $modelProperties = get_object_vars($this);
        $modelProperties = $this->filterModelProperties($modelProperties);
        return $this->setPropertiesFromSubModels($modelProperties);
    }

    /**
     * @return array
     */
    public function getDBParameters()
    {
        $modelProperties = get_object_vars($this);
        $modelProperties = $this->filterDBModelProperties($modelProperties);
        return $this->setDBPropertiesFromSubModels($modelProperties);
    }

    /**
     * @param array $modelProperties
     * @return array
     */
    private function filterModelProperties(array $modelProperties)
    {
        foreach ($modelProperties as $propertyName => $value) {
            if ($this->isInternalProperty($propertyName)) {
                unset($modelProperties[$propertyName]);
            }
        }

        return $modelProperties;
    }

    /**
     * @param array $modelProperties
     * @return array
     */
    private function filterDBModelProperties(array $modelProperties)
    {
        foreach ($modelProperties as $propertyName => $value) {
            if ($this->isInternalProperty($propertyName) || $this->isNoDBProperty($propertyName)) {
                unset($modelProperties[$propertyName]);
            }
        }

        return $modelProperties;
    }

    /**
     * @param $propertyName
     * @return bool
     */
    private function isNoDBProperty($propertyName)
    {
        return array_search($propertyName, $this->getNoDBProperties()) !== false;
    }

    /**
     * @param array $modelProperties
     * @return array
     */
    private function setDBPropertiesFromSubModels(array $modelProperties)
    {
        foreach ($modelProperties as $propertyName => $value) {
            if ($value instanceof GeneralModel) {
                $modelProperties[$propertyName] = $value->getDbParams();
            }
        }

        return $modelProperties;
    }

    /**
     * @param array $modelProperties
     * @return array
     */
    private function setPropertiesFromSubModels(array $modelProperties)
    {
        foreach ($modelProperties as $propertyName => $value) {
            if ($value instanceof GeneralModel) {
                $modelProperties[$propertyName] = $value->toArray();
            }
        }

        return $modelProperties;
    }

    /**
     * @param $propertyName
     * @return bool
     */
    private function isInternalProperty($propertyName)
    {
        return substr($propertyName, 0, 1) === '_';
    }
}