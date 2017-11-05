<?php

namespace App\Domain\Bus\Event;

/**
 * Interface ListenerInterface
 * @package App\Domain\Bus\Event
 */
interface DomainEventInterface
{
    public function name(): string;

    public function occurredOn() : string;
}
