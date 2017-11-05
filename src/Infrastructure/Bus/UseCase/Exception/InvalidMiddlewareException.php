<?php

namespace App\Infrastructure\Bus\UseCase\Exception;

/**
 * Class InvalidMiddlewareException
 * @package App\Infrastructure\Bus\UseCase\Exception
 */
class InvalidMiddlewareException extends \Exception
{
    /**
     * @access public
     * @param $middleware
     * @return InvalidMiddlewareException
     */
    public static function forMiddleware($middleware) : InvalidMiddlewareException
    {
        $name = is_object($middleware) ? get_class($middleware) : gettype($middleware);
        $message = sprintf(
            'Cannot add "%s" to middleware chain as it does not implement the Middleware interface.',
            $name
        );
        return new static($message);
    }
}
