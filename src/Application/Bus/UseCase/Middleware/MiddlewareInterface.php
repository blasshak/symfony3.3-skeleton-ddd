<?php

namespace App\Application\Bus\UseCase\Middleware;

interface MiddlewareInterface
{
    /**
     * @access public
     * @param array $request
     * @param callable $next
     * @return mixed
     */
    public function execute(array $request, callable $next);
}
