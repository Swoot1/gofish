<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-13
 * Time: 11:29
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;

use GoFish\Application\Helpers\exceptionHandlers\ApplicationException;
use GoFish\Application\ENFramework\Models\Request;

class Route
{
    protected $resource;
    protected $controller;
    // allowed request methods

    public function __construct(array $data){
        foreach($data as $key => $value){
            $this->$key = $value;
        }
    }

    private function getResource()
    {
        return $this->resource;
    }

    private function getController()
    {
        $controller = 'GoFish\Application\Controllers\\' . $this->controller; // TODO remove hard coding.
        return new $controller();
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
     * @throws ApplicationException
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
                throw new ApplicationException('Ange ett id för borttagning.');
            }
        } else if ($request->getRequestMethod() === 'POST') {
            $requestData = $request->getRequestData();
            $result = $controller->create($requestData);
        } else if($request->getRequestMethod() === 'PUT'){
            $requestData = $request->getRequestData();
            if ($id = trim(preg_replace('/' . $this->getResource() . '/', '', $request->getRequestURI()), '/')) {
                $result = $controller->update($id, $requestData);
            } else {
                throw new ApplicationException('Ange ett id för uppdatering.');
            }
        }else {
            throw new ApplicationException('Ogiltig request-metod.');
        }

        return $result;
    }
}