<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-13
 * Time: 11:29
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;


use GoFish\Application\Models\Request;

class Route
{
//    protected $requestMethodCollection = 'GET';
    protected $resource = 'fishes';
    protected $controller = 'GoFish\Application\Controllers\FishController';
    protected $actions; // TODO

    private function getResource()
    {
        return $this->resource;
    }

//    public function setRequestMethodCollection(){
//        $this->requestMethodCollection = new RequestMethodCollection();
//    }

//    private function getRequestType(){
//        return $this->requestType;
//    }

    private function getController()
    {
        return new $this->controller();
    }

    public function isMatchingRoute($stringToMatch)
    {
        return $this->matchURLString($stringToMatch);
    }

    private function matchURLString($stringToMatch)
    {
        return strpos($stringToMatch, $this->getResource()) === 0; // TODO fix this can match fishparty/1 when the user want to go to fish.
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function callMethod(Request $request)
    {
        $controller = $this->getController();
        if ($request->getRequestMethod() === 'GET') {
            if ($id = trim(preg_replace('/' . $this->getResource() . '/', '', $request->getRequestURI()), '/')) {
                $result = $controller->read($id);
            } else {
                $result = $controller->index();
            }
        } else if ($request->getRequestMethod() === 'DELETE') {
            if ($id = trim(preg_replace('/' . $this->getResource() . '/', '', $request->getRequestURI()), '/')) {
                $result = $controller->delete($id);
            } else {
                throw Exception('Implement exception class.');
            }
        } else if ($request->getRequestMethod() === 'POST') {
            $requestData = $request->getRequestData();
            $result = $controller->create($requestData);
        } else if($request->getRequestMethod() === 'PUT'){
            $requestData = $request->getRequestData();
            if ($id = trim(preg_replace('/' . $this->getResource() . '/', '', $request->getRequestURI()), '/')) {
                $result = $controller->update($id, $requestData);
            } else {
                throw Exception('Implement exception class.');
            }
        }else {
            throw new Exception('Implement PUT etc.');
        }

        return $result;
    }
}