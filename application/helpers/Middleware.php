<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 20:59
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;

use GoFish\Application\Models\Request;

class Middleware
{

    private $requestModel;

    public function __construct(Request $requestModel)
    {
        $this->setRequestModel($requestModel);
    }

    private function setRequestModel(Request $requestModel)
    {
        $this->requestModel = $requestModel;
        return $this;
    }

    private function getRequestModel()
    {
        return $this->requestModel;
    }

    public function getResponse()
    {

        $requestModel = $this->getRequestModel();
        $controllerName = $this->getControllerPath();

        switch ($requestModel->getRequestMethod()) {
            case 'POST':
                $methodName = 'create';
                break;
            case 'PUT':
                $methodName = 'update';
                break;
            case 'DELETE':
                $methodName = 'delete';
                break;
            default:
                $methodName = 'index';
                break;
        }

        $controllerPath = $controllerName;
        $controller = new $controllerPath();
//        $response = $controller->$methodName($this->getRequestModel()->getURLParams()[2]); // For delete
        $response = $controller->$methodName($this->getRequestData());
        return json_encode($response->toArray(), JSON_UNESCAPED_UNICODE);
    }

    private function getRequestData(){
        return json_decode(file_get_contents("php://input"), true);
    }

    private function getControllerPath()
    {
        $requestModel = $this->getRequestModel();
        $urlParams = $requestModel->getURLParams();

        $controllerName = array_shift($urlParams);

        return 'GoFish\Application\Controllers\\' . ucfirst($controllerName) . 'Controller';
    }
}