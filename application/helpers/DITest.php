<?php
/**
 * User: Elin
 * Date: 2014-06-20
 * Time: 12:49
 */

namespace GoFish\Application\Helpers;


use GoFish\Application\ENFramework\Models\Request;
use GoFish\Application\Helpers\exceptionHandlers\ApplicationException;

class DITest
{

    private $dependencyInjectionXML;
    private $request;

    public function __construct(Request $request, \SimpleXMLElement $dependencyInjectionXML)
    {
        $this->request = $request;
        $this->dependencyInjectionXML = $dependencyInjectionXML;
    }

    public function getController()
    {
        $route = $this->request->getRequestURI();
        return $this->getResourceFromXML(array('route' => $route));
    }

    /**
     * Gets the first resource as a reflection class that matches the attributes
     * param.
     * @param array $attributes
     * @return null|object
     * @throws exceptionHandlers\ApplicationException
     */
    private function getResourceFromXML(array $attributes)
    {
        $attributesQuery = $this->getAttributesQuery($attributes);
        $dependencies = array();
        $matchingResource = array_shift($this->dependencyInjectionXML->xpath('dependencies/dependency' . $attributesQuery));
        if ($matchingResource) {

            foreach ($matchingResource->dependencies->dependency as $dependency) {
                $dependencyClass = $this->getResourceFromXML(array('id' => (string)$dependency['id'], 'class' => (string)$dependency['class']));

                if ($dependencyClass == null) {
                    throw new ApplicationException('Hittade inte dependency.');
                }
                $dependencies[] = $dependencyClass;
            }

            $result = $this->getClassInstanceFromXML($matchingResource, $dependencies);

        } else {
            $result = null;
        }

        return $result;

    }

    /**
     * Returns a reflection class of the class corresponding to the simpleXMLElement.
     * @param \SimpleXMLElement $matchingResource
     * @param array $dependencies
     * @return object
     */
    private function getClassInstanceFromXML(\SimpleXMLElement $matchingResource, array $dependencies)
    {
        $className = sprintf('%s\%s', (string)$matchingResource->attributes()->class, (string)$matchingResource->attributes()->id);
        $reflectionClass = new \ReflectionClass($className);
        return $reflectionClass->newInstanceArgs($dependencies);

    }

    /**
     * Make a string of the attributes i.e. array('route' => 'user', 'id' => 'UserController')
     * becomes '[@route=user and @id=UserController]'
     * @param array $attributes
     * @return string
     */
    private function getAttributesQuery(array $attributes)
    {
        $attributeStrings = array();
        foreach ($attributes as $attributeName => $attributeValue) {
            $attributeStrings[] = sprintf('@%s="%s"', $attributeName, $attributeValue);
        }

        return count($attributeStrings) > 0 ? sprintf('[%s]', implode(' and ', $attributeStrings)) : '';
    }
} 