<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 21:23
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;


use GoFish\Application\Collections\RequestMethodCollection;
use GoFish\Application\Models\Request;

class RequestBuilder
{
    private $buildSource;
    private $requestModel;

    public function __construct(array $buildSource, RequestMethodCollection $requestMethodCollection)
    {
        $this->setRequestModel($requestMethodCollection);
        $this->setBuildSource($buildSource);
    }

    /**
     * @param array $buildSource
     */
    private function setBuildSource(array $buildSource)
    {
        $this->buildSource = $buildSource;
    }

    private function getBuildSource()
    {
        return $this->buildSource;
    }

    /**
     * @param RequestMethodCollection $requestMethodCollection
     * @return $this
     */
    private function setRequestModel(RequestMethodCollection $requestMethodCollection)
    {
        $this->requestModel = new Request(array(), $requestMethodCollection);
        return $this;
    }

    /**
     * @return mixed
     */
    private function getRequestModel()
    {
        return $this->requestModel;
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setURI();
        $this->setRequestMethod();
        $this->setResource();

        return $this->getRequestModel();
    }

    /**
     * @return $this
     */
    private function setRequestMethod()
    {

        $buildSource = $this->getBuildSource();
        $requestMethod = $buildSource['REQUEST_METHOD'];

        $requestModel = $this->getRequestModel();
        $requestModel->setRequestMethod($requestMethod);

        return $this;
    }

    private function setURI()
    {
        $buildSource = $this->getBuildSource();
        $this->getRequestModel()->setRequestURI(ltrim($buildSource['REQUEST_URI'], '/'));

        return $this;
    }

    private function setResource()
    {
        $buildSource = $this->getBuildSource();
        $parsedURL = parse_url($buildSource['REQUEST_URI']);
        $urlParams = array_values(array_filter(explode('/', $parsedURL['path'])));

        $this->getRequestModel()->setURLParams($urlParams);

        return $this;
    }
}