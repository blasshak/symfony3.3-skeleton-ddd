<?php

namespace App\Domain\Bus\Event;

/**
 * Interface EventBusInterface
 * @package App\Domain\Bus\Event
 */
interface EventBusInterface
{
    /**
     * @access public
     * @param string $eventName
     * @param ListenerInterface $listener
     * @return void
     */
    public function addListener(string $eventName, ListenerInterface $listener) : void;

    /**
     * @access public
     * @param $event
     * @return void
     */
    public function dispatch(DomainEventInterface $event) : void;
}
