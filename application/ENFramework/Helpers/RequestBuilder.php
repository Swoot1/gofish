<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 21:23
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\ENFramework\Helpers;


use GoFish\Application\Collections\RequestMethodCollection;
use GoFish\Application\ENFramework\Models\Request;

class RequestBuilder
{
    private $buildSource;
    /**
     * @var \GoFish\Application\ENFramework\Models\Request
     */
    private $requestModel;

    /**
     * @param $_SERVER |array $buildSource
     * @param RequestMethodCollection $requestMethodCollection
     */
    public function __construct(array $buildSource, RequestMethodCollection $requestMethodCollection)
    {
        $this->requestModel = new Request(array(), $requestMethodCollection);
        $this->buildSource = $buildSource;
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $this->setURI();
        $this->setRequestMethod();
        $this->setResource();

        return $this->requestModel;
    }

    /**
     * Sets if the request method is PUT/POST/etc.
     * @return $this
     */
    private function setRequestMethod()
    {
        $requestMethod = $this->buildSource['REQUEST_METHOD'];
        $this->requestModel->setRequestMethod($requestMethod);
        return $this;
    }

    private function setURI()
    {
        $this->requestModel->setRequestURI(ltrim($this->buildSource['REQUEST_URI'], '/'));
        return $this;
    }

    /**
     * The url params as an array /user/1 becomes array('user', '1').
     * @return $this
     */
    private function setResource()
    {
        $parsedURL = parse_url($this->buildSource['REQUEST_URI']);
        $urlParams = array_values(array_filter(explode('/', $parsedURL['path'])));

        $this->requestModel->setURLParams($urlParams);

        return $this;
    }
}