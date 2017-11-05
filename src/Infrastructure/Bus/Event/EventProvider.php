<?php

namespace App\Infrastructure\Bus\Event;

use App\Domain\Bus\Event\DomainEventInterface;
use App\Domain\Bus\Event\EventProviderInterface;

/**
 * Class EventBus
 * @package App\Infrastructure\Bus\Event
 */
class EventProvider implements EventProviderInterface
{
    /**
     * @access private
     * @var DomainEventInterface[] $events
     */
    private $events;
    /**
     * @access public
     */
    public function __construct()
    {
        $this->events = array();
    }
    /**
     * @access public
     * @param DomainEventInterface $event
     * @return void
     */
    public function record(DomainEventInterface $event) : void
    {
        $this->events[$event->name()] = $event;
    }
    /**
     * Release the pending events
     * @access public
     * @return DomainEventInterface[] $events
     */
    public function release() : array
    {
        $events = $this->events;
        $this->removeEvents();

        return $events;
    }
    /**
     * @access private
     * @return void
     */
    private function removeEvents() : void
    {
        $this->events = [];
    }
}
