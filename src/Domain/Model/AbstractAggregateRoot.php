<?php

namespace App\Domain\Model;

use App\Domain\Bus\Event\DomainEventInterface;

class AbstractAggregateRoot
{
    /**
     * @var array
     */
    private $pendingEvents = [];

    protected function __construct()
    {
    }

    /**
     * @param DomainEventInterface $event
     */
    public function record(DomainEventInterface $event)
    {
        $this->pendingEvents[] = $event;
    }

    /**
     * @return array
     */
    public function pendingEvents()
    {
        $events = $this->pendingEvents;

        $this->removeEvents();

        return $events;
    }


    private function removeEvents()
    {
        $this->pendingEvents = [];
    }
}
