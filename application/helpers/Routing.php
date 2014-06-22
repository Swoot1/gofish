<?php
/**
 * User: Elin
 * Date: 2014-06-21
 * Time: 11:19
 */

namespace GoFish\Application\Helpers;


use GoFish\Application\ENFramework\Models\Request;
use GoFish\Application\Helpers\exceptionHandlers\ApplicationException;

class Routing
{

    private $request;
    private $dependencyInjector;

    public function __construct(Request $request, \SimpleXMLElement $dependencyInjector)
    {
        $this->request = $request;
        $this->dependencyInjector = $dependencyInjector;
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws ApplicationException
     */
    public function callMethod(Route $route)
    {
        $controller = $this->getController($route->getController());
        if ($this->request->getRequestMethod() === 'GET') {
            if ($id = trim(preg_replace('/user/', '', $this->request->getRequestURI()), '/')) { // TODO user is hard coded
                $result = $controller->read($id);
            } else {
                $result = $controller->index();
            }
        } else if ($this->request->getRequestMethod() === 'DELETE') {
            if ($id = trim(preg_replace('/user/', '', $this->request->getRequestURI()), '/')) { // TODO user is hard coded
                $result = $controller->delete($id);
            } else {
                throw new ApplicationException('Ange ett id för borttagning.');
            }
        } else if ($this->request->getRequestMethod() === 'POST') {
            $requestData = $this->request->getRequestData();
            $result = $controller->create($requestData);
        } else if ($this->request->getRequestMethod() === 'PUT') {
            $requestData = $this->request->getRequestData();
            if ($id = trim(preg_replace('/user/', '', $this->request->getRequestURI()), '/')) { // TODO user is hard coded
                $result = $controller->update($id, $requestData);
            } else {
                throw new ApplicationException('Ange ett id för uppdatering.');
            }
        } else {
            throw new ApplicationException('Ogiltig request-metod.');
        }

        return $result;

    }

    private function getController($controllerName){
        $DItest = new \GoFish\Application\Helpers\DITest($this->dependencyInjector);
        return $DItest->getController($controllerName);
    }
} 