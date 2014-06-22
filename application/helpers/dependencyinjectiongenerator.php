<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-06-21
 * Time: 11:33
 */

// TODO fix this so that it works with interfaces i.e. IDatabaseConnection
// TODO fix this so that it works with services that requires other service i.e. the sessionservice need of userservice.

function getDependenciesFromFolder($folderName)
{
    $folderDirectory = openDir('..\\' . $folderName);
    $result = array();

    while ($fileName = readdir($folderDirectory)) {

        $isNotADotElement = $fileName != '.' && $fileName != '..';

        if ($isNotADotElement) {
            $result = getDependencies($folderName, $fileName, $result);
        }
    }

    closedir($folderDirectory);

    return convertToXML($result);
}

function getDependencies($path, $fileName, array $dependenciesArray = array())
{
    $dependency = getDependency($path, $fileName);
    $dependenciesArray[] = $dependency;

    foreach ($dependency['dependencies'] as $subDependency) {
        $path = ltrim($subDependency['namespace'], 'GoFish\Application\\');
        $class = $subDependency['class'] . '.php';

        $dependenciesArray = getDependencies(
            $path,
            $class,
            $dependenciesArray);
    }

    return $dependenciesArray;
}

/**
 * Returns an array dependency that can be converted to XML and inserted to the dynamic dependency injector.
 * @param $path
 * @param $fileName
 * @return array
 */
function getDependency($path, $fileName)
{
    $dependency = array('class' => rtrim($fileName, '.php'));
    $controllerClassAsString = file_get_contents('..\\' . $path . '\\' . $fileName, 'r');

    $namespace = getNameSpace($controllerClassAsString);

    $dependency['namespace'] = $namespace;
    $dependency['dependencies'] = getConstructorDependencies($controllerClassAsString);

    return $dependency;
}

/**
 * Gets the namespace from the class string.
 * @param $classContentAsString
 * @return mixed
 */
function getNamespace($classContentAsString)
{
    preg_match('/namespace.+\\n/', $classContentAsString, $matchesNamespace);
    $namespaceLine = reset($matchesNamespace);
    return preg_replace('/namespace |;\r\n/', '', $namespaceLine);

}

/**
 * Gets class constructors dependencies.
 * @param $classContentAsString
 * @return array
 */
function getConstructorDependencies($classContentAsString)
{

    $matchesUse = getUseStatements($classContentAsString);

    preg_match('/__construct.+\\n/', $classContentAsString, $matchesConstructor);
    $constructorLine = reset($matchesConstructor);
    $startPosition = strpos($constructorLine, '(') + 1;
    $endPosition = strpos($constructorLine, ')') - $startPosition;
    $dependencies = array();
    $namespace = '';
    $constructorTakesParams = $endPosition > 0;

    if ($constructorTakesParams) {
        $dependencyString = substr($constructorLine, $startPosition, $endPosition);
        $dependencyStringArray = explode(' ', $dependencyString);

        for ($i = 0; $i < count($dependencyStringArray); $i += 2) {
            $className = $dependencyStringArray[($i)];

            for ($k = 0; $k < count($matchesUse); $k++) {

                if (preg_match('/' . $className . '/', $matchesUse[$k]) > 0) {
                    $namespace = $matchesUse[$k];
                    $namespace = rtrim(substr($namespace, 0, strpos($namespace, $className)), '\\');
                    break;
                }
            }


            $dependencies[] = array('namespace' => $namespace, 'class' => $className);
        }
    }

    return $dependencies;
}


/**
 * Returns the class use statements in an array i.e. "<?php .. some text.. use GoFish\Application\Services\UserService; .."
 * becomes array('GoFish\Application\Services\UserService')
 * @param $classContentAsString
 * @return array
 */
function getUseStatements($classContentAsString)
{
    preg_match_all('/use .+;+/', $classContentAsString, $matchesUse);
    $matchesUse = reset($matchesUse);

    foreach ($matchesUse as $key => $use) {
        $startPosition = strpos($use, 'use ') + 4;
        $endPosition = strpos($use, ';') - $startPosition;
        $matchesUse[$key] = substr($use, $startPosition, $endPosition);
    }

    return $matchesUse;
}

/**
 * @param array $dependencies
 */
function convertToXML(array $dependencies)
{
    $DOMDocument = new DOMDocument('1.0', 'utf-8');
    $attentionCommentElement = $DOMDocument->createComment('This is generated automatically. All changes to this file will be overwritten.');
    $DOMDocument->appendChild($attentionCommentElement);
    $goFishElement = $DOMDocument->createElement('gofish');
    $dependenciesElement = $DOMDocument->createElement('dependencies');
    $dependenciesElement = getDependenciesXML($DOMDocument, $dependenciesElement, $dependencies);
    $goFishElement->appendChild($dependenciesElement);
    $DOMDocument->appendChild($goFishElement);
    $DOMDocument->save('dependencyinjection.xml');
}

function getDependenciesXML(DOMDocument $DOMDocument, DOMElement $dependenciesElement, array $dependencies)
{

    foreach ($dependencies as $dependency) {
        $dependencyElement = $DOMDocument->createElement('dependency');

        // Add namespace
        $dependencyElementNamespaceAttribute = $DOMDocument->createAttribute('namespace');
        $dependencyElementNamespaceAttribute->value = $dependency['namespace'];
        $dependencyElement->appendChild($dependencyElementNamespaceAttribute);

        // Add class
        $dependencyElementClassAttribute = $DOMDocument->createAttribute('class');
        $dependencyElementClassAttribute->value = $dependency['class'];
        $dependencyElement->appendChild($dependencyElementClassAttribute);


        if (array_key_exists('dependencies', $dependency)) {
            $subDependenciesElement = $DOMDocument->createElement('dependencies');
            $subDependenciesElement = getDependenciesXML($DOMDocument, $subDependenciesElement, $dependency['dependencies']);
            $dependencyElement->appendChild($subDependenciesElement);
        }

        $dependenciesElement->appendChild($dependencyElement);
    }

    return $dependenciesElement;
}

$result = getDependenciesFromFolder('Controllers');