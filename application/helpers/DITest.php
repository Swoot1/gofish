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
        return $this->getClassFromXML(array('route' => $route));
    }

    /**
     * Gets the first resource as a reflection class that matches the associated array $attributes
     * param.
     * @param array $attributes
     * @return null|object
     * @throws exceptionHandlers\ApplicationException
     */
    private function getClassFromXML(array $attributes)
    {
        $matchingResource = $this->getMatchingResourceFromXML($attributes);

        if ($matchingResource) {
            $classDependencies = $this->getClassDependencies($matchingResource);
            $result = $this->createClassInstanceFromXML($matchingResource, $classDependencies);

        } else {
            $result = null;
        }

        return $result;

    }

    /**
     * Returns an array of the dependencies needing for creating the class
     * from matchingResource.
     * @param \SimpleXMLElement $matchingResource
     * @return array
     * @throws exceptionHandlers\ApplicationException
     */
    private function getClassDependencies(\SimpleXMLElement $matchingResource)
    {
        $dependencies = array();

        foreach ($matchingResource->dependencies->dependency as $dependency) {
            $dependencyClass = $this->getClassFromXML(array('id' => (string)$dependency['id'], 'class' => (string)$dependency['class']));

            if ($dependencyClass == null) {
                throw new ApplicationException('Hittade inte dependency.');
            }

            $dependencies[] = $dependencyClass;
        }

        return $dependencies;
    }

    /**
     * Queries the xml for a dependency element with the corresponding
     * attributes and returns the first match.
     * @param array $attributes
     * @return mixed
     */
    private function getMatchingResourceFromXML(array $attributes)
    {
        $attributesQuery = $this->getAttributesQuery($attributes);
        $matchingResources = $this->dependencyInjectionXML->xpath('dependencies/dependency' . $attributesQuery);
        return array_shift($matchingResources);
    }

    /**
     * Returns a reflection class of the class corresponding to the simpleXMLElement.
     * @param \SimpleXMLElement $matchingResource
     * @param array $dependencies
     * @return object
     */
    private function createClassInstanceFromXML(\SimpleXMLElement $matchingResource, array $dependencies)
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