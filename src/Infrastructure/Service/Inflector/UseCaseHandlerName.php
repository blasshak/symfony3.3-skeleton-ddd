<?php

namespace App\Infrastructure\Service\Inflector;

use App\Application\Bus\UseCase\RequestInterface;

/**
 * Class UseCaseHandlerName
 * @package App\Infrastructure\Service\Inflector
 */
class UseCaseHandlerName implements InflectorInterface
{
    /**
     * @access public
     * @param RequestInterface $request
     * @return string
     */
    public function inflect(RequestInterface $request) : string
    {
        $reflectionClass = (new \ReflectionClass($request));
        $name = array();

        $this->add($name, $this->getFirstLevel($reflectionClass));
        $this->add($name, $this->getSecondLevel($reflectionClass));
        $this->add($name, $this->getServiceName($reflectionClass));

        return implode('.', $name);
    }

    /**
     * @access private
     * @param $name
     * @param $level
     */
    private function add(&$name, $level)
    {
        if (!empty($level)) {
            array_push($name, $level);
        }
    }

    /**
     * @access private
     * @param \Reflector $reflector
     * @return string
     */
    private function getFirstLevel(\Reflector $reflector)
    {
        $namespaceName = explode('\\', $reflector->getNamespaceName());
        $split = preg_split('/(?<=\\w)(?=[A-Z])/', $namespaceName[0]);
        $firstLevel = '';

        if (count($split) === 2) {
            $firstLevel = strtolower(substr($split[0], 0, 1).substr($split[1], 0, 1));
        }

        return $firstLevel;
    }

    /**
     * @access private
     * @param \Reflector $reflector
     * @return string
     */
    private function getSecondLevel(\Reflector $reflector)
    {
        $namespaceName =  explode('\\', strtolower($reflector->getNamespaceName()));
        $levelNames = array('application', 'domain', 'infrastructure');
        $secondLevel = '';

        foreach ($levelNames as $levelName) {
            if (in_array($levelName, $namespaceName)) {
                $secondLevel = $levelName;
                break;
            }
        }

        return $secondLevel;
    }

    /**
     * @access private
     * @param \Reflector $reflector
     * @return string
     */
    private function getServiceName(\Reflector $reflector)
    {
        $str = $reflector->getShortName();
        $split = preg_split('/(?<=\\w)(?=[A-Z])/', $str);
        unset($split[count($split)-1]);
        array_push($split, 'use_case');
        $name = strtolower(implode('_', $split));

        return $name;
    }
}
