<?php

namespace App\Infrastructure\Bus\UseCase;

use App\Application\Bus\UseCase\Middleware\MiddlewareInterface;
use App\Application\Bus\UseCase\RequestInterface;
use App\Application\Bus\UseCase\UserCaseBusInterface;
use App\Infrastructure\Bus\UseCase\Exception\InvalidMiddlewareException;

/**
 * Class UseCaseBusSync
 * @package App\Infrastructure\Bus\UseCase
 */
class UseCaseBusSync implements UserCaseBusInterface
{
    /**
     * @access protected
     * @var array
     */
    protected $middlewares;

    /**
     * @var callable
     */
    private $middlewareChain;
    /**
     * @param MiddlewareInterface[] $middleware
     */

    /**
     * @access public
     * @param array $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @access public
     * @param array $middlewares
     * @return void
     */
    public function preHandle(array $middlewares) : void
    {
        $this->addMiddlewares($middlewares);
        $this->createExecutionChain();
    }

    /**
     * @access public
     * @param $middlewares
     * @return void
     */
    public function addMiddlewares($middlewares) : void
    {
        foreach ($middlewares as $k => $v) {
            array_splice($this->middlewares, $k, 0, array($middlewares[$k]));
        }
    }

    /**
     * @access private
     * @return void
     * @throws InvalidMiddlewareException
     */
    private function createExecutionChain() : void
    {
        $middlewares = $this->middlewares;

        $lastCallable = function () {
        };

        while ($middleware = array_pop($middlewares)) {
            if (! $middleware instanceof MiddlewareInterface) {
                throw InvalidMiddlewareException::forMiddleware($middleware);
            }

            $lastCallable = function ($command) use ($middleware, $lastCallable) {
                return $middleware->execute($command, $lastCallable);
            };
        }

        $this->middlewareChain = $lastCallable;
    }

    /**
     * Executes the given command and optionally returns a value
     * @access public
     * @param RequestInterface $request
     * @return mixed
     */
    public function handle(RequestInterface $request)
    {
        $middlewareChain = $this->middlewareChain;

        return $middlewareChain($request);
    }
}
