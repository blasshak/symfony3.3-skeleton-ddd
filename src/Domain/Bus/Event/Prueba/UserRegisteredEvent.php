<?php

namespace App\Domain\Bus\Event\Prueba;

use App\Domain\Bus\Event\DomainEventInterface;

class UserResgisteredEvent implements DomainEventInterface
{
    public function name(): string
    {
        return 'USER_REGISTERED';
    }

    public function occurredOn() : string
    {
        return new \DateTime();
    }
}
