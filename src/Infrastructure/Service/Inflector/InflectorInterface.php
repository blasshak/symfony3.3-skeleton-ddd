<?php

namespace App\Infrastructure\Service\Inflector;

use App\Application\Bus\UseCase\RequestInterface;

/**
 * Interface InflectorInterface
 * @package App\Infrastructure\Service\Inflector
 */
interface InflectorInterface
{
    /**
     * @access public
     * @param RequestInterface $request
     * @return string
     */
    public function inflect(RequestInterface $request) : string;
}
