<?php

namespace App\Infrastructure\Bus\UseCase;

use App\Application\Bus\UseCase\Middleware\MiddlewareInterface;

class UseCaseBus
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
     * @param $middlewares
     * @return void
     */
    public function addMiddlewares($middlewares)
    {
        foreach ($middlewares as $k => $v) {
            array_splice($this->middlewares, $k, 0, array($middlewares[$k]));
        }
    }
    /**
     * Executes the given command and optionally returns a value
     * @access public
     * @param array $request
     * @return mixed
     */
    public function execute(array $request)
    {
        $this->createExecutionChain();
        $middlewareChain = $this->middlewareChain;

        return $middlewareChain($request);
    }

    /**
     * @access private
     * @return void
     * @throws InvalidMiddlewareException
     */
    private function createExecutionChain()
    {
        $middlewares = $this->middlewares;
        $lastCallable = function () {
        };
        while ($middleware = array_pop($middlewares)) {
            if (! $middleware instanceof MiddlewareInterface) {
                //throw execptio
            }
            $lastCallable = function ($command) use ($middleware, $lastCallable) {
                return $middleware->execute($command, $lastCallable);
            };
        }
        $this->middlewareChain = $lastCallable;
    }
}