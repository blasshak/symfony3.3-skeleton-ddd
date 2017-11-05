<?php

namespace App\Application\Bus\UseCase;

use App\Application\Bus\UseCase\Exception\InvalidRequestException;

/**
 * Interface RequestInterface
 * @package App\Application\Bus\UseCase
 */
interface RequestInterface
{
    /**
     * @access public
     * @param array $request
     * @return RequestInterface
     * @throws InvalidRequestException
     */
    public static function create(array $request) : RequestInterface;
}
