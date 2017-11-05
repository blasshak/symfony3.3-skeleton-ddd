<?php

namespace App\Domain\Bus\Event;

/**
 * Interface ListenerInterface
 * @package App\Domain\Bus\Event
 */
interface DomainEventInterface
{
    /**
     * @access public
     * @return string
     */
    public function name(): string;

    /**
     * @access public
     * @return string
     */
    public function occurredOn() : string;
}
