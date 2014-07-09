<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 16:50
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\ENFramework\Models;


use GoFish\Application\Collections\RequestMethodCollection;
use GoFish\Application\ENFramework\Helpers\Exceptions\ApplicationException;

class Request extends GeneralModel
{
    private $requestMethodCollection;
    private $requestMethod;
    private $urlParams;
    private $requestURI;

    public function __construct(array $data, RequestMethodCollection $requestMethodCollection)
    {
        $this->setRequestMethodCollection($requestMethodCollection);
        parent::__construct($data);
    }

    private function setRequestMethodCollection(RequestMethodCollection $requestMethodCollection)
    {
        $this->requestMethodCollection = $requestMethodCollection;
    }

    public function setRequestURI($value)
    {
        $this->requestURI = $value;
    }

    public function getRequestURI()
    {
        return $this->requestURI;
    }

    private function getRequestMethodCollection()
    {
        return $this->requestMethodCollection;
    }

    /**
     * @param array $serverArray
     */
    public function setRequestMethod($requestMethod)
    {
        $this->validateRequestMethod($requestMethod);
        $this->requestMethod = $requestMethod;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function setURLParams(array $urlParams)
    {
        $this->urlParams = $urlParams;
        return $this;
    }

    public function getURLParams()
    {
        return $this->urlParams;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function validateRequestMethod($methodName)
    {
        $requestMethodCollection = $this->getRequestMethodCollection();
        $isValidRequestMethod = $requestMethodCollection->isValidRequestMethod($methodName);

        if (!$isValidRequestMethod) {
            throw new ApplicationException('Ange en vettig request-typ för bövelen.');
        }

        return true;
    }

    public function setUpValidation()
    {
        // TODO
    }

    public function getRequestData(){
        return json_decode(file_get_contents("php://input"), true);
    }
}