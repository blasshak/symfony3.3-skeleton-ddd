<?php

namespace App\Infrastructure\Bus\UseCase\Middleware;

use App\Application\Bus\UseCase\Middleware\MiddlewareInterface;
use App\Application\Bus\UseCase\RequestInterface;
use App\Infrastructure\Service\Container\ContainerInterface;
use App\Infrastructure\Service\Container\InvalidServiceException;
use App\Infrastructure\Service\Inflector\InflectorInterface;

/**
 * Class UseCaseHandler
 * @package App\Infrastructure\Bus\UseCase\Middleware
 */
class UseCaseHandler implements MiddlewareInterface
{
    /**
     * @access private
     * @var ContainerInterface
     */
    private $container;

    /**
     * @access private
     * @var InflectorInterface
     */
    private $inflector;

    /**
     * @access public
     * @param ContainerInterface $container
     * @param InflectorInterface $inflector
     */
    public function __construct(ContainerInterface $container, InflectorInterface $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    /**
     * @access public
     * @param RequestInterface $request
     * @param callable $next
     * @return mixed
     * @throws InvalidServiceException
     */
    public function execute(RequestInterface $request, callable $next)
    {
        $name = $this->inflector->inflect($request);

        try {
            $useCaseHandler = $this->container->getService($name);

            return $useCaseHandler->execute($request);
        } catch (InvalidServiceException $exception) {
            throw $exception;
        }
    }
}
