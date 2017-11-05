<?php

namespace App\Application\Bus\UseCase\Middleware;

use App\Application\Bus\UseCase\RequestInterface;

/**
 * Interface MiddlewareInterface
 * @package App\Application\Bus\UseCase\Middleware
 */
interface MiddlewareInterface
{
    /**
     * @access public
     * @param RequestInterface $request
     * @param callable $next
     * @return mixed
     */
    public function execute(RequestInterface $request, callable $next);
}
