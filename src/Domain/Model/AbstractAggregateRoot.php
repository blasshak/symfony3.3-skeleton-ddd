<?php

namespace App\Domain\Model;

use App\Domain\Bus\Event\DomainEventInterface;

/**
 * Class AbstractAggregateRoot
 * @package App\Domain\Model
 */
class AbstractAggregateRoot
{
    /**
     * @var array
     */
    private $pendingEvents = [];

    /**
     * @access public
     * @param DomainEventInterface $event
     * @return void
     */
    public function record(DomainEventInterface $event) : void
    {
        $this->pendingEvents[] = $event;
    }

    /**
     * @access public
     * @return array
     */
    public function pendingEvents() : array
    {
        $events = $this->pendingEvents;

        $this->removeEvents();

        return $events;
    }

    /**
     * @access public
     * @return void
     */
    private function removeEvents() : void
    {
        $this->pendingEvents = [];
    }
}
