<?php

namespace App\Application\Bus\UseCase\Prueba;

use App\Application\Bus\UseCase\Exception\InvalidRequestException;
use App\Application\Bus\UseCase\RequestInterface;

/**
 * Class ShowRequest
 * @package App\Application\Bus\UseCase\Prueba
 */
final class ShowRequest implements RequestInterface
{
    /**
     * @access private
     * @var string
     */
    private $text;

    /**
     * @access private
     * @param array $request
     */
    private function __construct(array $request)
    {
        $this->text = $request['text'];
    }

    /**
     * @access public
     * @param array $request
     * @return RequestInterface
     * @throws InvalidRequestException
     */
    public static function create(array $request) : RequestInterface
    {
        if (empty($request['text'])) {
            throw new InvalidRequestException(InvalidRequestException::MESSAGE);
        }

        return new static($request);
    }

    /**
     * @access public
     * @return string
     */
    public function text() : string
    {
        return $this->text;
    }
}
