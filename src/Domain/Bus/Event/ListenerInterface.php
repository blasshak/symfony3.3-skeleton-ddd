<?php

namespace App\Domain\Bus\Event;

/**
 * Interface ListenerInterface
 * @package App\Domain\Bus\Event
 */
interface ListenerInterface
{
    /**
     * @access public
     * @param DomainEventInterface $event
     * @return void
     */
    public function handle(DomainEventInterface $event) : void;
}
