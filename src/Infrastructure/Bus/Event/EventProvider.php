<?php

namespace App\Infrastructure\Bus\Event;

use App\Domain\Bus\Event\DomainEventInterface;
use App\Domain\Bus\Event\EventProviderInterface;

/**
 * Class EventBus
 * @package CoreBundle\Infrastructure\Bus\Event
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
    public function record(DomainEventInterface $event)
    {
        $this->events[$event->name()] = $event;
    }
    /**
     * Release the pending events
     * @access public
     * @return DomainEventInterface[] $events
     */
    public function release()
    {
        $events = $this->events;
        $this->removeEvents();

        return $events;
    }
    /**
     * @access private
     * @return void
     */
    private function removeEvents()
    {
        $this->events = [];
    }
}
