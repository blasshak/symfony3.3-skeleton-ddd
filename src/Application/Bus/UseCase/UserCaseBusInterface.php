<?php

namespace App\Application\Bus\UseCase;

/**
 * Interface UserCaseBusInterface
 * @package App\Application\Bus\UseCase
 */
interface UserCaseBusInterface
{
    /**
     * @access public
     * @param array $middlewares
     * @return void
     */
    public function preHandle(array $middlewares) : void;

    /**
     * Executes the given command and optionally returns a value
     * @access public
     * @param RequestInterface $request
     * @return mixed
     */
    public function handle(RequestInterface $request);
}
