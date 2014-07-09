<?php
/**
 * User: Elin
 * Date: 2014-06-21
 * Time: 11:19
 */

namespace GoFish\Application\ENFramework\Helpers\Routing;


use GoFish\Application\ENFramework\Helpers\DependencyInjection\DependencyInjection;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\ApplicationException;
use GoFish\Application\ENFramework\Helpers\ErrorHandling\Exceptions\NoSuchRouteException;
use GoFish\Application\ENFramework\Models\Request;

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
        $controller = $this->getController($route);
        $requestURIAsArray = explode('/', $this->request->getRequestURI());
        $id = isset($requestURIAsArray[1]) ? $requestURIAsArray[1] : false;
        $requestMethod = $this->request->getRequestMethod();
        $requestData = $this->request->getRequestData();

        if ($requestMethod === 'GET') {
            if ($id) {
                $result = $controller->read($id);
            } else {
                $result = $controller->index();
            }
        } else if ($requestMethod === 'DELETE') {
            if ($id) {
                $result = $controller->delete($id);
            } else {
                throw new ApplicationException('Ange ett id för borttagning.');
            }
        } else if ($requestMethod === 'POST') {
            $result = $controller->create($requestData);
        } else if ($requestMethod === 'PUT') {
            if ($id) {
                $result = $controller->update($id, $requestData);
            } else {
                throw new ApplicationException('Ange ett id för uppdatering.');
            }
        } else {
            throw new NoSuchRouteException('Ogiltigt request.');
        }

        return $result;

    }

    /**
     * @param String $controllerName
     * @return null|object
     */
    private function getController(Route $route)
    {
        $dependencyInjectionContainer = new DependencyInjection($this->dependencyInjector);
        return $dependencyInjectionContainer->getInstantiatedClass($route->getController());
    }
} 