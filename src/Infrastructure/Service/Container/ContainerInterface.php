<?php

namespace App\Infrastructure\Service\Container;

/**
 * Interface ContainerInterface
 * @package App\Infrastructure\Service\Container
 */
interface ContainerInterface
{
    /**
     * @access public
     * @param string $name
     * @return mixed
     */
    public function getService($name);
}
