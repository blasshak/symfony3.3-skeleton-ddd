<?php

namespace App\Application\Bus\UseCase\Exception;

/**
 * Class InvalidRequestException
 * @package App\Application\Bus\UseCase\Exception
 */
final class InvalidRequestException extends \Exception
{
    const MESSAGE = 'Invalid request';
}
