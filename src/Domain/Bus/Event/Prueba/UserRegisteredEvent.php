<?php

namespace App\Domain\Bus\Event\Prueba;

use App\Domain\Bus\Event\DomainEventInterface;

/**
 * Class UserRegisteredEvent
 * @package App\Domain\Bus\Event\Prueba
 */
class UserRegisteredEvent implements DomainEventInterface
{
    /**
     * @access public
     * @return string
     */
    public function name(): string
    {
        return 'USER_REGISTERED';
    }

    /**
     * @access public
     * @return string
     */
    public function occurredOn() : string
    {
        return new \DateTime();
    }
}
